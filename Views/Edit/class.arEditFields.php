<?php
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/class.arViewField.php');
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/class.arViewFields.php');
/**
 * GUI-Class arEditFields
 *
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arEditFields extends arViewFields
{
    const FIELD_CLASS = 'arEditField';

    /**
     * @var arEditField
     */
    protected $created_by_field = null;

    /**
     * @var arEditField
     */
    protected $modified_by_field = null;

    /**
     * @var arEditField
     */
    protected $creation_date_field = null;

    /**
     * @var arEditField
     */
    protected $modification_date_field = null;

    /**
     * @param \arEditField $created_by_field
     */
    public function setCreatedByField($created_by_field)
    {
        $created_by_field->setIsCreatedByField(true);
        $this->created_by_field = $created_by_field;
    }

    /**
     * @return \arEditField
     */
    public function getCreatedByField()
    {
        if(!$this->created_by_field){
            foreach($this->getFields() as $field)
            {
                /**
                 * @var $field arEditField
                 */
                if($field->getIsCreatedByField()){
                    return $this->created_by_field = $field;
                }
            }
        }
        return $this->created_by_field;
    }

    /**
     * @return bool
     */
    public function sortFields()
    {
        uasort($this->fields, function (arEditField $field_a, arEditField $field_b)
        {
            //If both fields are or are not subelements, then let the position decide which is displayed first
            if(($field_a->getIsSubelementOf()==true) == ($field_b->getIsSubelementOf()==true)){
                return $field_a->getPosition() > $field_b->getPosition();
            }
            //If only one of the elements is a subelement, then the other has to be generated first
            else{
                return $field_a->getIsSubelementOf();
            }

        });
    }


    /**
     * @param \arEditField $creation_date_field
     */
    public function setCreationDateField($creation_date_field)
    {
        $creation_date_field->setIsCreationDateField(true);
        $this->creation_date_field = $creation_date_field;
    }

    /**
     * @return \arEditField
     */
    public function getCreationDateField()
    {
        if(!$this->creation_date_field){
            foreach($this->getFields() as $field)
            {
                /**
                 * @var $field arEditField
                 */
                if($field->getIsCreationDateField()){
                    return $this->creation_date_field = $field;
                }
            }
        }
        return $this->creation_date_field;
    }

    /**
     * @param \arEditField $modification_date_field
     */
    public function setModificationDateField($modification_date_field)
    {
        $modification_date_field->setIsModificationDateField(true);
        $this->modification_date_field = $modification_date_field;
    }

    /**
     * @return \arEditField
     */
    public function getModificationDateField()
    {
        if(!$this->modification_date_field){
            foreach($this->getFields() as $field)
            {
                /**
                 * @var $field arEditField
                 */
                if($field->getIsModificationDateField()){
                    return $this->modification_date_field = $field;
                }
            }
        }
        return $this->modification_date_field;
    }

    /**
     * @param \arEditField $modified_by_field
     */
    public function setModifiedByField($modified_by_field)
    {
        $modified_by_field->setIsModifiedByField(true);
        $this->modified_by_field = $modified_by_field;
    }

    /**
     * @return \arEditField
     */
    public function getModifiedByField()
    {
        if(!$this->modified_by_field){
            foreach($this->getFields() as $field)
            {
                /**
                 * @var $field arEditField
                 */
                if($field->getIsModifiedByField()){
                    return $this->modified_by_field = $field;
                }
            }
        }
        return $this->modified_by_field;
    }
}