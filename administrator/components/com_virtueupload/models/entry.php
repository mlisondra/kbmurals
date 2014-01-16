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
defined('_JEXEC') or die();
jimport('joomla.application.component.model');

class VirtueUploadModelEntry extends JModel {

	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct() {
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the entry identifier
	 *
	 * @access	public
	 * @param	int Hello identifier
	 * @return	void
	 */
	function setId($id) {
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to build the query
	 * @return	string
	 */
	function _buildQuery() {
		$query = 'SELECT * FROM #__virtueuploads '
				.'WHERE id = ' . (int) $this->_id.' '
				.'ORDER BY date';
		return $query;
	}


	/**
	 * Method to get a calendar entry
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			//$query = $this->_buildQuery();
			//$this->_db->setQuery( $query );
			//$this->_data = $this->_db->loadObject();
			$this->_data = VUOutput::UploadInfoId($this->_id);
		}
		if (!$this->_data) {
//			$this->_data = new stdClass();
//			$this->_data->id = 0;
//			$this->_data->entryName = null;
		}
		return $this->_data;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store($data)
	{
		$row =& $this->getTable();

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

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $this->_db->getErrorMsg() );
			return false;
		}
		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete() {
		$database = &JFactory::getDBO(); 
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$row =& $this->getTable();
		$config = $this->config();

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				$dir = JPATH_ROOT.DS.$config->uploadpath.DS.$cid;
				if ( $this->rmdirr($dir) ) {
					$delsucces = true;
				}

				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}

	function config() {
		$db =& JFactory::getDBO();

		$sql = 'SELECT * FROM #__virtueuploads_settings WHERE id = 1';
		$db->setQuery($sql);
		$config = $db->loadObject();

		return $config;
	}
	
	function rmdirr($dirname) { 
		// Sanity check 
		if (!file_exists($dirname)) { 
			return false; 
		} 
		// Simple delete for a file 
		if (is_file($dirname) || is_link($dirname)) { 
			return unlink($dirname); 
		} 
		// Loop through the folder 
		$dir = dir($dirname); 
		while (false !== $entry = $dir->read()) { 
			// Skip pointers 
			if ($entry == '.' || $entry == '..') { 
				continue; 
			} 
			// Recurse 
			$this->rmdirr($dirname . DS . $entry); 
		} 
		// Clean up 
		$dir->close(); 
		
		return rmdir($dirname); 
	}
	
	function catVMproductlink($prod_id, $order_id) {
		$db 	= &JFactory::getDBO(); 
		$prodcat = explode ( '|' , $prod_id );
		$product_id = $prodcat[0];
		$cat_id = $prodcat[1];
		if ( $product_id > 0 ) {
			$sql = "SELECT product_name FROM #__vm_product WHERE product_id = '$product_id'";
			$db->setQuery($sql);
			$prodname = $db->loadResult();
			$vmproduct->productname = $prodname;
			$vmproduct->productlink = JURI::base().'index.php?page=product.product_form&limitstart=0&keyword=&product_id='.$product_id.'&product_parent_id=&option=com_virtuemart';
		} 
		if ( $order_id > 0 ) {
			$sql = "SELECT order_number FROM #__vm_orders WHERE order_id = '$order_id'";
			$db->setQuery($sql);
			$ordernumber = $db->loadResult();
			if ( $ordernumber != '' ) {
				$vmproduct->ordernumber = $ordernumber;
				$vmproduct->orderlink = JURI::base().'index.php?page=order.order_print&limitstart=0&keyword=&order_id='.$order_id.'&option=com_virtuemart';
			} else {
				$ordernumber = JText::_('Bestelling verwijderd');
			}
		}

		return $vmproduct;
	}
	function getFileSize($size) {
		if ( (int) $size < 1024 ) {
			return (int) $size . ' bytes';
		} else if ( (int) $size >= 1024 && (int) $size < 1048576 ) {
			return (int) ($size/1024) . ' kB';
		} else if ( (int) $size >= 1048576 ) {
			return (int) ($size/1048576) . ' MB';
		}
		return '';
	}

}
?>