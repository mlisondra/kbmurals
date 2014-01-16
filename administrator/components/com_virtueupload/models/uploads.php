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

class VirtueUploadModelUploads extends JModel {

	var $_total = null;
	var $_pagination = null;

	function __construct() {
		parent :: __construct();

// add by ym in 2012-1-24
//		global $mainframe, $option;
$mainframe =& JFactory::getApplication();


		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option . 'limitstart', 'limitstart', 0, 'int');

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	function _buildQuery() {
		$orderby	= $this->_buildContentOrderBy();
		$query = ' SELECT * FROM #__virtueuploads ' 
				. $orderby;
$_SESSION['print'] = $query;
		return $query;
	}

	function _buildContentOrderBy() {
// add by ym in 2012-1-24
//		global $mainframe, $option;
$mainframe =& JFactory::getApplication();


		$context = 'com_virtueupload.uploads.';
		//ordering to-do!
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',	'filter_order',	'date',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',	'word' );
		$filter_order = 'date';
		$filter_order_Dir = 'desc';

		if ($filter_order == 'date'){
			$orderby = 'ORDER BY date '.$filter_order_Dir;
		} else {
			$orderby = 'ORDER BY '.$filter_order.' '.$filter_order_Dir.' , date';
		}

		return $orderby;
	}

	function getTotal() {
		if (empty ($this->_total)) {
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}

	function getPagination() {
		if (empty ($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_pagination;
	}

	function getData() {
		$query = $this->_buildQuery();
		$pagination = $this->getPagination();
		$data = $this->_getList($query, $pagination->limitstart, $pagination->limit);
		return $data;
	}

	function delete() {
		$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
		$row = & $this->getTable();

		foreach ($cids as $cid) {
			if (!$row->delete($cid)) {
				$this->setError($row->getErrorMsg());
				return false;
			}
		}
		return true;
	}
}
?>