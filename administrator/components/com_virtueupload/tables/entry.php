<?php
/**
 *	com_virtueupload -
 *  Copyright (C) 2009 Matthijs Alles
 *
 */


//no direct access
defined('_JEXEC') or die('Restricted access');

class TableEntry extends JTable {
	var $id = null;
	var $file_name = null;
	var $file_size = null;
	var $upload_by = null;
	var $order_id = null;
	var $edited = null;
	var $csize = null;
	var $ip = null;
	var $session_id = null;
	var $link = null;
	var $comment = null;
	var $date = null;
	var $cdate = null;

	function __construct(&$db) {
		parent::__construct( '#__virtueuploads', 'id', $db);
	}

	function check() {
		if ( trim($this->file_name) == '' || trim($this->file_name) == '' ) {
			$this->setError(JText::_('INSERT_FILE_NAME'));
			return false;
		}
		return true;
	}
}
?>