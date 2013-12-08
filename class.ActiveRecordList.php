<?
/**
 * Class ActiveRecordList
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @author  Oskar Truffer <ot@studer-raimann.ch>
 *
 * @description
 *
 * @version 1.0.12
 */
class ActiveRecordList {

	/**
	 * @var array
	 */
	protected $where = array();
	/**
	 * @var bool
	 */
	protected $loaded = false;
	/**
	 * @var string
	 */
	protected $order_by = '';
	/**
	 * @var string
	 */
	protected $order_direction = 'ASC';
	/**
	 * @var string
	 */
	protected $class = '';
	/**
	 * @var ActiveRecord[]
	 */
	protected $result = array();
	/**
	 * @var array
	 */
	protected $result_array = array();
	/**
	 * @var array
	 */
	protected $string_wheres = array();
	/**
	 * @var
	 */
	protected $start;
	/**
	 * @var
	 */
	protected $end;
	protected $debug = false;


	/**
	 * @param $class
	 */
	public function __construct($class) {
		global $ilDB;
		/**
		 * @var $ilDB ilDB
		 */
		$this->db = $ilDB;
		$this->class = $class;
	}


	/**
	 * @param      $where
	 * @param null $operator
	 *
	 * @return $this
	 * @throws Exception
	 */
	public function where($where, $operator = NULL) {
		$this->loaded = false;
		if (is_string($where)) {
			$this->string_wheres[] = $where; // FSX SQL-Injection abfangen
			return $this;
		} elseif (is_array($where)) {
			foreach ($where as $field_name => $value) {
				$op = '=';
				if ($operator !== NULL) {
					if (is_array($operator)) {
						$op = $operator[$field_name];
					} else {
						$op = $operator;
					}
				}
				$this->where[] = array( 'fieldname' => $field_name, 'value' => $value, 'operator' => $op );
			}

			return $this;
		} else {
			throw new Exception('Wrong where Statement, use strings or arrays');
		}
	}


	/**
	 * @param        $orderBy
	 * @param string $orderDirection
	 *
	 * @return $this
	 */
	public function orderBy($orderBy, $orderDirection = 'ASC') {
		$this->loaded = false;
		$this->order_by = $orderBy;
		$this->order_direction = $orderDirection;

		return $this;
	}


	public function debug() {
		$this->loaded = false;
		$this->debug = true;

		return $this;
	}


	/**
	 * @param $start
	 * @param $end
	 *
	 * @return $this
	 */
	public function limit($start, $end) {
		$this->loaded = false;
		$this->start = $start;
		$this->end = $end;

		return $this;
	}


	/**
	 * @return mixed
	 */
	public function affectedRows() {
		$q = $this->buildQuery();
		$set = $this->db->query($q);

		return $this->db->numRows($set);
	}


	/**
	 * @return mixed
	 */
	public function count() {
		return $this->affectedRows();
	}


	/**
	 * @return bool
	 */
	public function hasSets() {
		return $this->affectedRows() > 0 ? true : false;
	}


	/**
	 * @return array
	 */
	public function get() {
		$this->load();

		return $this->result;
	}


	/**
	 * @return mixed
	 */
	public function first() {
		$this->load();

		return array_shift(array_values($this->result));
	}


	/**
	 * @return mixed
	 */
	public function last() {
		$this->load();

		return array_pop(array_values($this->result));
	}


	/**
	 * @param string       $key    shall a specific value be used as a key? if null then the 1. array key is just increasing from 0.
	 * @param string|array $values which values should be taken? if null all are given. If only a string is given then the result is an 1D array!
	 *
	 * @return array
	 */
	public function getArray($key = NULL, $values = NULL) {
		$this->load();

		return $this->buildArray($key, $values);
	}


	/**
	 * @param $key
	 * @param $values
	 *
	 * @return array
	 * @throws Exception
	 */
	private function buildArray($key, $values) {
		if ($key === NULL AND $values === NULL) {
			return $this->result_array;
		}
		$array = array();
		foreach ($this->result_array as $row) {
			if ($key) {
				if (! array_key_exists($key, $row)) {
					throw new Exception("The attribute $key does not exist on this model.");
				}
				$array[$row[$key]] = $this->buildRow($row, $values);
			} else {
				$array[] = $this->buildRow($row, $values);
			}
		}

		return $array;
	}


	/**
	 * @param $row
	 * @param $values
	 *
	 * @return array
	 */
	private function buildRow($row, $values) {
		if ($values === NULL) {
			return $row;
		} else {
			$array = array();
			if (! is_array($values)) {
				return $row[$values];
			}
			foreach ($row as $key => $value) {
				if (in_array($key, $values)) {
					$array[$key] = $value;
				}
			}

			return $array;
		}
	}


	private function load() {
		if ($this->loaded) {
			return;
		} else {
			$q = $this->buildQuery();
			$set = $this->db->query($q);
			$this->result = array();
			$this->result_array = array();
			while ($res = $this->db->fetchAssoc($set)) {
				/**
				 * @var $obj ActiveRecord
				 */
				$obj = new $this->class();
				if ($obj::returnPrimaryFieldName() === 'id') {
					$this->result[$res['id']] = $obj->buildFromArray($res);
					$this->result_array[$res['id']] = $res;
				} else {
					$this->result[$res[$obj::returnPrimaryFieldName()]] = $obj->buildFromArray($res);
					$this->result_array[$res[$obj::returnPrimaryFieldName()]] = $res;
				}
			}
			$this->loaded = true;
		}
	}


	/**
	 * @return string
	 */
	private function buildQuery() {
		$class_fields = call_user_func($this->class . '::returnDbFields');
		$table_name = call_user_func($this->class . '::returnDbTableName');
		$q = 'SELECT * FROM ' . $table_name;
		if (count($this->where) OR count($this->string_wheres)) {
			$q .= ' WHERE ';
		}
		foreach ($this->string_wheres as $str) {
			$q .= $str . ' AND ';
		}
		foreach ($this->where as $w) {
			$field = $w['fieldname'];
			$value = $w['value'];
			$operator = ' ' . $w['operator'] . ' ';
			if (is_array($value)) {
				$q .= $this->db->in($field, $value, false, $class_fields[$field]->db_type) . ' AND ';
			} else {
				switch ($class_fields[$field]->db_type) {
					case 'integer':
					case 'float':
					case 'timestamp':
					case 'time':
					case 'date':
						$q .= $field . $operator . $this->db->quote($value, $class_fields[$field]->db_type) . ' AND ';
						break;
					case 'text':
					case 'clob':
					default:
						$q .= $field . $operator . $this->db->quote($value, $class_fields[$field]->db_type) . ' AND ';
						break;
				}
			}
		}
		$q = str_ireplace('  ', ' ', $q);
		if (count($this->where) OR count($this->string_wheres)) {
			$q = substr($q, 0, - 4);
		}
		if ($this->order_by) {
			$q .= ' ORDER BY ' . $this->order_by . ' ' . $this->order_direction;
		}
		if ($this->start !== NULL AND $this->end !== NULL) {
			$q .= ' LIMIT ' . $this->start . ', ' . $this->end;
		}
		if ($this->debug) {
			var_dump($q); // FSX
		}

		return $q;
	}
}

?>