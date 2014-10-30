<?php
include_once('./Customizing/global/plugins/Libraries/ActiveRecord/Fields/class.arField.php');

/**
 * GUI-Class arViewField
 *
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arViewField extends arField
{
    /**
     * @var string
     */
    protected $txt = "";
    /**
     * @var int
     */
    protected $position = 1000;
    /**
     * @var bool
     */
    protected $visible = false;
    /**
     * @var bool
     */
    protected $custom_field = false;


    /**
     * @param $name
     * @param null $txt
     * @param int $position
     * @param bool $visible
     * @param bool $custom_field
     */
    function __construct($name, $txt = null, $position = 0, $visible = true, $custom_field = false)
    {
        $this->name     = $name;
        $this->position = $position;
        $this->txt      = $txt;
        $this->visible  = $visible;
        $this->custom_field = $custom_field;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $txt
     */
    public function setTxt($txt)
    {
        $this->txt = $txt;
    }

    /**
     * @return string
     */
    public function getTxt()
    {
        if($this->txt)
        {
            return $this->txt;
        }
        return $this->getName();

    }

    /**
     * @param string $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return string
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param boolean $custom_field
     */
    public function setCustomField($custom_field)
    {
        $this->custom_field = $custom_field;
    }

    /**
     * @return boolean
     */
    public function getCustomField()
    {
        return $this->custom_field;
    }


    /**
     * @param arField $field
     * @return arViewField
     */
    static function castFromFieldToViewField(arField $field)
    {
        require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Index/class.arIndexTableField.php');
        require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Edit/class.arEditField.php');
        require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Display/class.arDisplayField.php');

        $field_class = get_called_class();
        $obj = new $field_class($field->getName());
        foreach (get_object_vars($field) as $key => $name)
        {
            $obj->$key = $name;
        }
        return $obj;
    }
}