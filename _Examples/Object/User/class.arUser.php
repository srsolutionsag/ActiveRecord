<?php
require_once(dirname(__FILE__) . '/../class.arObject.php');

/**
 * Class arUser
 *
 * @author            Fabian Schmid <fs@studer-raimann.ch>
 * @version           2.1.0
 *
 * @ar_mapping_child  usr_id
 * @ar_mapping_parent obj_id
 */
class arUser extends arObject {

	public function __construct($primary_key = 0) {
		parent::__construct($primary_key, new arConnectorPdoDB());
	}


	/**
	 * @return string
	 * @deprecated
	 */
	static function returnDbTableName() {
		return 'usr_data';
	}


	/**
	 * @return string
	 */
	public function getConnectorContainerName() {
		return 'usr_data';
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
	 * @con_sequence   true
	 */
	protected $usr_id;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    80
	 */
	protected $login;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    80
	 */
	protected $passwd;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $firstname;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $lastname;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $title;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    1
	 */
	protected $gender;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    80
	 */
	protected $email;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    80
	 */
	protected $institution;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $street;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $city;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    10
	 */
	protected $zipcode;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $country;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $phone_office;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $last_login;
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
	 * @con_fieldtype timestamp
	 */
	protected $create_date;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    4000
	 */
	protected $hobby;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    80
	 */
	protected $department;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $phone_home;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $phone_mobile;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $fax;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $time_limit_owner;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $time_limit_unlimited;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $time_limit_from;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $time_limit_until;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $time_limit_message;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    250
	 */
	protected $referral_comment;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $matriculation;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 */
	protected $active;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $approve_date;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $agree_date;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $ilinc_id;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $ilinc_login;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $ilinc_passwd;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    255
	 */
	protected $client_ip;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    10
	 */
	protected $auth_mode;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype integer
	 * @con_length    4
	 */
	protected $profile_incomplete;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    250
	 */
	protected $ext_account;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_icq;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_yahoo;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_msn;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_aim;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_skype;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $feed_hash;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $delicious;
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
	protected $loc_zoom;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $login_attempts;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     4
	 * @con_is_notnull true
	 */
	protected $last_password_change;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_jabber;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    40
	 */
	protected $im_voip;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $reg_hash;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $birthday;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    2
	 */
	protected $sel_country;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $last_visited;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype timestamp
	 */
	protected $inactivation_date;
	/**
	 * @var
	 *
	 * @con_has_field  true
	 * @con_fieldtype  integer
	 * @con_length     1
	 * @con_is_notnull true
	 */
	protected $is_self_registered;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    10
	 */
	protected $passwd_enc_type;
	/**
	 * @var
	 *
	 * @con_has_field true
	 * @con_fieldtype text
	 * @con_length    32
	 */
	protected $passwd_salt;


	/**
	 * @return mixed
	 */
	public function getActive() {
		return $this->active;
	}


	/**
	 * @param mixed $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}


	/**
	 * @return mixed
	 */
	public function getAgreeDate() {
		return $this->agree_date;
	}


	/**
	 * @param mixed $agree_date
	 */
	public function setAgreeDate($agree_date) {
		$this->agree_date = $agree_date;
	}


	/**
	 * @return mixed
	 */
	public function getApproveDate() {
		return $this->approve_date;
	}


	/**
	 * @param mixed $approve_date
	 */
	public function setApproveDate($approve_date) {
		$this->approve_date = $approve_date;
	}


	/**
	 * @return mixed
	 */
	public function getAuthMode() {
		return $this->auth_mode;
	}


	/**
	 * @param mixed $auth_mode
	 */
	public function setAuthMode($auth_mode) {
		$this->auth_mode = $auth_mode;
	}


	/**
	 * @return mixed
	 */
	public function getBirthday() {
		return $this->birthday;
	}


	/**
	 * @param mixed $birthday
	 */
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
	}


	/**
	 * @return mixed
	 */
	public function getCity() {
		return $this->city;
	}


	/**
	 * @param mixed $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}


	/**
	 * @return mixed
	 */
	public function getClientIp() {
		return $this->client_ip;
	}


	/**
	 * @param mixed $client_ip
	 */
	public function setClientIp($client_ip) {
		$this->client_ip = $client_ip;
	}


	/**
	 * @return mixed
	 */
	public function getCountry() {
		return $this->country;
	}


	/**
	 * @param mixed $country
	 */
	public function setCountry($country) {
		$this->country = $country;
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
	public function getDelicious() {
		return $this->delicious;
	}


	/**
	 * @param mixed $delicious
	 */
	public function setDelicious($delicious) {
		$this->delicious = $delicious;
	}


	/**
	 * @return mixed
	 */
	public function getDepartment() {
		return $this->department;
	}


	/**
	 * @param mixed $department
	 */
	public function setDepartment($department) {
		$this->department = $department;
	}


	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}


	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}


	/**
	 * @return mixed
	 */
	public function getExtAccount() {
		return $this->ext_account;
	}


	/**
	 * @param mixed $ext_account
	 */
	public function setExtAccount($ext_account) {
		$this->ext_account = $ext_account;
	}


	/**
	 * @return mixed
	 */
	public function getFax() {
		return $this->fax;
	}


	/**
	 * @param mixed $fax
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}


	/**
	 * @return mixed
	 */
	public function getFeedHash() {
		return $this->feed_hash;
	}


	/**
	 * @param mixed $feed_hash
	 */
	public function setFeedHash($feed_hash) {
		$this->feed_hash = $feed_hash;
	}


	/**
	 * @return mixed
	 */
	public function getFirstname() {
		return $this->firstname;
	}


	/**
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}


	/**
	 * @return mixed
	 */
	public function getGender() {
		return $this->gender;
	}


	/**
	 * @param mixed $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}


	/**
	 * @return mixed
	 */
	public function getHobby() {
		return $this->hobby;
	}


	/**
	 * @param mixed $hobby
	 */
	public function setHobby($hobby) {
		$this->hobby = $hobby;
	}


	/**
	 * @return mixed
	 */
	public function getIlincId() {
		return $this->ilinc_id;
	}


	/**
	 * @param mixed $ilinc_id
	 */
	public function setIlincId($ilinc_id) {
		$this->ilinc_id = $ilinc_id;
	}


	/**
	 * @return mixed
	 */
	public function getIlincLogin() {
		return $this->ilinc_login;
	}


	/**
	 * @param mixed $ilinc_login
	 */
	public function setIlincLogin($ilinc_login) {
		$this->ilinc_login = $ilinc_login;
	}


	/**
	 * @return mixed
	 */
	public function getIlincPasswd() {
		return $this->ilinc_passwd;
	}


	/**
	 * @param mixed $ilinc_passwd
	 */
	public function setIlincPasswd($ilinc_passwd) {
		$this->ilinc_passwd = $ilinc_passwd;
	}


	/**
	 * @return mixed
	 */
	public function getImAim() {
		return $this->im_aim;
	}


	/**
	 * @param mixed $im_aim
	 */
	public function setImAim($im_aim) {
		$this->im_aim = $im_aim;
	}


	/**
	 * @return mixed
	 */
	public function getImIcq() {
		return $this->im_icq;
	}


	/**
	 * @param mixed $im_icq
	 */
	public function setImIcq($im_icq) {
		$this->im_icq = $im_icq;
	}


	/**
	 * @return mixed
	 */
	public function getImJabber() {
		return $this->im_jabber;
	}


	/**
	 * @param mixed $im_jabber
	 */
	public function setImJabber($im_jabber) {
		$this->im_jabber = $im_jabber;
	}


	/**
	 * @return mixed
	 */
	public function getImMsn() {
		return $this->im_msn;
	}


	/**
	 * @param mixed $im_msn
	 */
	public function setImMsn($im_msn) {
		$this->im_msn = $im_msn;
	}


	/**
	 * @return mixed
	 */
	public function getImSkype() {
		return $this->im_skype;
	}


	/**
	 * @param mixed $im_skype
	 */
	public function setImSkype($im_skype) {
		$this->im_skype = $im_skype;
	}


	/**
	 * @return mixed
	 */
	public function getImVoip() {
		return $this->im_voip;
	}


	/**
	 * @param mixed $im_voip
	 */
	public function setImVoip($im_voip) {
		$this->im_voip = $im_voip;
	}


	/**
	 * @return mixed
	 */
	public function getImYahoo() {
		return $this->im_yahoo;
	}


	/**
	 * @param mixed $im_yahoo
	 */
	public function setImYahoo($im_yahoo) {
		$this->im_yahoo = $im_yahoo;
	}


	/**
	 * @return mixed
	 */
	public function getInactivationDate() {
		return $this->inactivation_date;
	}


	/**
	 * @param mixed $inactivation_date
	 */
	public function setInactivationDate($inactivation_date) {
		$this->inactivation_date = $inactivation_date;
	}


	/**
	 * @return mixed
	 */
	public function getInstitution() {
		return $this->institution;
	}


	/**
	 * @param mixed $institution
	 */
	public function setInstitution($institution) {
		$this->institution = $institution;
	}


	/**
	 * @return mixed
	 */
	public function getIsSelfRegistered() {
		return $this->is_self_registered;
	}


	/**
	 * @param mixed $is_self_registered
	 */
	public function setIsSelfRegistered($is_self_registered) {
		$this->is_self_registered = $is_self_registered;
	}


	/**
	 * @return mixed
	 */
	public function getLastLogin() {
		return $this->last_login;
	}


	/**
	 * @param mixed $last_login
	 */
	public function setLastLogin($last_login) {
		$this->last_login = $last_login;
	}


	/**
	 * @return mixed
	 */
	public function getLastPasswordChange() {
		return $this->last_password_change;
	}


	/**
	 * @param mixed $last_password_change
	 */
	public function setLastPasswordChange($last_password_change) {
		$this->last_password_change = $last_password_change;
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
	public function getLastVisited() {
		return $this->last_visited;
	}


	/**
	 * @param mixed $last_visited
	 */
	public function setLastVisited($last_visited) {
		$this->last_visited = $last_visited;
	}


	/**
	 * @return mixed
	 */
	public function getLastname() {
		return $this->lastname;
	}


	/**
	 * @param mixed $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
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
	public function getLocZoom() {
		return $this->loc_zoom;
	}


	/**
	 * @param mixed $loc_zoom
	 */
	public function setLocZoom($loc_zoom) {
		$this->loc_zoom = $loc_zoom;
	}


	/**
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}


	/**
	 * @param mixed $login
	 */
	public function setLogin($login) {
		$this->login = $login;
	}


	/**
	 * @return mixed
	 */
	public function getLoginAttempts() {
		return $this->login_attempts;
	}


	/**
	 * @param mixed $login_attempts
	 */
	public function setLoginAttempts($login_attempts) {
		$this->login_attempts = $login_attempts;
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
	public function getMatriculation() {
		return $this->matriculation;
	}


	/**
	 * @param mixed $matriculation
	 */
	public function setMatriculation($matriculation) {
		$this->matriculation = $matriculation;
	}


	/**
	 * @return mixed
	 */
	public function getPasswd() {
		return $this->passwd;
	}


	/**
	 * @param mixed $passwd
	 */
	public function setPasswd($passwd) {
		$this->passwd = $passwd;
	}


	/**
	 * @return mixed
	 */
	public function getPasswdEncType() {
		return $this->passwd_enc_type;
	}


	/**
	 * @param mixed $passwd_enc_type
	 */
	public function setPasswdEncType($passwd_enc_type) {
		$this->passwd_enc_type = $passwd_enc_type;
	}


	/**
	 * @return mixed
	 */
	public function getPasswdSalt() {
		return $this->passwd_salt;
	}


	/**
	 * @param mixed $passwd_salt
	 */
	public function setPasswdSalt($passwd_salt) {
		$this->passwd_salt = $passwd_salt;
	}


	/**
	 * @return mixed
	 */
	public function getPhoneHome() {
		return $this->phone_home;
	}


	/**
	 * @param mixed $phone_home
	 */
	public function setPhoneHome($phone_home) {
		$this->phone_home = $phone_home;
	}


	/**
	 * @return mixed
	 */
	public function getPhoneMobile() {
		return $this->phone_mobile;
	}


	/**
	 * @param mixed $phone_mobile
	 */
	public function setPhoneMobile($phone_mobile) {
		$this->phone_mobile = $phone_mobile;
	}


	/**
	 * @return mixed
	 */
	public function getPhoneOffice() {
		return $this->phone_office;
	}


	/**
	 * @param mixed $phone_office
	 */
	public function setPhoneOffice($phone_office) {
		$this->phone_office = $phone_office;
	}


	/**
	 * @return mixed
	 */
	public function getProfileIncomplete() {
		return $this->profile_incomplete;
	}


	/**
	 * @param mixed $profile_incomplete
	 */
	public function setProfileIncomplete($profile_incomplete) {
		$this->profile_incomplete = $profile_incomplete;
	}


	/**
	 * @return mixed
	 */
	public function getReferralComment() {
		return $this->referral_comment;
	}


	/**
	 * @param mixed $referral_comment
	 */
	public function setReferralComment($referral_comment) {
		$this->referral_comment = $referral_comment;
	}


	/**
	 * @return mixed
	 */
	public function getRegHash() {
		return $this->reg_hash;
	}


	/**
	 * @param mixed $reg_hash
	 */
	public function setRegHash($reg_hash) {
		$this->reg_hash = $reg_hash;
	}


	/**
	 * @return mixed
	 */
	public function getSelCountry() {
		return $this->sel_country;
	}


	/**
	 * @param mixed $sel_country
	 */
	public function setSelCountry($sel_country) {
		$this->sel_country = $sel_country;
	}


	/**
	 * @return mixed
	 */
	public function getStreet() {
		return $this->street;
	}


	/**
	 * @param mixed $street
	 */
	public function setStreet($street) {
		$this->street = $street;
	}


	/**
	 * @return mixed
	 */
	public function getTimeLimitFrom() {
		return $this->time_limit_from;
	}


	/**
	 * @param mixed $time_limit_from
	 */
	public function setTimeLimitFrom($time_limit_from) {
		$this->time_limit_from = $time_limit_from;
	}


	/**
	 * @return mixed
	 */
	public function getTimeLimitMessage() {
		return $this->time_limit_message;
	}


	/**
	 * @param mixed $time_limit_message
	 */
	public function setTimeLimitMessage($time_limit_message) {
		$this->time_limit_message = $time_limit_message;
	}


	/**
	 * @return mixed
	 */
	public function getTimeLimitOwner() {
		return $this->time_limit_owner;
	}


	/**
	 * @param mixed $time_limit_owner
	 */
	public function setTimeLimitOwner($time_limit_owner) {
		$this->time_limit_owner = $time_limit_owner;
	}


	/**
	 * @return mixed
	 */
	public function getTimeLimitUnlimited() {
		return $this->time_limit_unlimited;
	}


	/**
	 * @param mixed $time_limit_unlimited
	 */
	public function setTimeLimitUnlimited($time_limit_unlimited) {
		$this->time_limit_unlimited = $time_limit_unlimited;
	}


	/**
	 * @return mixed
	 */
	public function getTimeLimitUntil() {
		return $this->time_limit_until;
	}


	/**
	 * @param mixed $time_limit_until
	 */
	public function setTimeLimitUntil($time_limit_until) {
		$this->time_limit_until = $time_limit_until;
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
	public function getUsrId() {
		return $this->usr_id;
	}


	/**
	 * @param mixed $usr_id
	 */
	public function setUsrId($usr_id) {
		$this->usr_id = $usr_id;
	}


	/**
	 * @return mixed
	 */
	public function getZipcode() {
		return $this->zipcode;
	}


	/**
	 * @param mixed $zipcode
	 */
	public function setZipcode($zipcode) {
		$this->zipcode = $zipcode;
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