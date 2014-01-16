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

require JPATH_ADMINISTRATOR . DS . 'components/com_virtueupload/classes' . DS . 'output.class.php';
JHTML::stylesheet('virtueupl_front.css','components/com_virtueupload/assets/css/');

jimport('joomla.application.component.view');

class VirtueUploadViewForm extends JView {

	function display($tpl = null) {
		
	    global $option, $mainframe;
	    $date 			=& JFactory::getDate();
		$date->setOffset(2); //??????
	    $user 			=& JFactory::getUser();
	    $component		=  JComponentHelper::getComponent( 'com_virtueupload' );
	    $model 			=& $this->getModel('form');
	    $document		=& JFactory::getDocument();
	    $pathway 		=& $mainframe->getPathWay();
	    $comparams 		=  new JParameter( $component->params );
	    $config 		=  VUOutput::config();
	    $editor 		=& JFactory::getEditor();
	    $database		=& JFactory::getDBO();
		// ---
		$menu			= & JSite::getMenu();
		$menuitem		= $menu->getActive();
		// ---
	    
		//vars VU
	    $msg			= JRequest::getVar('msg', '');
		$form->status  	= VUOutput::getStatus($msg);

		$option 		= JRequest::getVar('option' );
	    $template   	= $model->getTemplate($option);

		$ip 			= $_SERVER['REMOTE_ADDR'];
		$session 		= session_id();
		$form->actionurl = VUOutput::_getUriString();

	
	    // Initialize form validator
		JHTML::_('behavior.formvalidation');	

		//banned ip?
		$query = "SELECT ip"
		 . "\n FROM #__virtueuploads_ban"
		 . "\n WHERE ip = '$ip'";
		$database->setQuery($query);
		$banned = $database->loadResult();
		if ($banned != '') {
			return LANG_VMUPL_BANNED;
		}

		//Eventueel uservalidatie
		$userallowed = true;
		
		if ( $userallowed == true ) {
			//voor bestellingen lijst
			if (!JRequest::getVar('order_id')) {
				$order_id = 0;
			} else {
				$order_id = JRequest::getVar('order_id' );
			}

			
			$this->assignRef('user', $user);
			$this->assignRef('comparams', $comparams);
			$this->assignRef('config', $config);
			$this->assignRef('form', $form);

			
			parent::display($tpl);
			
		} else {
			$return		= $uri->toString();
			$url  = 'index.php?option=com_user&view=login';
			$url .= '&return='.base64_encode($return);;
			$mainframe->redirect($url, JText::_('ALERTNOTAUTH') );
			
		}
	}
}
?>