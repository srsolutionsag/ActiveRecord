<?php
require_once('./Services/Form/classes/class.ilPropertyFormGUI.php');
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Edit/class.arEditField.php');
require_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Edit/class.arEditFields.php');
/**
 * GUI-Class arEditGUI
 *
 * @author            Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arEditGUI extends ilPropertyFormGUI {

	/**
	 * @var  ActiveRecord
	 */
	protected $ar;
	/**
	 * @var arGUI
	 */
	protected $parent_gui;
	/**
	 * @var  ilCtrl
	 */
	protected $ctrl;
	/**
	 * @var string
	 */
	protected $form_name = "";

    /**
     * @var arEditFields
     */
    protected $fields;

    /**
     * @param arGUI $parent_gui
     * @param ActiveRecord $ar
     */
    public function __construct(arGUI $parent_gui, ActiveRecord $ar) {
		global $ilCtrl;

		$this->ar = $ar;
		$this->parent_gui = $parent_gui;
		$this->ctrl = $ilCtrl;
		$this->ctrl->saveParameter($parent_gui, 'ar_id');
        $this->init();
	}

    protected function init(){
        $this->initFields();
        $this->initForm();
        if ($this->ar->getPrimaryFieldValue() != 0) {
            $this->fillForm();
        }
    }

    protected function initFields(){
        $this->fields = new arEditFields($this->ar);
        $this->customizeFields();
        $this->fields->sortFields();
    }

    protected function initForm() {
        $this->initFormAction();
        $this->initFormTitle();
        $this->generateFormFields();
        $this->initCommandButtons();
    }

    protected function initFormAction() {
        $this->setFormAction($this->ctrl->getFormAction($this->parent_gui, "index"));
    }

    protected function initFormTitle() {
        if ($this->ar->getPrimaryFieldValue()  == 0) {
            $this->setTitle($this->txt('create_' . $this->form_name));
        } else {
            $this->setTitle($this->txt('edit_' . $this->form_name));
        }
    }

    protected function initCommandButtons() {
        if ($this->ar->getPrimaryFieldValue()  == 0) {
            $this->addCommandButton('create', $this->txt('create', false));
        } else {
            $this->addCommandButton('update', $this->txt('save', false));
        }
        $this->addCommandButton('index', $this->txt('cancel', false));
    }


	protected function generateFormFields() {

        foreach ($this->fields->getFields() as $field) {
            /**
             * @var arEditField $field
             */
            if ($field->getVisible()) {
                $this->addFormField($field);
            }
        }
	}

    /**
     * @param arEditField $field
     */
    protected function addFormField(arEditField $field) {
		$field_element = NULL;
        if($field->getIsBoolean()){
            $field_element = $this->addBooleanInputField($field);
        }
        else{
            switch ($field->getFieldType()) {
                case 'integer':
                case 'float':
                    $field_element = $this->addNumbericInputField($field);
                    break;
                case 'text':
                    $field_element = $this->addTextInputField($field);
                    break;
                case 'date':
                case 'time':
                case 'timestamp':
                    $field_element = $this->addDateTimeInputField($field);
                    break;
                case 'clob':
                    $field_element = $this->addClobInputField($field);
                    break;
            }
        }
		if ($field->getNotNull()) {
			$field_element->setRequired(true);
		}
		$this->adaptAnyInput($field_element, $field);

		if ($field_element) {
            if($field->getIsSubelementOf()){
                $item = $this->getItemByPostVar('prevent_login');
                $item->addSubItem($field_element);
            }
            else{
                $this->addItem($field_element);
            }
		}
	}

    /**
     * @param arEditField $field
     * @return ilTextInputGUI
     */
    protected function addBooleanInputField(arEditField $field) {
        return new ilCheckboxInputGUI($this->txt($field->getTxt()), $field->getName());
    }


    /**
     * @param arEditField $field
     * @return ilTextInputGUI
     */
    protected function addTextInputField(arEditField $field) {
		return new ilTextInputGUI($this->txt($field->getTxt()), $field->getName());
	}


    /**
     * @param arEditField $field
     * @return ilNumberInputGUI
     */
    protected function addNumbericInputField(arEditField $field) {
		return new ilNumberInputGUI($this->txt($field->getTxt()), $field->getName());
	}


    /**
     * @param arEditField $field
     * @return ilDateTimeInputGUI
     */
    protected function addDateTimeInputField(arEditField $field) {
		$date_input = new ilDateTimeInputGUI($this->txt($field->getTxt()), $field->getName());
		$date_input->setDate(new ilDate(date('Y-m-d H:i:s'), IL_CAL_DATE));
		$date_input->setShowTime(true);

		return $date_input;
	}


    /**
     * @param arEditField $field
     * @return ilTextAreaInputGUI
     */
    protected function addClobInputField(arEditField $field) {
		return new ilTextAreaInputGUI($this->txt($field->getTxt()), $field->getName());
	}


    /**
     * @param ilFormPropertyGUI|NULL $any_input
     * @param arEditField $field
     */
    protected function adaptAnyInput(&$any_input, arEditField $field) {
	}

	public function fillForm() {
        $this->beforeFillForm();
		foreach ($this->fields->getFields() as $field) {
            /**
             * @var arEditField $field
             */
			if ($field->getVisible()) {
                $form_item = $this->getItemByPostVar($field->getName());
                if($form_item){
                    $this->fillFormField($form_item, $field);
                }

			}
		}
        $this->afterFillForm();
	}

    protected function beforeFillForm(){

    }

    protected function afterFillForm(){

    }

    /**
     * @param ilFormPropertyGUI $form_item
     * @param arEditField $field
     */
    public function fillFormField(ilFormPropertyGUI $form_item, arEditField $field){
        $get_function = $field->getGetFunctionName();
        if($field->getIsBoolean()){
            $form_item->setValue(1);
            $form_item->setChecked($this->ar->$get_function()==1 ? true : false);
            return;
        }
        switch ($field->getFieldType()) {
            case 'integer':
            case 'float':
            case 'text':
            case 'clob':
                $form_item->setValue($this->ar->$get_function());
                break;
            case 'date':
            case 'time':
            case 'timestamp':
                /**
                * @var ilDateTimeInputGUI $form_item
                */
                $datetime = new ilDateTime($this->ar->$get_function(), IL_CAL_DATETIME);
                $form_item->setDate($datetime);
                break;
        }
    }


    /**
     * @return bool
     */
    public function saveObject() {
        if(!$this->beforeSave()){
            return false;
        }
        global $ilUser;
        /**
         * @var ilObjUser $ilUser
         */
		if (! $this->setArFieldsAfterSubmit()) {
			return false;
		}
        $modified_by_field = $this->getFields()->getModifiedByField();
        if($modified_by_field)
        {
            $set_modified_by_function = $modified_by_field->getSetFunctionName();
            $this->ar->$set_modified_by_function($ilUser->getId());
        }
        $modification_date_field = $this->getFields()->getModificationDateField();
        if($modification_date_field)
        {
            $set_modification_date_function = $modification_date_field->getSetFunctionName();
            $datetime = new ilDateTime(time(), IL_CAL_UNIX);
            $this->ar->$set_modification_date_function($datetime);
        }
		if ($this->ar->getPrimaryFieldValue() != 0) {
			$this->ar->update();
		} else {
            $created_by_field = $this->getFields()->getCreatedByField();
            if($created_by_field)
            {
                $set_created_by_function = $created_by_field->getSetFunctionName();
                $this->ar->$set_created_by_function($ilUser->getId());
            }
            $creation_date_field = $this->getFields()->getCreationDateField();
            if($creation_date_field)
            {
                $set_creation_date_function = $creation_date_field->getSetFunctionName();
                $datetime = new ilDateTime(time(), IL_CAL_UNIX);
                $this->ar->$set_creation_date_function($datetime);
            }
			$this->ar->create();
		}

		return $this->afterSave();
	}

    protected function beforeSave(){
        return true;
    }

    /**
     * @return bool
     */
    protected function afterSave(){
        return true;
    }


    /**
     * @return bool
     */
    public function setArFieldsAfterSubmit() {
        if (! $this->checkInput()) {
            return false;
        }
        if(!$this->afterValidation()){
            return false;
        }

        foreach ($this->fields->getFields() as $field) {
            if(!$this->setArFieldAfterSubmit($field)){
                return false;
            }
        }
        return true;
    }

    protected function afterValidation(){
        return true;
    }

    /**
     * @param arEditField $field
     * @return bool
     */
    protected function setArFieldAfterSubmit(arEditField $field){
        /**
         * @var arEditField $field
         */
        $valid = false;

        if ($field->getPrimary()) {
            $valid = true;
        } elseif(array_key_exists($field->getName(), $_POST)) {


            switch ($field->getFieldType()) {
                case 'integer':
                case 'float':
                    $valid = $this->setNumericRecordField($field);
                    break;
                case 'text':
                    $valid = $this->setTextRecordField($field);
                    break;
                case 'date':
                case 'time':
                case 'timestamp':
                    $valid = $this->setDateTimeRecordField($field);
                    break;
                case 'clob':
                    $valid = $this->setClobRecordField($field);
                    break;
            }
        } else {
            $valid = $this->handleEmptyPostValue($field);;
        }

        return $valid;
    }

    /**
     * @param arEditField $field
     * @return bool
     */
    protected function setNumericRecordField(arEditField $field) {
        $set_function = $field->getSetFunctionName();
        $this->ar->$set_function($this->getInput($field->getName()));
        return true;
    }

    /**
     * @param arEditField $field
     * @return bool
     */
    protected function setTextRecordField(arEditField $field) {
        $set_function = $field->getSetFunctionName();
        $this->ar->$set_function($this->getInput($field->getName()));

        return true;
    }


    /**
     * @param arEditField $field
     * @return bool
     */
    protected function setDateTimeRecordField(arEditField $field) {
        $set_function = $field->getSetFunctionName();
        $value =  $this->getInput($field->getName());
        if ($value['time']) {
            $datetime = new ilDateTime($value['date'] . " " . $value['time'], IL_CAL_DATETIME);
        } else {
            $datetime = new ilDateTime($value['date'], IL_CAL_DATETIME);
        }
        $this->ar->$set_function($datetime);

        return true;
    }


    /**
     * @param arEditField $field
     * @return bool
     */
    protected function setClobRecordField(arEditField $field) {
        return true;
    }


    /**
     * @param arEditField $field
     * @return bool
     */
    protected function handleEmptyPostValue(arEditField $field) {
        return true;
    }

    /**
     * @param arEditFields $fields
     */
    function setFields(arEditFields $fields){
        $this->fields = $fields;
    }

    /**
     * @return arEditFields
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * @return arEditField []
     */
    public function getFieldsAsArray()
    {
        return $this->getFields()->getFields();
    }

    /**
     * @param $field_name
     * @return arEditField
     */
    public function getField($field_name)
    {
        return $this->getFields()->getField($field_name);
    }


    /**
     * @param arEditField
     */
    public function addEditField(arEditField $field)
    {
        $this->getFields()->addField($field);
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