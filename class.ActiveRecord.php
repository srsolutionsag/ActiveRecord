<?php
require_once('class.ActiveRecordList.php');

/**
 * Class ActiveRecord
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @author  Oskar Truffer <ot@studer-raimann.ch>
 *
 * @description
 *
 * @version 1.1.01
 */
abstract class ActiveRecord {

	/**
	 * @var array
	 */
	protected static $db_fields = array();
	/**
	 * @var array
	 */
	protected static $form_fields = array();
	/**
	 * @var array
	 */
	protected static $primary_fields = array();
	/**
	 * @var array
	 */
	private static $object_cache = array();
	/**
	 * @var array
	 */
	protected static $possible_fields = array(
		'db' => array(
			'db_has_field',
			'db_is_unique',
			'db_is_primary',
			'db_is_notnull',
			'db_fieldtype',
			'db_length',
		),
		'form' => array(
			'form_has_field',
			'form_type',
		),
	);


	/**
	 * @return string
	 * @description Return the Name of your Database Table
	 */
	abstract static function returnDbTableName();


	/**
	 * @return array
	 */
	public static function returnDbFields() {
		$class = get_called_class();
		if (! isset(self::$db_fields[$class])) {
			new $class();
		}

		return self::$db_fields[$class];
	}


	/**
	 * @return string
	 */
	public static function returnPrimaryFieldName() {
		$class = get_called_class();
		if (! isset(self::$primary_fields[$class])) {
			new $class();
		}

		return self::$primary_fields[$class]['fieldname'];
	}


	/**
	 * @return string
	 */
	public static function returnPrimaryFieldType() {
		$class = get_called_class();
		if (! isset(self::$primary_fields[$class])) {
			new $class();
		}

		return self::$primary_fields[$class]['fieldtype'];
	}


	/**
	 * @var int
	 *
	 * @db_has_field        true
	 * @db_is_unique        true
	 * @db_is_primary       true
	 * @db_is_notnull       true
	 * @db_fieldtype        integer
	 * @db_length           4
	 */
	// protected $id = 0;
	/**
	 * @param $id
	 */
	public function __construct($id = 0) {
		global $ilDB;
		$this->db = $ilDB;
		self::setDBFields($this);
		self::setFormFields($this);
		/**
		 * @var $ilDB ilDB
		 */
		if (self::returnPrimaryFieldName() === 'id') {
			$this->id = $id;
		} else {
			$key = self::returnPrimaryFieldName();
			$this->{$key} = $id;
		}
		if ($id != 0) {
			$this->read();
		}
	}


	//
	// Database
	//
	/**
	 * @return array
	 */
	final protected function getArrayForDb() {
		$e = array();
		foreach (self::returnDbFields() as $field_name => $field_info) {
			$e[$field_name] = array( $field_info->db_type, $this->$field_name );
		}

		return $e;
	}


	/**
	 * @return bool
	 */
	final public static function installDB() {
		$class = get_called_class();
		/**
		 * @var $model ActiveRecord
		 */
		$model = new $class();

		return $model->installDatabase();
	}


	/**
	 * @return bool
	 */
	final protected function installDatabase() {
		$fields = array();
		foreach (self::returnDbFields() as $field_name => $field_infos) {
			$attributes = array();
			$attributes['type'] = $field_infos->db_type;
			if ($field_infos->length) {
				$attributes['length'] = $field_infos->length;
			}
			if ($field_infos->notnull) {
				$attributes['notnull'] = $field_infos->notnull;
			}
			$fields[$field_name] = $attributes;
		}
		if (! $this->db->tableExists($this->returnDbTableName())) {
			$this->db->createTable($this->returnDbTableName(), $fields);
			if (self::returnPrimaryFieldName()) {
				$this->db->addPrimaryKey($this->returnDbTableName(), array( self::returnPrimaryFieldName() ));
			}
			if (self::returnPrimaryFieldType() === 'integer') {
				$this->db->createSequence($this->returnDbTableName());
			}
		} else {
			$this->updateDB();
		}

		return true;
	}


	/**
	 * @return bool
	 */
	final public static function updateDB() {
		$class = get_called_class();
		/**
		 * @var $model ActiveRecord
		 */
		$model = new $class();

		return $model->updateDatabase();
	}


	/**
	 * @return bool
	 */
	final protected function updateDatabase() {
		if (! $this->db->tableExists($this->returnDbTableName())) {
			$this->installDatabase();

			return true;
		}
		foreach (self::returnDbFields() as $field_name => $field_infos) {
			if (! $this->db->tableColumnExists($this->returnDbTableName(), $field_name)) {
				$attributes = array();
				$attributes['type'] = $field_infos->db_type;
				if ($field_infos->length) {
					$attributes['length'] = $field_infos->length;
				}
				if ($field_infos->notnull) {
					$attributes['notnull'] = $field_infos->notnull;
				}
				$this->db->addTableColumn($this->returnDbTableName(), $field_name, $attributes);
			}
		}

		return true;
	}


	/**
	 * @return bool
	 */
	final public static function resetDB() {
		$class = get_called_class();
		/**
		 * @var $model ActiveRecord
		 */
		$model = new $class();

		return $model->resetDatabase();
	}


	/**
	 * @return bool
	 */
	final protected function resetDatabase() {
		if ($this->db->tableExists($this->returnDbTableName())) {
			$this->db->dropTable($this->returnDbTableName());
		}
		$this->installDatabase();

		return true;
	}


	final  protected function truncateDatabase() {
		$query = 'TRUNCATE TABLE ' . $this->returnDbTableName();
		$this->db->query($query);
		if ($this->db->tableExists($this->returnDbTableName() . '_seq')) {
			$this->db->dropSequence($this->returnDbTableName());
			$this->db->createSequence($this->returnDbFields());
		}
	}


	/**
	 * @return bool
	 */
	final public static function truncateDB() {
		$class = get_called_class();
		/**
		 * @var $model ActiveRecord
		 */
		$model = new $class();

		return $model->truncateDatabase();
	}


	/**
	 * @return bool
	 */
	final public static function flushDB() {
		return self::truncateDB();
	}


	//
	// CRUD
	//
	public function saveDeprecated() {
		if ($this->getId() === 0) {
			$this->create();
		} else {
			$this->update();
		}
	}


	public function create() {
		$class = get_class($this);
		// TODO evtl. check field length etc.
		try {
			if (self::returnPrimaryFieldName() === 'id') {
				$this->setId($this->db->nextID($this->returnDbTableName()));
				$this->db->insert($this->returnDbTableName(), $this->getArrayForDb());
				self::$object_cache[$class][$this->getId()] = $this;
			} else { // TODO dies zur normalen Methode machen. prüfen
				$this->db->insert($this->returnDbTableName(), $this->getArrayForDb());
				self::$object_cache[$class][$this->getPrimaryFieldValue()] = $this;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	public function read() {
		$class = get_class($this);
		if (self::returnPrimaryFieldName() === 'id') {
			$set = $this->db->query('SELECT * FROM ' . $this->returnDbTableName() . ' ' . ' WHERE id = '
				. $this->db->quote($this->getId(), 'integer'));
			while ($rec = $this->db->fetchObject($set)) {
				foreach ($this->getArrayForDb() as $k => $v) {
					$this->{$k} = $rec->{$k};
				}
			}
			self::$object_cache[$class][$this->getId()] = $this;
		} else { // TODO dies zur normalen Methode machen. prüfen
			$set = $this->db->query('SELECT * FROM ' . $this->returnDbTableName() . ' ' . ' WHERE '
				. self::returnPrimaryFieldName() . ' = '
				. $this->db->quote($this->getPrimaryFieldValue(), self::returnPrimaryFieldType()));
			while ($rec = $this->db->fetchObject($set)) {
				foreach ($this->getArrayForDb() as $k => $v) {
					$this->{$k} = $rec->{$k};
				}
			}
			self::$object_cache[$class][$this->getPrimaryFieldValue()] = $this;
		}
	}


	public function update() {
		$class = get_class($this);
		if (self::returnPrimaryFieldName() === 'id') {
			$this->db->update($this->returnDbTableName(), $this->getArrayForDb(), array(
				'id' => array(
					'integer',
					$this->getId()
				),
			));
			self::$object_cache[$class][$this->getId()] = $this;
		} else { // TODO dies zur normalen Methode machen. prüfen
			$this->db->update($this->returnDbTableName(), $this->getArrayForDb(), array(
				self::returnPrimaryFieldName() => array(
					self::returnPrimaryFieldType(),
					$this->getPrimaryFieldValue()
				),
			));
			self::$object_cache[$class][$this->getPrimaryFieldValue()] = $this;
		}
	}


	public function delete() {
		$class = get_class($this);
		if (self::returnPrimaryFieldName() === 'id') {
			$this->db->manipulate('DELETE FROM ' . $this->returnDbTableName() . ' WHERE id = '
				. $this->db->quote($this->getId(), 'integer'));
			unset(self::$object_cache[$class][$this->getId()]);
		} else { // TODO dies zur normalen Methode machen. prüfen
			$this->db->manipulate('DELETE FROM ' . $this->returnDbTableName() . ' WHERE '
				. self::returnPrimaryFieldName() . ' = '
				. $this->db->quote($this->getPrimaryFieldValue(), self::returnPrimaryFieldType()));
			unset(self::$object_cache[$class][$this->getPrimaryFieldValue()]);
		}
	}


	//
	// Helper
	//
	/**
	 * @param $parent_id
	 *
	 * @return int
	 * @deprecated
	 */
	private function getNextPosition($parent_id) {
		$set = $this->db->query('SELECT MAX(position) next_pos FROM ' . $this->returnDbTableName() . ' '
			. ' WHERE parent_id = ' . $this->db->quote($parent_id, 'integer'));
		while ($rec = $this->db->fetchObject($set)) {
			return $rec->next_pos + 1;
		}

		return 1;
	}


	/**
	 * @param string $str
	 *
	 * @return string
	 */
	private static function _fromCamelCase($str) {
		$str[0] = strtolower($str[0]);
		$func = create_function('$c', 'return "_" . strtolower($c[1]);');

		return preg_replace_callback('/([A-Z])/', $func, $str);
	}


	/**
	 * @param string $str
	 * @param bool   $capitalise_first_char
	 *
	 * @return string
	 */
	private static function _toCamelCase($str, $capitalise_first_char = false) {
		if ($capitalise_first_char) {
			$str[0] = strtoupper($str[0]);
		}
		$func = create_function('$c', 'return strtoupper($c[1]);');

		return preg_replace_callback('/-([a-z])/', $func, $str);
	}


	//
	// FindBy
	//
	/**
	 * @param $name
	 * @param $arguments
	 *
	 * @return array
	 */
	public function __call($name, $arguments) {
		// Getter
		if (preg_match("/get([a-zA-Z]*)/u", $name, $matches) AND count($arguments) == 0) {
			return $this->{self::_fromCamelCase($matches[1])};
		}
		// Setter
		if (preg_match("/set([a-zA-Z]*)/u", $name, $matches) AND count($arguments) == 1) {
			$this->{self::_fromCamelCase($matches[1])} = $arguments[0];
		}
		if (preg_match("/findBy([a-zA-Z]*)/u", $name, $matches) AND count($arguments) == 1) {
			return self::where(array( self::_fromCamelCase($matches[1]) => $arguments[0] ))->get();
		}
	}


	/**
	 * @param $id
	 *
	 * @return ActiveRecord
	 */
	public static function find($id) {
		$class = get_called_class();
		/**
		 * @var $obj ActiveRecord
		 */
		if (! self::$object_cache[$class][$id]) {
			$obj = new $class();
			$obj->loadObject($id);
		}

		return self::$object_cache[$class][$id];
	}


	/**
	 * @param      $where
	 * @param null $operator
	 *
	 * @return ActiveRecordList
	 */
	public static function where($where, $operator = NULL) {
		$srModelObjectList = new ActiveRecordList(get_called_class());
		$srModelObjectList->where($where, $operator);

		return $srModelObjectList;
	}


	/**
	 * @param        $orderBy
	 * @param string $orderDirection
	 *
	 * @return ActiveRecordList
	 */
	public static function orderBy($orderBy, $orderDirection = 'ASC') {
		$srModelObjectList = new ActiveRecordList(get_called_class());
		$srModelObjectList->orderBy($orderBy, $orderDirection);

		return $srModelObjectList;
	}


	/**
	 * @param $start
	 * @param $end
	 *
	 * @return ActiveRecordList
	 */
	public static function limit($start, $end) {
		$srModelObjectList = new ActiveRecordList(get_called_class());
		$srModelObjectList->limit($start, $end);

		return $srModelObjectList;
	}


	/**
	 * @return int
	 */
	public static function affectedRows() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->affectedRows();
	}


	/**
	 * @return int
	 */
	public static function count() {
		return self::affectedRows();
	}


	/**
	 * @return array
	 */
	public static function get() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->get();
	}


	/**
	 * @return ActiveRecordList
	 */
	public static function debug() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->debug();
	}


	/**
	 * @return mixed
	 */
	public static function first() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->first();
	}


	/**
	 * @return mixed
	 */
	public static function last() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->last();
	}


	/**
	 * @return mixed
	 */
	public static function getFirstFromLastQuery() {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->getFirstFromLastQuery();
	}


	/**
	 * @param null $key
	 * @param null $values
	 *
	 * @return array
	 */
	public static function getArray($key = NULL, $values = NULL) {
		$srModelObjectList = new ActiveRecordList(get_called_class());

		return $srModelObjectList->getArray($key, $values);
	}


	/**
	 * @param $id
	 */
	public function loadObject($id) {
		$class = get_class($this);
		if (! self::$object_cache[$class][$id]) {
			self::$object_cache[$class][$id] = new $class($id);
		}
	}


	/**
	 * @param array $array
	 *
	 * @return $this
	 */
	public function buildFromArray(array $array) {
		$class = get_class($this);
		if (self::returnPrimaryFieldName() === 'id') {
			if (self::$object_cache[$class][$array['id']]) {
				return self::$object_cache[$class][$array['id']];
			}
			foreach ($array as $field_name => $value) {
				$this->{$field_name} = $value;
			}
			self::$object_cache[$class][$array['id']] = $this;
		} else {
			if (self::$object_cache[$class][$array[self::returnPrimaryFieldName()]]) {
				return self::$object_cache[$class][$array[self::returnPrimaryFieldName()]];
			}
			foreach ($array as $field_name => $value) {
				$this->{$field_name} = $value;
			}
			self::$object_cache[$class][$array[self::returnPrimaryFieldName()]] = $this;
		}

		return $this;
	}


	//
	// Setter & Getter
	//
	/**
	 * @param int $id
	 */
	//	public function setId($id) {
	//		$this->id = $id;
	//	}
	/**
	 * @return int
	 */
	//	public function getId() {
	//		return $this->id;
	//	}
	/**
	 * @return mixed
	 */
	final protected function getPrimaryFieldValue() {
		$primary_fieldname = self::returnPrimaryFieldName();

		return $this->{$primary_fieldname};
	}


	//
	// Reflection
	//
	/**
	 * @param ActiveRecord $obj
	 *
	 * @return bool
	 * @throws Exception
	 */
	private static function setDBFields(ActiveRecord $obj) {

		$class = get_class($obj);
		if (! self::$db_fields[$class]) {
			$fields = array();
			$primary = 0;
			foreach (self::getAttributesByFilter($obj, 'db') as $fieldname => $rf) {
				foreach ($rf as $k => $v) {
					self::checkAttribute($fieldname, 'db', $k);
				}
				if ($rf->db_has_field == 'true') {
					if ($rf->db_is_primary) {
						$primary ++;
						if ($primary > 1) {
							throw new Exception('Your Class \'' . __CLASS__ . '\' has two or more primary fields.');
						}
						if ($rf->db_length >= 1000) {
							throw new Exception('Your PrimaryKey \'' . $fieldname . '\' in Class \'' . __CLASS__
								. '\' is too long (max key length is 1000 bytes)');
						}
						self::$primary_fields[$class]['fieldname'] = $fieldname;
						self::$primary_fields[$class]['fieldtype'] = $rf->db_fieldtype;
					}
					$field_info = new stdClass();
					if (! in_array($rf->db_fieldtype, array(
						'text',
						'integer',
						'float',
						'date',
						'time',
						'timestamp',
						'clob'
					))
					) {
						throw new Exception('Your field \'' . $fieldname . '\' in Class \'' . __CLASS__
							. '\' has wrong db_type: ' . $rf->db_fieldtype);

						return;
					}
					switch ($rf->db_fieldtype) {
						case 'integer':
							$field_info->notnull = $rf->db_is_notnull == 'true' ? true : false;
							$field_info->length = in_array($rf->db_length, array( 1, 2, 3, 4, 8 )) ? $rf->db_length : 2;
							break;
						case 'text':
							$field_info->notnull = $rf->db_is_notnull == 'true' ? true : false;
							$field_info->length = ($rf->db_length > 0 AND
								$rf->db_length <= 4000) ? $rf->db_length : 1024;
							break;
						//	case 'date':
						//	case 'float':
						//	case 'time':
						//	case 'timestamp':
						//	case 'clob':
					}
					$field_info->db_type = $rf->db_fieldtype;
					$fields[$fieldname] = $field_info;
				}
			}
			self::$db_fields[$class] = $fields;
		}

		return true;
	}


	/**
	 * @param ActiveRecord $obj
	 * @param              $filter
	 *
	 * @return array
	 */
	protected static function getAttributesByFilter(ActiveRecord $obj, $filter) {
		$reflectionClass = new ReflectionClass($obj);
		$raw_fields = array();
		foreach ($reflectionClass->getProperties() as $property) {
			if ($property->getName() == 'fields') {
				continue;
			}
			$properties = new stdClass();
			foreach (explode("\n", $property->getDocComment()) as $line) {
				if (preg_match("/[ ]*\\* @(" . $filter . "_[a-zA-Z0-9_]*)[ ]*([a-zA-Z0-9_]*)/u", $line, $matches)) {
					$properties->{(string)$matches[1]} = $matches[2];
				}
			}
			$raw_fields[$property->getName()] = $properties;
		}

		return $raw_fields;
	}


	/**
	 * @param ActiveRecord $obj
	 *
	 * @return bool
	 * @throws Exception
	 */
	private static function setFormFields(ActiveRecord $obj) {
		$class = get_class($obj);
		if (! self::$form_fields[$class]) {
			$fields = array();
			foreach (self::getAttributesByFilter($obj, 'form') as $fieldname => $rf) {
				foreach ($rf as $k => $v) {
					self::checkAttribute($fieldname, 'form', $k);
					if ($rf->form_has_field == 'true') {
						$field_info['type'] = $rf->form_type;
						$fields[$fieldname] = $field_info;
					}
				}
			}
			self::$db_fields[$class] = $fields;
		}

		return true;
	}


	/**
	 * @return array
	 */
	protected static function getPossibleFormAttributeNames() {
		return self::$possible_fields['form'];
	}


	/**
	 * @return array
	 */
	protected static function getPossibleDbAttributeNames() {
		return self::$possible_fields['db'];
	}


	/**
	 * @param $attribute_name
	 *
	 * @return bool
	 */
	protected static function isDbAttribute($attribute_name) {
		return in_array($attribute_name, self::getPossibleDbAttributeNames());
	}


	/**
	 * @param $attribute_name
	 *
	 * @return bool
	 */
	protected static function isFormAttribute($attribute_name) {
		return in_array($attribute_name, self::getPossibleFormAttributeNames());
	}


	/**
	 * @param $fieldname
	 * @param $type
	 * @param $attribute
	 *
	 * @throws Exception
	 */
	protected static function checkAttribute($fieldname, $type, $attribute) {
		$is_attribute = true;
		switch ($type) {
			case 'db':
				$is_attribute = self::isDbAttribute($attribute);
				break;
			case 'form':
				$is_attribute = self::isFormAttribute($attribute);
				break;
		}
		if (! $is_attribute) {
			throw new Exception('Your field \'' . $fieldname . '\' in Class \'' . __CLASS__ . '\' has wrong attribute: '
				. $attribute);
		}
	}
}

/**
 * @description Due to limitations in PHP 5.2 we implemented the function 'get_called_class'
 */
if (! function_exists('get_called_class')) {
	/**
	 * Class class_tools
	 */
	class class_tools {

		/**
		 * @var int
		 */
		static $i = 0;
		/**
		 * @var null
		 */
		static $fl = NULL;


		/**
		 * @return mixed
		 */
		static function get_called_class() {
			$bt = debug_backtrace();
			if (self::$fl == $bt[2]['file'] . $bt[2]['line']) {
				self::$i ++;
			} else {
				self::$i = 0;
				self::$fl = $bt[2]['file'] . $bt[2]['line'];
			}
			$lines = file($bt[2]['file']);
			preg_match_all('/([a-zA-Z0-9\_]+)::' . $bt[2]['function'] . '/', $lines[$bt[2]['line'] - 1], $matches);

			return $matches[1][self::$i];
		}
	}

	/**
	 * @return mixed
	 */
	function get_called_class() {
		return class_tools::get_called_class();
	}
}

?>
