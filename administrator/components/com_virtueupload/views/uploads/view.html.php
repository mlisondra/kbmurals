<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//require JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'output.class.php';
JHTML::stylesheet('virtueupl.css','administrator/components/com_virtueupload/assets/css/');


jimport('joomla.application.component.view');

class VirtueUploadViewUploads extends JView {

	function display($tpl = null) {

// add by ym in 2012-1-24
//		global $mainframe, $option;
$mainframe =& JFactory::getApplication();


		$context = 'com_virtueupload.entry';

		$filter_state		= $mainframe->getUserStateFromRequest( $context.'filter_state',		'filter_state',		'',				'word' );
		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		'vu.date',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $context.'filter_catid',		'filter_catid',		0,				'int' );

		JToolBarHelper::title(JText::_('VMUpload Uploads'), 'vu');
		//JToolBarHelper::customX( 'delExpired', 'delete.png', 'delete_f2.png', 'Verwijder oude' );
		//JToolBarHelper::spacer();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		
		//JSubMenuHelper::addEntry( JText::_( 'Bans' ), 'index.php?option=com_virtueupload&controller=Bans');
		JSubMenuHelper::addEntry( JText::_( 'SETTINGS' ), 'index.php?option=com_virtueupload&controller=settings&task=edit');
		//JSubMenuHelper::addEntry( JText::_( 'Manage uploads' ), 'index.php?option=com_virtueupload&controller=manage&view=manage');
		
		


		//table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;



		$items =& $this->get('Data');
	
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('lists', $lists);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('comparams', $comparams);

		parent::display($tpl);
	}
}
?>