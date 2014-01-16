<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
JHTML::_('behavior.tooltip');
jimport('joomla.html.pane');
JHTML::stylesheet('tabs.css','components/com_virtueupload/assets/css/');
JHTML::stylesheet('form.css','components/com_virtueupload/assets/css/');

$document->addScript(JURI::base()."administrator/components/com_virtueupload/assets/js/checkform.js");
?>

<script type="text/javascript">


//	function submitbutton(pressbutton) {
//		var form = document.adminForm;
//		
//		if (pressbutton == 'cancel') {
//			submitform( pressbutton );
//			return;
//		}
//
//		// do field validation
//		if (form.published.value == "0"){
//			var isOk = confirm("Event is not published - continue?");
//			if (isOk) {
//				submitform( pressbutton );
//			}
//		}
//	}

</script>

<div id="virtueupl_form">
<form id="adminForm" name="adminForm"  action="#" method="post" enctype="multipart/form-data" onSubmit="return checkForm();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="2" valign="top">
		<label for="file"><?php echo JText::_('YLANG_FORM_LBL_FILE'); ?></label><br/>
		<input name="file" type="file" class="button" />
	</td>
    <td height="70px" valign="bottom" align="right">
		<input id="upload_button" class="button" type="submit" value="<?php echo JText::_('YLANG_SUBMIT'); ?>" onclick="this.form.status.value = '<?php echo JText::_('YLANG_STAT_INITUPL'); ?>';	this.form.status.style.color = '#339900';" />
	</td>
  </tr>
  <tr>
    <td width="45%" height="50" align="left" valign="middle">
<label for="status"><?php echo JText::_('YLANG_FORM_STATUS'); ?></label>	
	</td>
	<td colspan="2">
		<input class="vu_status" size="50" type="text" id="status" name="status" readonly="readonly" value="<?php echo JText::_('YLANG_STAT_WAITTUPL'); ?>" />
	</td>
 </tr>
</table>

<?php echo JHTML::_( 'form.token' ); ?>

<input type="hidden" name="task" value="submit" />
<input type="hidden" name="option" value="com_virtueupload" />
<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
<input type="hidden" name="userid" value="<?php echo $this->item->userid; ?>" />
<input type="hidden" name="controller" value="entry" />
</form>
<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
//javascript statusinput
echo $this->form->status;

?>

</div>