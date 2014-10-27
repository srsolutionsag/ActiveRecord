<?php
include_once("./Services/Component/classes/class.ilPluginConfigGUI.php");
include_once('./Customizing/global/plugins/Libraries/ActiveRecord/class.ActiveRecordList.php');
include_once('./Customizing/global/plugins/Libraries/ActiveRecord/Views/Index/class.arIndexTableGUI.php');
include_once('./Services/UICore/classes/class.ilTemplate.php');

/**
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.6
 *
 */
class arGUI {

	/**
	 * @var ilCtrl
	 */
	protected $ctrl;
	/**
	 * @var ilTemplate
	 */
	protected $tpl;
	/**
	 * @var ilAccessHandler
	 */
	protected $access;
	/**
	 * @ar ilLanguage
	 */
	protected $lng;
	/**
	 * @var ilPlugin
	 */
	protected $plugin_object = NULL;

    /**
     * @var string
     */
    protected $record_type = "";

    /**
     * @var ActiveRecord
     */
    protected $ar;

    /**
     * @var string
     */
    protected $lng_prefix = "";

    /**
     * @param $record_type
     * @param ilPlugin $plugin_object
     */
    public function __construct($record_type, ilPlugin $plugin_object = NULL) {
		global $tpl, $ilCtrl, $ilAccess, $lng;

		$this->lng = $lng;

		if ($plugin_object) {
			$this->setLngPrefix($plugin_object->getPrefix());
			$plugin_object->loadLanguageModule();
		}

		$this->tpl = $tpl;
		$this->ctrl = $ilCtrl;
		$this->access = $ilAccess;
		$this->plugin_object = $plugin_object;
		$this->record_type = $record_type;
		$this->ar = new $record_type();
	}


	function executeCommand() {
		$cmd = $this->ctrl->getCmd();
		$this->$cmd();
	}

	function index() {
		$index_table_gui_class = $this->record_type . "IndexTableGUI";
        /**
         * @var arIndexTableGUI $table_gui
         */
        $table_gui = new $index_table_gui_class($this, "index", new ActiveRecordList($this->ar));
		$this->tpl->setContent($table_gui->getHTML());
	}

    function applyFilter()
    {
        $index_table_gui_class = $this->record_type . "IndexTableGUI";
        /**
         * @var arIndexTableGUI $table_gui
         */
        $table_gui             = new $index_table_gui_class($this, "index", new ActiveRecordList($this->ar));
        $table_gui->applyFilter();
        $this->index();
    }

    function resetFilter()
    {
        $index_table_gui_class = $this->record_type . "IndexTableGUI";
        /**
         * @var arIndexTableGUI $table_gui
         */
        $table_gui             = new $index_table_gui_class($this, "index", new ActiveRecordList($this->ar));
        $table_gui->resetFilter();
        $this->index();
    }

	/**
	 * Configure screen
	 */
	function edit() {
		$edit_gui_class = $this->record_type . "EditGUI";
        /**
         * @var arEditGUI $edit_gui
         */
		$edit_gui = new $edit_gui_class($this, $this->ar->find($_GET['ar_id']));
		$this->tpl->setContent($edit_gui->getHTML());
	}


	function add() {
		$edit_gui_class = $this->record_type . "EditGUI";
        /**
         * @var arEditGUI $edit_gui
         */
        $edit_gui = new $edit_gui_class($this, $this->ar);
		$this->tpl->setContent($edit_gui->getHTML());
	}


	public function create() {
		$edit_gui_class = $this->record_type . "EditGUI";
        /**
         * @var arEditGUI $edit_gui
         */
        $edit_gui = new $edit_gui_class($this, $this->ar);
		$this->save($edit_gui);
	}


	public function update() {
		$edit_gui_class = $this->record_type . "EditGUI";
        /**
         * @var arEditGUI $edit_gui
         */
        $edit_gui = new $edit_gui_class($this, $this->ar->find($_GET['ar_id']));
		$this->save($edit_gui);
	}


    /**
     * @param arEditGUI $edit_gui
     */
    public function save(arEditGUI $edit_gui) {
		if ($edit_gui->saveObject()) {
			ilUtil::sendSuccess($this->txt('record_created'), true);
			$this->ctrl->redirect($this, "index");
		} else {
			$this->tpl->setContent($edit_gui->getHTML());
		}
	}

	function view() {
		$display_gui_class = $this->record_type . "DisplayGUI";
        /**
         * @var arDisplayGUI $display_gui
         */
		$display_gui = new $display_gui_class($this, $this->ar->find($_GET['ar_id']));
		$this->tpl->setContent($display_gui->getHtml());
	}


	function delete() {
		$delete_gui_class = $this->record_type . "DeleteGUI";
        /**
         * @var arDeleteGUI $delete_gui
         */
        $delete_gui = new $delete_gui_class($this, $this->ar->find($_GET['ar_id']));
		$this->tpl->setContent($delete_gui->getHTML());
	}


	function deleteItem() {
		$record = $this->ar->find($_GET['ar_id']);
		$record->delete();
		ilUtil::sendSuccess("object_deleted");
		$this->ctrl->redirect($this, "index");
	}


	/**
	 * @param string $lng_prefix
	 */
	public function setLngPrefix($lng_prefix) {
		$this->lng_prefix = $lng_prefix;
	}


	/**
	 * @return string
	 */
	public function getLngPrefix() {
		return $this->lng_prefix;
	}

    /**
     * @param $txt
     * @param bool $plugin_txt
     * @return string
     */
    public function txt($txt, $plugin_txt = true) {
		if ($this->getLngPrefix() != "" && $plugin_txt) {
			return $this->lng->txt($this->getLngPrefix() . "_" . $txt, $this->getLngPrefix());
		} else {
			return $this->lng->txt($txt);
		}
	}
}