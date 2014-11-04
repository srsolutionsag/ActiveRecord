<?php
include_once('./Customizing/global/plugins/Libraries/ActiveRecord/Fields/class.arField.php');
include_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/class.arViewField.php');
/**
 * GUI-Class arViewFields
 *
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arViewFields
{
    const FIELD_CLASS = 'arViewField';

    /**
     * @var arViewField[]
     */
    protected $fields = array();

    /**
     * @var arViewField[]
     */
    protected $fields_for_display = null;

    /**
     * @var ActiveRecord
     */
    protected $active_record = NULL;

    /**
     * @param ActiveRecord $ar
     */
    public function __construct(ActiveRecord $ar)
    {
        $this->active_record = $ar;
        $this->generateFields();
    }

    /**
     * @return bool
     */
    protected function generateFields()
    {
        $fields = $this->active_record->getArFieldList()->getFields();
        foreach ($fields as $standard_field)
        {
            $current_class = get_called_class();
            $field_class = $current_class::FIELD_CLASS;
            /**
             * @var arViewField $field_class
             */
            $field = $field_class::castFromFieldToViewField($standard_field);
            $this->addField($field);
        }
        return true;
    }

    /**
     * @param arViewField
     */
    public function addField(arViewField $field)
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * @return arViewField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return arViewField
     */
    public function getPrimaryField(){
        return $this->getField(arFieldCache::getPrimaryFieldName($this->active_record));
    }

    /**
     * @return bool
     */
    public function sortFields()
    {
        uasort($this->fields, function (arViewField $field_a, arViewField $field_b)
        {
            return $field_a->getPosition() > $field_b->getPosition();
        });
    }

    /**
     * @return arViewField[]
     */
    public function getFieldsForDisplay()
    {
        if(!$this->fields_for_display && $this->getFields())
        {
            foreach ($this->getFields() as $field)
            {
                if (($field->getVisible() || $field->getName() == arFieldCache::getPrimaryFieldName($this->active_record)))
                {
                    $this->fields_for_display[] = $field;
                }
            }
        }
        return $this->fields_for_display;
    }

    /**
     * @param $field_name
     * @return arViewField
     */
    public function getField($field_name)
    {
        return $this->fields[$field_name];
    }
}