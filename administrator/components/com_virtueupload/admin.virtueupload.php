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

	//no direct access
	defined('_JEXEC') or die('Restricted access');

	require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'controller.php' );



//add by ym
require_once  JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS .'language.class.php';
if(!isset($GLOBALS['VM_LANG']))
{
  $GLOBALS['VM_LANG'] = $GLOBALS['PHPSHOP_LANG'] =& new vmLanguage();
  $GLOBALS['VM_LANG']->load('upload');
}

require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'output.class.php');

	if($controller = JRequest::getVar('controller')) {
	    $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.strtolower($controller).'.php';
		if (file_exists($path)) {
			require_once $path;
		}
	} else {
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.'uploads.php');
		$controller = 'Uploads';
	}
	
	$classname = 'VirtueUploadController'.$controller;
	$controller = new $classname();
	$controller->execute(JRequest::getVar('task'));
	$controller->redirect();
	
?>