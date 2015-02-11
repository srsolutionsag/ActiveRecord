<?php
require_once(dirname(__FILE__) . '/../class.arObject.php');
/**
 * Class arCourseSetting
 *
 * @author            Fabian Schmid <fs@studer-raimann.ch>
 * @version           2.1.0
 *
 * @ar_mapping_child  obj_id
 * @ar_mapping_parent obj_id
 */
class arCourseSetting extends arObject {

	/**
	 * @return string
	 * @deprecated
	 */
	static function returnDbTableName() {
		return 'crs_settings';
	}


	/**
	 * @return string
	 */
	public function getConnectorContainerName() {
		return 'crs_settings';
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
	 * @con_length    4000
	 */
	protected $syllabus;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $contact_name;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $contact_responsibility;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $contact_phone;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $contact_email;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    4000
	 */
	protected $contact_consultation;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $activation_type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $activation_start;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $activation_end;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $sub_limitation_type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sub_start;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sub_end;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sub_type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $sub_password;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $sub_mem_limit;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sub_max_members;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sub_notify;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $view_mode;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $sortorder;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $archive_start;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $archive_end;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $archive_type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    1
	 */
	protected $abo;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $waiting_list;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    4000
	 */
	protected $important;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $show_members;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    30
	 */
	protected $latitude;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    30
	 */
	protected $longitude;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 */
	protected $location_zoom;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $enable_course_map;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $session_limit;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     20
	 * @con_is_notnull true
	 */
	protected $session_prev;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     20
	 * @con_is_notnull true
	 */
	protected $session_next;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $reg_ac_enabled;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $reg_ac;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    1
	 */
	protected $status_dt;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $auto_notification;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    1
	 */
	protected $mail_members_type;


	/**
	 * @return mixed
	 */
	public function getAbo() {
		return $this->abo;
	}


	/**
	 * @param mixed $abo
	 */
	public function setAbo($abo) {
		$this->abo = $abo;
	}


	/**
	 * @return mixed
	 */
	public function getActivationEnd() {
		return $this->activation_end;
	}


	/**
	 * @param mixed $activation_end
	 */
	public function setActivationEnd($activation_end) {
		$this->activation_end = $activation_end;
	}


	/**
	 * @return mixed
	 */
	public function getActivationStart() {
		return $this->activation_start;
	}


	/**
	 * @param mixed $activation_start
	 */
	public function setActivationStart($activation_start) {
		$this->activation_start = $activation_start;
	}


	/**
	 * @return mixed
	 */
	public function getActivationType() {
		return $this->activation_type;
	}


	/**
	 * @param mixed $activation_type
	 */
	public function setActivationType($activation_type) {
		$this->activation_type = $activation_type;
	}


	/**
	 * @return mixed
	 */
	public function getArchiveEnd() {
		return $this->archive_end;
	}


	/**
	 * @param mixed $archive_end
	 */
	public function setArchiveEnd($archive_end) {
		$this->archive_end = $archive_end;
	}


	/**
	 * @return mixed
	 */
	public function getArchiveStart() {
		return $this->archive_start;
	}


	/**
	 * @param mixed $archive_start
	 */
	public function setArchiveStart($archive_start) {
		$this->archive_start = $archive_start;
	}


	/**
	 * @return mixed
	 */
	public function getArchiveType() {
		return $this->archive_type;
	}


	/**
	 * @param mixed $archive_type
	 */
	public function setArchiveType($archive_type) {
		$this->archive_type = $archive_type;
	}


	/**
	 * @return mixed
	 */
	public function getAutoNotification() {
		return $this->auto_notification;
	}


	/**
	 * @param mixed $auto_notification
	 */
	public function setAutoNotification($auto_notification) {
		$this->auto_notification = $auto_notification;
	}


	/**
	 * @return mixed
	 */
	public function getContactConsultation() {
		return $this->contact_consultation;
	}


	/**
	 * @param mixed $contact_consultation
	 */
	public function setContactConsultation($contact_consultation) {
		$this->contact_consultation = $contact_consultation;
	}


	/**
	 * @return mixed
	 */
	public function getContactEmail() {
		return $this->contact_email;
	}


	/**
	 * @param mixed $contact_email
	 */
	public function setContactEmail($contact_email) {
		$this->contact_email = $contact_email;
	}


	/**
	 * @return mixed
	 */
	public function getContactName() {
		return $this->contact_name;
	}


	/**
	 * @param mixed $contact_name
	 */
	public function setContactName($contact_name) {
		$this->contact_name = $contact_name;
	}


	/**
	 * @return mixed
	 */
	public function getContactPhone() {
		return $this->contact_phone;
	}


	/**
	 * @param mixed $contact_phone
	 */
	public function setContactPhone($contact_phone) {
		$this->contact_phone = $contact_phone;
	}


	/**
	 * @return mixed
	 */
	public function getContactResponsibility() {
		return $this->contact_responsibility;
	}


	/**
	 * @param mixed $contact_responsibility
	 */
	public function setContactResponsibility($contact_responsibility) {
		$this->contact_responsibility = $contact_responsibility;
	}


	/**
	 * @return mixed
	 */
	public function getEnableCourseMap() {
		return $this->enable_course_map;
	}


	/**
	 * @param mixed $enable_course_map
	 */
	public function setEnableCourseMap($enable_course_map) {
		$this->enable_course_map = $enable_course_map;
	}


	/**
	 * @return mixed
	 */
	public function getImportant() {
		return $this->important;
	}


	/**
	 * @param mixed $important
	 */
	public function setImportant($important) {
		$this->important = $important;
	}


	/**
	 * @return mixed
	 */
	public function getLatitude() {
		return $this->latitude;
	}


	/**
	 * @param mixed $latitude
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}


	/**
	 * @return mixed
	 */
	public function getLocationZoom() {
		return $this->location_zoom;
	}


	/**
	 * @param mixed $location_zoom
	 */
	public function setLocationZoom($location_zoom) {
		$this->location_zoom = $location_zoom;
	}


	/**
	 * @return mixed
	 */
	public function getLongitude() {
		return $this->longitude;
	}


	/**
	 * @param mixed $longitude
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}


	/**
	 * @return mixed
	 */
	public function getMailMembersType() {
		return $this->mail_members_type;
	}


	/**
	 * @param mixed $mail_members_type
	 */
	public function setMailMembersType($mail_members_type) {
		$this->mail_members_type = $mail_members_type;
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
	public function getRegAc() {
		return $this->reg_ac;
	}


	/**
	 * @param mixed $reg_ac
	 */
	public function setRegAc($reg_ac) {
		$this->reg_ac = $reg_ac;
	}


	/**
	 * @return mixed
	 */
	public function getRegAcEnabled() {
		return $this->reg_ac_enabled;
	}


	/**
	 * @param mixed $reg_ac_enabled
	 */
	public function setRegAcEnabled($reg_ac_enabled) {
		$this->reg_ac_enabled = $reg_ac_enabled;
	}


	/**
	 * @return mixed
	 */
	public function getSessionLimit() {
		return $this->session_limit;
	}


	/**
	 * @param mixed $session_limit
	 */
	public function setSessionLimit($session_limit) {
		$this->session_limit = $session_limit;
	}


	/**
	 * @return mixed
	 */
	public function getSessionNext() {
		return $this->session_next;
	}


	/**
	 * @param mixed $session_next
	 */
	public function setSessionNext($session_next) {
		$this->session_next = $session_next;
	}


	/**
	 * @return mixed
	 */
	public function getSessionPrev() {
		return $this->session_prev;
	}


	/**
	 * @param mixed $session_prev
	 */
	public function setSessionPrev($session_prev) {
		$this->session_prev = $session_prev;
	}


	/**
	 * @return mixed
	 */
	public function getShowMembers() {
		return $this->show_members;
	}


	/**
	 * @param mixed $show_members
	 */
	public function setShowMembers($show_members) {
		$this->show_members = $show_members;
	}


	/**
	 * @return mixed
	 */
	public function getSortorder() {
		return $this->sortorder;
	}


	/**
	 * @param mixed $sortorder
	 */
	public function setSortorder($sortorder) {
		$this->sortorder = $sortorder;
	}


	/**
	 * @return mixed
	 */
	public function getStatusDt() {
		return $this->status_dt;
	}


	/**
	 * @param mixed $status_dt
	 */
	public function setStatusDt($status_dt) {
		$this->status_dt = $status_dt;
	}


	/**
	 * @return mixed
	 */
	public function getSubEnd() {
		return $this->sub_end;
	}


	/**
	 * @param mixed $sub_end
	 */
	public function setSubEnd($sub_end) {
		$this->sub_end = $sub_end;
	}


	/**
	 * @return mixed
	 */
	public function getSubLimitationType() {
		return $this->sub_limitation_type;
	}


	/**
	 * @param mixed $sub_limitation_type
	 */
	public function setSubLimitationType($sub_limitation_type) {
		$this->sub_limitation_type = $sub_limitation_type;
	}


	/**
	 * @return mixed
	 */
	public function getSubMaxMembers() {
		return $this->sub_max_members;
	}


	/**
	 * @param mixed $sub_max_members
	 */
	public function setSubMaxMembers($sub_max_members) {
		$this->sub_max_members = $sub_max_members;
	}


	/**
	 * @return mixed
	 */
	public function getSubMemLimit() {
		return $this->sub_mem_limit;
	}


	/**
	 * @param mixed $sub_mem_limit
	 */
	public function setSubMemLimit($sub_mem_limit) {
		$this->sub_mem_limit = $sub_mem_limit;
	}


	/**
	 * @return mixed
	 */
	public function getSubNotify() {
		return $this->sub_notify;
	}


	/**
	 * @param mixed $sub_notify
	 */
	public function setSubNotify($sub_notify) {
		$this->sub_notify = $sub_notify;
	}


	/**
	 * @return mixed
	 */
	public function getSubPassword() {
		return $this->sub_password;
	}


	/**
	 * @param mixed $sub_password
	 */
	public function setSubPassword($sub_password) {
		$this->sub_password = $sub_password;
	}


	/**
	 * @return mixed
	 */
	public function getSubStart() {
		return $this->sub_start;
	}


	/**
	 * @param mixed $sub_start
	 */
	public function setSubStart($sub_start) {
		$this->sub_start = $sub_start;
	}


	/**
	 * @return mixed
	 */
	public function getSubType() {
		return $this->sub_type;
	}


	/**
	 * @param mixed $sub_type
	 */
	public function setSubType($sub_type) {
		$this->sub_type = $sub_type;
	}


	/**
	 * @return mixed
	 */
	public function getSyllabus() {
		return $this->syllabus;
	}


	/**
	 * @param mixed $syllabus
	 */
	public function setSyllabus($syllabus) {
		$this->syllabus = $syllabus;
	}


	/**
	 * @return mixed
	 */
	public function getViewMode() {
		return $this->view_mode;
	}


	/**
	 * @param mixed $view_mode
	 */
	public function setViewMode($view_mode) {
		$this->view_mode = $view_mode;
	}


	/**
	 * @return mixed
	 */
	public function getWaitingList() {
		return $this->waiting_list;
	}


	/**
	 * @param mixed $waiting_list
	 */
	public function setWaitingList($waiting_list) {
		$this->waiting_list = $waiting_list;
	}


	/**
	 * @return boolean
	 */
	public function isArSafeRead() {
		return $this->ar_safe_read;
	}


	/**
	 * @param boolean $ar_safe_read
	 */
	public function setArSafeRead($ar_safe_read) {
		$this->ar_safe_read = $ar_safe_read;
	}


	/**
	 * @return mixed
	 */
	public function getCreateDate() {
		return $this->create_date;
	}


	/**
	 * @param mixed $create_date
	 */
	public function setCreateDate($create_date) {
		$this->create_date = $create_date;
	}


	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}


	/**
	 * @param mixed $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}


	/**
	 * @return mixed
	 */
	public function getImportId() {
		return $this->import_id;
	}


	/**
	 * @param mixed $import_id
	 */
	public function setImportId($import_id) {
		$this->import_id = $import_id;
	}


	/**
	 * @return mixed
	 */
	public function getLastUpdate() {
		return $this->last_update;
	}


	/**
	 * @param mixed $last_update
	 */
	public function setLastUpdate($last_update) {
		$this->last_update = $last_update;
	}


	/**
	 * @return mixed
	 */
	public function getOwner() {
		return $this->owner;
	}


	/**
	 * @param mixed $owner
	 */
	public function setOwner($owner) {
		$this->owner = $owner;
	}


	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}


	/**
	 * @param mixed $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}


	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}


	/**
	 * @param mixed $type
	 */
	public function setType($type) {
		$this->type = $type;
	}


	/**
	 * @return int
	 */
	public function getKey() {
		return $this->key;
	}


	/**
	 * @param int $key
	 */
	public function setKey($key) {
		$this->key = $key;
	}
}

?>