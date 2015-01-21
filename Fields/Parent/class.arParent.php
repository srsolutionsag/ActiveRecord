<?php

/**
 * Class arParent
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 2.1.0
 */
class arParent {

	const ACTIVE_RECORD = 'ActiveRecord';


	/**
	 * @param string $parent
	 *
	 * @return arParent
	 */
	public static function getInstance(ActiveRecord $child, ActiveRecord $parent) {
		return new self($child, $parent);
	}


	/**
	 * @param $child
	 * @param $parent
	 */
	protected function __construct(ActiveRecord $child, ActiveRecord $parent) {
		$this->setChild($child);
		$this->setParent($parent);
		$this->setChildTableName($child->getConnectorContainerName());
		$this->setParentTableName($parent->getConnectorContainerName());
		$this->initMapping();
	}


	protected function initMapping() {
		$ref = new ReflectionClass($this->getChild());
		$matches = array();
		preg_match_all("/@ar_mapping_(child|parent) *([a-zA-Z_0-9]*)/ui", $ref->getDocComment(), $matches);

		if (count($matches[2]) == 2) {
			$mapping_field_child = $matches[2][0];
			$this->setMappingFieldChild($mapping_field_child ? $mapping_field_child : NULL);
			$mapping_field_parent = $matches[2][1];
			$this->setMappingFieldParent($mapping_field_parent ? $mapping_field_parent : NULL);
		}
	}


	/**
	 * @return bool
	 */
	public function hasMapping() {
		return ($this->getMappingFieldChild() != NULL AND $this->getMappingFieldParent() != NULL);
	}


	/**
	 * @var ActiveRecord
	 */
	protected $parent = NULL;
	/**
	 * @var ActiveRecord
	 */
	protected $child = NULL;
	/**
	 * @var string
	 */
	protected $mapping_field_parent = '';
	/**
	 * @var string
	 */
	protected $mapping_field_child = '';
	/**
	 * @var string
	 */
	protected $parent_table_name = '';
	/**
	 * @var string
	 */
	protected $child_table_name = '';


	/**
	 * @return ActiveRecord
	 */
	public function getChild() {
		return $this->child;
	}


	/**
	 * @param ActiveRecord $child_name
	 */
	public function setChild($child_name) {
		$this->child = $child_name;
	}


	/**
	 * @return string
	 */
	public function getMappingFieldChild() {
		return $this->mapping_field_child;
	}


	/**
	 * @param string $mapping_field_child
	 */
	public function setMappingFieldChild($mapping_field_child) {
		$this->mapping_field_child = $mapping_field_child;
	}


	/**
	 * @return string
	 */
	public function getMappingFieldParent() {
		return $this->mapping_field_parent;
	}


	/**
	 * @param string $mapping_field_parent
	 */
	public function setMappingFieldParent($mapping_field_parent) {
		$this->mapping_field_parent = $mapping_field_parent;
	}


	/**
	 * @return ActiveRecord
	 */
	public function getParent() {
		return $this->parent;
	}


	/**
	 * @param ActiveRecord $parent_name
	 */
	public function setParent($parent_name) {
		$this->parent = $parent_name;
	}


	/**
	 * @return string
	 */
	public function getParentTableName() {
		return $this->parent_table_name;
	}


	/**
	 * @param string $parent_table_name
	 */
	public function setParentTableName($parent_table_name) {
		$this->parent_table_name = $parent_table_name;
	}


	/**
	 * @return string
	 */
	public function getChildTableName() {
		return $this->child_table_name;
	}


	/**
	 * @param string $child_table_name
	 */
	public function setChildTableName($child_table_name) {
		$this->child_table_name = $child_table_name;
	}
}

?>
