<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//require JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS . 'output.class.php';
JHTML::stylesheet('virtueupl.css','administrator/components/com_virtueupload/assets/css/');

jimport('joomla.application.component.view');

class VirtueUploadViewEntry extends JView {

	function display($tpl = null) {
		global $mainframe, $option;

		// load params from the component
		$params 	=& JComponentHelper::getParams( 'com_virtueupload' );
		$config 	=  VUOutput::config();
		$user 		=& JFactory::getUser();
		$model 		= $this->getModel('entry');
		// get the data from the model
		$item =& $this->get('Data');
		
		$item->vmproduct = $model->catVMproductlink($item->product_id, $item->order_id);
		$item->thumb_img = VUOutput::makeDLoadLink ($item->id, $item->thumb_img);
		$item->dl_link = VUOutput::makeDLoadLink ($item->id, $item->file_name);
		$item->file_size = VUOutput::_getFileSize ( $item->file_size );
		$this->assignRef('item', $item);
		$this->assignRef('params', $params);
		$this->assignRef('config', $config);
	
		
		JToolBarHelper::title(JText::_('VMUpload').': <small><small>[ ' .JText::_( 'Edit' ).' ]</small></small>', 'vu');
		JToolBarHelper::save();
		JToolBarHelper::cancel( 'cancel', 'Close' );

		parent::display($tpl);
	}

}
?>