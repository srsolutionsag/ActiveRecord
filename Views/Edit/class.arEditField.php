<?php
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/class.arViewField.php');
/**
 * GUI-Class arEditField
 *
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arEditField extends arViewField
{
    /**
     * @var arEditField
     */
    protected $is_subelement_of = null;

    /**
     * @var bool
     */
    protected $is_created_by_field = false;

    /**
     * @var bool
     */
    protected $is_modified_by_field = false;

    /**
     * @var bool
     */
    protected $is_creation_date_field = false;

    /**
     * @var bool
     */
    protected $is_modification_date_field = false;

    /**
     * @var bool
     */
    protected $is_boolean = false;

    /**
     * @param $is_creation_date_field
     */
    public function setIsCreationDateField($is_creation_date_field)
    {
        if($is_creation_date_field){
            $this->setVisible(false);
        }
        $this->is_creation_date_field = $is_creation_date_field;
    }

    /**
     * @return boolean
     */
    public function getIsCreationDateField()
    {
        return $this->is_creation_date_field;
    }

    /**
     * @param boolean $is_created_by_field
     */
    public function setIsCreatedByField($is_created_by_field)
    {
        if($is_created_by_field){
            $this->setVisible(false);
        }
        $this->is_created_by_field = $is_created_by_field;
    }

    /**
     * @return boolean
     */
    public function getIsCreatedByField()
    {
        return $this->is_created_by_field;
    }

    /**
     * @param boolean $is_modified_by_field
     */
    public function setIsModifiedByField($is_modified_by_field)
    {
        if($is_modified_by_field){
            $this->setVisible(false);
        }
        $this->is_modified_by_field = $is_modified_by_field;
    }

    /**
     * @return boolean
     */
    public function getIsModifiedByField()
    {
        return $this->is_modified_by_field;
    }

    /**
     * @param \arEditField $is_subelement_of
     */
    public function setIsSubelementOf($is_subelement_of)
    {
        $this->is_subelement_of = $is_subelement_of;
    }

    /**
     * @return \arEditField
     */
    public function getIsSubelementOf()
    {
        return $this->is_subelement_of;
    }

    /**
     * @param $is_modification_date_field
     */
    public function setIsModificationDateField($is_modification_date_field)
    {
        if($is_modification_date_field){
            $this->setVisible(false);
        }
        $this->is_modification_date_field = $is_modification_date_field;
    }

    /**
     * @return boolean
     */
    public function getIsModificationDateField()
    {
        return $this->is_modification_date_field;
    }

    /**
     * @param boolean $is_boolean
     */
    public function setIsBoolean($is_boolean)
    {
        $this->is_boolean = $is_boolean;
    }

    /**
     * @return boolean
     */
    public function getIsBoolean()
    {
        return $this->is_boolean;
    }

}