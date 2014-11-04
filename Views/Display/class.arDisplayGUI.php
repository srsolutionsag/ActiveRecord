<?php
require_once('./Services/Form/classes/class.ilPropertyFormGUI.php');
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Display/class.arDisplayField.php');
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Display/class.arDisplayFields.php');

/**
 * GUI-Class arDisplayGUI
 *
 * @author            Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arDisplayGUI{

	/**
	 * @var  ActiveRecord
	 */
	protected $record;
	/**
	 * @var arGUI
	 */
	protected $parent_gui;
	/**
	 * @var  ilCtrl
	 */
	protected $ctrl;
	/**
	 * @var  ilTemplate
	 */
	protected $tpl;
	/**
	 * @var string
	 */
	protected $title = "";
    /**
     * @var arDisplayFields|array
     */
    protected $fields = array();
	/**
	 * @var array
	 */
	protected $data = array();
	/**
	 * @var string
	 */
	protected $back_button_name = "";
	/**
	 * @var string
	 */
	protected $back_button_target = "";


    /**
     * @param arGUI $parent_gui
     * @param ActiveRecord $ar
     * @param string $title
     */
    public function __construct(arGUI $parent_gui, ActiveRecord $ar, $title = "") {
		global $ilCtrl, $tpl;
		$this->ctrl = $ilCtrl;
		$this->tpl = $tpl;
		$this->ar = $ar;
		$this->parent_gui = $parent_gui;

        if(!$title)
        {
            $title = strtolower(str_replace("Record", "", get_class($ar)));
        }
        $this->setTitle($this->txt($title));

        $this->init();
	}

    protected function init(){
        $this->initFields();
        $this->initBackButton();
        $this->ctrl->saveParameter($parent_gui, 'ar_id');
    }

    protected function initFields(){
        $this->fields = new arDisplayFields($this->ar);
        $this->customizeFields();
        $this->fields->sortFields();
    }

    public function customizeFields()
    {
    }

    public function initBackButton(){
        $this->setBackButtonName($this->txt("back", false));
        $this->setBackButtonTarget($this->ctrl->getLinkTarget($this->parent_gui, "index"));
    }


    /**
     * @return string
     */
    public function getHtml() {
		$tpl_display = new ilTemplate("tpl.display.html", true, true, "Customizing/global/plugins/Libraries/ActiveRecord");

		$tpl_display->setVariable("TITLE", $this->title);

        foreach ($this->fields->getFields() as $field) {
            /**
             * @var arDisplayField $field
             */
            if ($field->getVisible()) {
                $get_function = "get" . $this->ar->_toCamelCase($field->getName(), true);
                $value = $this->ar->$get_function();

                $tpl_display->setCurrentBlock("entry");
                $tpl_display->setVariable("ITEM", $this->txt($field->getTxt()));
                $tpl_display->setVariable("VALUE", $this->setArFieldData($field, $value));
                $tpl_display->parseCurrentBlock();
            }
        }

		$tpl_display->setVariable("BACK_BUTTON_NAME", $this->getBackButtonName());
		$tpl_display->setVariable("BACK_BUTTON_TARGET", $this->getBackButtonTarget());

		return $tpl_display->get();
	}

    /**
     * @param arDisplayField $field
     * @param $value
     * @return null|string
     */
    protected function setArFieldData(arDisplayField $field,$value) {
        if($field->getCustomField()){
            return $this->setCustomFieldData($field);
        }
        else if($value == null){
            return $this->setEmptyFieldData($field);
        }
        else{
            $field_value = null;
            switch ($field->getFieldType()) {
                case 'integer':
                case 'float':
                    $field_value = $this->setNumericData($field, $value);
                    break;
                case 'text':
                    $field_value = $this->setTextData($field, $value);
                    break;
                case 'date':
                case 'time':
                case 'timestamp':
                    $field_value = $this->setDateTimeData($field, $value);
                    break;
                case 'clob':
                    $field_value = $this->setClobData($field, $value);
                    break;
            }
        }

        return $field_value;
    }

    /**
     * @param arDisplayField $field
     * @return string
     */
    protected function setEmptyFieldData(arDisplayField $field){
        return $this->txt("",false);
    }

    /**
     * @param arDisplayField $field
     * @return string
     */
    protected function setCustomFieldData(arDisplayField $field)
    {
        return "CUSTOM-OVERRIDE: setCustomFieldData";
    }

    /**
     * @param arDisplayField $field
     * @param $value
     * @return mixed
     */
    protected function setNumericData(arDisplayField $field, $value) {
        return $value;
    }


    /**
     * @param arDisplayField $field
     * @param $value
     * @return mixed
     */
    protected function setTextData(arDisplayField $field, $value) {
        return $value;
    }


    /**
     * @param arDisplayField $field
     * @param $value
     * @return string
     */
    protected function setDateTimeData(arDisplayField $field, $value) {
        $datetime = new ilDateTime($value, IL_CAL_DATETIME);
        return ilDatePresentation::formatDate($datetime, IL_CAL_DATETIME);
    }


    /**
     * @param arDisplayField $field
     * @param $value
     * @return mixed
     */
    protected function setClobData(arDisplayField $field, $value) {
        return $value;
    }


	/**
	 * @param string $back_button_name
	 */
	public function setBackButtonName($back_button_name) {
		$this->back_button_name = $back_button_name;
	}


	/**
	 * @return string
	 */
	public function getBackButtonName() {
		return $this->back_button_name;
	}


    /**
     * @param $back_button_target
     */
    public function setBackButtonTarget($back_button_target) {
		$this->back_button_target = $back_button_target;
	}


	/**
	 * @return string
	 */
	public function getBackButtonTarget() {
		return $this->back_button_target;
	}

    /**
     * @param arDisplayFields $fields
     * @return mixed
     */
    function setFields(arDisplayFields $fields){
        $this->fields = $fields;
    }

    /**
     * @return arDisplayFields
     */
    public function getFields()
    {
        return $this->fields->getFields();
    }

    /**
     * @param $field_name
     * @return arDisplayField
     */
    public function getField($field_name)
    {
        return $this->fields->getField($field_name);
    }


    /**
     * @param arDisplayField
     */
    public function addField(arDisplayField $field)
    {
        $this->fields->addField($field);
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }


    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param $txt
     * @param bool $plugin_txt
     * @return string
     */
    protected function txt($txt, $plugin_txt = true) {
		return $this->parent_gui->txt($txt, $plugin_txt);
	}
}