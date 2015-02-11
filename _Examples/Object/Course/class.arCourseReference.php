<?php

require_once('class.arCourseSetting.php');

/**
 * Class arCourseReference
 *
 * @author            Fabian Schmid <fs@studer-raimann.ch>
 * @version           2.1.0
 *
 * @ar_mapping_child  obj_id
 * @ar_mapping_parent obj_id
 * @ar_table_name     object_reference
 */
class arCourseReference extends arCourseSetting {

	/**
	 * @return string
	 * @deprecated
	 */
	static function returnDbTableName() {
		return 'object_reference';
	}


	/**
	 * @return string
	 */
	public function getConnectorContainerName() {
		return 'object_reference';
	}


	/**
	 * @return array
	 */
	public function getParentMapping() {
		return array( 'obj_id' => 'obj_id' );
	}


	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 * @con_is_primary true
	 * @con_is_unique  true
	 */
	protected $ref_id;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 */
	protected $obj_id;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype
	 * @con_length
	 */
	protected $deleted;


	/**
	 * @return mixed
	 */
	public function getDeleted() {
		return $this->deleted;
	}


	/**
	 * @param mixed $deleted
	 */
	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}


	/**
	 * @return mixed
	 */
	public function getObjId() {
		return $this->obj_id;
	}


	/**
	 * @param mixed $obj_id
	 */
	public function setObjId($obj_id) {
		$this->obj_id = $obj_id;
	}


	/**
	 * @return mixed
	 */
	public function getRefId() {
		return $this->ref_id;
	}


	/**
	 * @param mixed $ref_id
	 */
	public function setRefId($ref_id) {
		$this->ref_id = $ref_id;
	}
}

?>