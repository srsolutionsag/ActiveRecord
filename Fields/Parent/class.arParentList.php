<?php
require_once('class.arParent.php');

/**
 * Class arParentList
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 2.1.0
 */
class arParentList {

	const ACTIVE_RECORD = 'ActiveRecord';


	/**
	 * @param ActiveRecord $child
	 *
	 * @return arParentList
	 */
	public static function getInstance(ActiveRecord $child) {
		return new self($child);
	}


	/**
	 * @param ActiveRecord $child
	 */
	protected function __construct(ActiveRecord $child) {
		$this->setChild($child);
		$this->determineParents();
	}


	protected function determineParents() {
		$child_name = get_class($this->getChild());
		$child = $this->getChild();
		$ref = new ReflectionClass($child_name);
		$parent_name = $ref->getParentClass()->name;
		while ($parent_name != self::ACTIVE_RECORD) {
			$parent = arFactory::getInstance($parent_name);
			$ar_parent = arParent::getInstance($child, $parent);
			$this->addParent($ar_parent);
			$ref = new ReflectionClass($parent_name);
			$child = $parent;
			$parent_name = $ref->getParentClass()->name;
		}
	}


	/**
	 * @return bool
	 */
	public function hasParents() {
		return count($this->parents) > 0;
	}


	/**
	 * @var ActiveRecord
	 */
	protected $child;
	/**
	 * @var array
	 */
	protected $parents = array();
	/**
	 * @var array
	 */
	protected $parents_by_class = array();


	/**
	 * @param $class_name
	 *
	 * @return arParent
	 */
	public function getParentByClassName($class_name) {
		if ($class_name == self::ACTIVE_RECORD) {
			return NULL;
		}

		return $this->parents_by_class[$class_name];
	}


	/**
	 * @param $parent
	 */
	public function addParent(arParent $parent) {
		$this->parents[] = $parent;
		$this->parents_by_class[get_class($parent->getParent())] = $parent;
	}


	/**
	 * @return arParent[]
	 */
	public function getParents() {
		return $this->parents;
	}


	/**
	 * @param arParent[] $childs
	 */
	public function setParents($childs) {
		$this->parents = $childs;
	}


	/**
	 * @return ActiveRecord
	 */
	public function getChild() {
		return $this->child;
	}


	/**
	 * @param ActiveRecord $parent
	 */
	public function setChild($parent) {
		$this->child = $parent;
	}
}

?>