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
class VirtueUploadControllerSettings extends VirtueuploadController {

	function __construct() {
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'apply', 'save' );

		// sets the standard view
		JRequest::setVar('view', 'uploads');
	}


	function edit() {
		JRequest::setVar( 'view', 'settings' );
//		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();

	}
	
	function apply() {
		$msg = VUOutput::_( 'YLANG_SETAPPLY' );
		$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
		$this->setRedirect($link, $msg);
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save() {

		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$model = $this->getModel('settings');
		$data = $model->getData();
		$post = JRequest::get( 'post' );
		$task = JRequest::getVar('task');

		if ($model->store($post)) {
			$msg = VUOutput::_( 'YLANG_SETSAVE' );
			
			switch ($task) {
				case 'apply':
					$link = 'index.php?option=com_virtueupload&controller=settings&task=edit';
					break;

				default:
					$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
					break;
			}
//			$link = 'index.php?option=com_virtueupload&controller=memberships&view=memberships';
			$this->setRedirect($link, $msg);
			
		} else {
			$msg = VUOutput::_( 'YLANG_SAVEERROR' );
			$link = 'index.php?option=com_virtueupload&controller=settings&task=edit';
			$this->setRedirect($link, $msg);
		}
	}


	/**
	 * cancel and exit from editing a record
	 * @return void
	 */
	function cancel() {
		$msg = VUOutput::_( 'YLANG_SETCANCEL' );
		$link = 'index.php?option=com_virtueupload&controller=uploads&view=uploads';
		$this->setRedirect($link, $msg);
	}
}
?>