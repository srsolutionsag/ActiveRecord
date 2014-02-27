<?php
require_once('.Services/Form/classes/class.ilPropertyFormGUI.php');

/**
 * Class arFormBuilder
 *
 * @author Fabian Schmid <fs@studer-raimann.ch>
 */
class arFormBuilder {

	/**
	 * @var array
	 */
	protected static $elements = array(
		'checkbox' => 'ilCheckboxInputGUI',
		'select' => 'ilSelectInputGUI',
		'text' => 'ilTextInputGUI',
		'area' => 'ilTextareaInputGUI',
	);


	/**
	 * @param $type
	 * @param $post_var
	 * @param $title
	 *
	 * @return mixed
	 */
	protected static function getFormElement($type, $post_var, $title) {
		$inputType = self::$elements[$type];

		return new $inputType();
	}


	/**
	 * @param ActiveRecord $object
	 *
	 * @return ilPropertyFormGUI
	 */
	public static function getForm(ActiveRecord $object) {
		$form = new ilPropertyFormGUI();
		foreach ($object::returnDbFields() as $field) {
			echo '<pre>' . print_r($field, 1) . '</pre>';
		}

		return $form;
	}
}

?>