<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
//require JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'output.class.php';
JHTML::stylesheet('virtueupl.css','administrator/components/com_virtueupload/assets/css/');

class VirtueUploadViewSettings extends JView {

	function display($tpl = null) {
		global $mainframe, $option;
		
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.keepalive');

		$params 	=& JComponentHelper::getParams( 'com_virtueupload' );
		$document 	= & JFactory::getDocument();

		// get the data from the model
		$items =& $this->get('Data');
		//$acl		= & JFactory::getACL();

		//$access = $acl->get_group_children_tree( null, 'USERS', false );
		
		
		JToolBarHelper::title(JText::_('VMUpload ').JText::_('SETTINGS'), 'vu');
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
		
		$lists = array();
		$lists['allow_upload'] = JHTML::_('select.booleanlist',  'allow_upload', 'class="inputbox"', $items->allow_upload);
		//$lists['auth_add'] = JHTML::_('select.genericlist', $access, 'frontend_add_gid', 'class="inputbox" size="6"', 'value', 'text', $items->frontend_add_gid );
		$lists['show_thumb'] = JHTML::_('select.booleanlist',  'show_thumb', 'class="inputbox"', $items->show_thumb);

		$this->assignRef('items', $items);
		$this->assignRef('lists', $lists);
		$this->assignRef('params', $params);
		
		parent::display($tpl);

	}
}
?>