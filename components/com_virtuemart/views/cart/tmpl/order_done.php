<jdoc:include type="message" />
<?php
defined('_JEXEC') or die('');
$mainframe = JFactory::getApplication();

/**
*
* Template for the shopping cart
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/



//echo "<h3>".JText::_('COM_VIRTUEMART_CART_ORDERDONE_THANK_YOU')."</h3>";
$mainframe->enqueueMessage(JText::_('COM_VIRTUEMART_CART_ORDERDONE_THANK_YOU'), 'Info');

echo $this->html;
