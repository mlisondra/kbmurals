<?php
/**
 *	com_virtueupload - Upload for Joomla & VirtueMart
 *  Copyright (C) 2009 Matthijs Alles - Bixie
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access');
jimport( 'joomla.application.component.model');

class VirtueUploadModelForm extends JModel {

	var $_item= null;
	var $_id = null;

	function __construct() {
    	parent::__construct();
    	$id = JRequest::getVar('id', 0);
    	$this->_id = $id;
	}

		


	//Template bepalen
	function getTemplate ($option) {

		$pop = JRequest::getVar('pop', null );
		$product_id = JRequest::getVar('product_id', null );
		$page   = JRequest::getVar('page', null );

		if ($pop != '') {
			$template = "pop.vu";
		}
		if ($product_id != '') {
			$template = "fly.vu";
		}
		if ($page == 'account.index') {
			$template = "account.vu";
		}
		if ($option == 'com_virtueupload') {
			$template = "account.vu";
		}
		return $template;
	}






	
	function store($data)
	{
		$row =& $this->getTable('entry');

		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the simplecalendar data table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			return false;
		}
		return true;
	}
	
	function delete($cids) {

		$row =& $this->getTable('entry');

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}
}
