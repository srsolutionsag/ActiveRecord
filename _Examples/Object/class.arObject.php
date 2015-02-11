<?php
require_once(dirname(__FILE__) . '/../../class.ActiveRecord.php');

/**
 * Class arObject
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 2.1.0
 */
class arObject extends ActiveRecord {

	public function __construct($primary_key = 0) {
		parent::__construct($primary_key, new arConnectorPdoDB());
	}

	/**
	 * @return string
	 * @deprecated
	 */
	static function returnDbTableName() {
		return 'object_data';
	}


	/**
	 * @return string
	 */
	public function getConnectorContainerName() {
		return 'object_data';
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
	protected $obj_id;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    4
	 */
	protected $type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $title;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    128
	 */
	protected $description;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 */
	protected $owner;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $create_date;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $last_update;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    50
	 */
	protected $import_id;
}

?>