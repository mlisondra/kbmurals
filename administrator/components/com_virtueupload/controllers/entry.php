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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
//require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'output.class.php';



class VirtueUploadControllerEntry extends VirtueuploadController {

	function __construct() {
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );

		// sets the standard view 
		JRequest::setVar('view', 'uploads');
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit() {
		JRequest::setVar( 'view', 'entry' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();

	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save() {

		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		$post = JRequest::get( 'POST' );

		
		$model = $this->getModel('entry');

		if ($model->store($post)) {
			$msg = JText::_( 'RECORD_SAVED' );
			// Check the table in so it can be edited.... we are done with it anyway
			$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'ERROR_ON_SAVE' ) . ' ' . $model->getError();
			//			$msg = JText::_( 'ERROR_ON_SAVE' );
			$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
			$this->setRedirect($link, $msg);
		}
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove() {
		$model = $this->getModel('entry');
		if(!$model->delete()) {
			$msg = VUOutput::_( 'YLANG_REMOVEFAIL' );
		} else {
			$msg = VUOutput::_( 'YLANG_REMOVEOK' );
		}

		$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
		$this->setRedirect($link, $msg);
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel() {

		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		$msg = VUOutput::_( 'YLANG_USERCANCEL' );
		$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
		$this->setRedirect($link, $msg);
	}
	
	


}
?>