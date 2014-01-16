<?php
/**
 *	com_virtueupload -
 *  Copyright (C) 2009 Matthijs Alles
 *
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

class TableSettings extends JTable {

	var $id = '1';
	var $allow_upload = null;
	var $uploadpath = null;
	var $filerename = null;
	var $frontend_link_color = null;
	var $extensions = null;
	var $maxsize = null;
	var $banuser = null;
	var $adminmail = null;
	var $vm_attribute = null;
	var $show_thumb = null;
	var $iconwidth = null;
	var $iconheight = null;
	var $thumbwidth = null;
	var $thumbheight = null;
	var $maxuploadfiles= null;

	function __construct(&$db) {
		parent::__construct( '#__virtueuploads_settings', 'id', $db);
	}


	/**
	 * Checks the data before saving
	 *
	 * @return true on success
	 */
	function check() {
		if (trim($this->id) != '1') {
			$this->setError(JText::_('ERROR: Only one instance of settings is allowed!'));
			return false;
		}
		return true;
	}
}
?>