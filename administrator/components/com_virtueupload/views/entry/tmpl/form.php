<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();

JHTML::_('behavior.tooltip');
?>
<script type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.file_name.value == ""){
			alert( "<?php echo VUOutput::_( 'YLANG_NOFILENAME'); ?>" );
		}  else {
			submitform( pressbutton );
		}
	}
</script>

<form  action="index.php?option=com_virtueupload&amp;controller=calendar&amp;view=calendar" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col width-60">



<fieldset class="adminform">
<legend><?php echo VUOutput::_( 'YLANG_FILE' ); ?></legend>
<table class="admintable" width="100%" >
	<tr>
		<td width="100" align="right" class="key"><label for="date"> <?php echo VUOutput::_( 'YLANG_DATE' ); ?>:
		</label></td>
		<td><?php echo $this->item->date; ?></td>
		<td rowspan="5" width="300" align="center">
		<?php echo $this->item->thumb_img; ?>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="file_name"> <?php echo VUOutput::_( 'YLANG_FILENAME' ); ?>:
		</label></td>
		<td><input class="text_area" type="hidden" name="file_name" id="file_name" size="64" maxlength="250" value="<?php echo $this->item->file_name; ?>" /><?php echo $this->item->dl_link; ?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="file_size"> <?php echo VUOutput::_( 'YLANG_FILESIZE' ); ?>:
		</label></td>
		<td><input class="text_area" type="hidden" name="file_size" id="file_size" size="64" maxlength="250" value="<?php echo $this->item->file_size; ?>" /><?php echo $this->item->file_size ; ?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="link"> <?php echo VUOutput::_( 'YLANG_LINK' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="link" id="link" size="64" maxlength="250" value="<?php echo $this->item->link; ?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="thumb"> <?php echo VUOutput::_( 'YLANG_THUMB' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="thumb" id="thumb" size="64" maxlength="250" value="<?php echo $this->item->thumb; ?>" /></td>
	</tr>
</table>
</fieldset>
<fieldset class="adminform">
<legend><?php echo VUOutput::_( 'YLANG_USER' ); ?></legend>
<table class="admintable">
	<tr>
		<td width="100" align="right" class="key"><label for="upload_by"> <?php echo VUOutput::_( 'YLANG_UPLOADBY' ); ?>:
		</label></td>
		<td><?php echo $this->item->upload_by; ?></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="ip"> <?php echo VUOutput::_( 'YLANG_IP' ); ?>:
		</label></td>
		<td><?php echo $this->item->ip; ?></td>
	</tr>
	<tr>
		<td colspan="2">
		</td>
	</tr>
</table>
</fieldset> 
</div>
<div class="col width-40">

<!--
<fieldset class="adminform">
<legend><?php echo VUOutput::_( 'YLANG_VLINK' ); ?></legend>
<table class="admintable">
	<tr>
		<td width="100" align="right" class="key"><label for="file_size"> <?php echo VUOutput::_( 'YLANG_VLINK' ); ?>:
		</label></td>
		<td><?php echo $this->item->vmproduct->order_id; ?>
		<?php echo VUOutput::_( 'YLANG_PLINK' ); ?> : <a href="<?php echo $this->item->vmproduct->productlink; ?>" target="_blank"><?php echo $this->item->vmproduct->productname; ?></a><br/>
<?php
if ( isset ($this->item->vmproduct->ordernumber) ) {
?>
		<?php echo VUOutput::_( 'YLANG_OLINK' ); ?> : <a href="<?php echo $this->item->vmproduct->orderlink; ?>" target="_blank"><?php echo $this->item->vmproduct->ordernumber; ?></a><br/>
<?php
} else {
echo VUOutput::_( 'YLANG_NORDER' );
} //einde als ordernumber
?>
		
		</td>
	</tr>
</table>
</fieldset>
-->

<fieldset class="adminform">
<legend><?php echo VUOutput::_( 'YLANG_COMMENT' ); ?></legend>
<table class="admintable">
	<tr>
		<td width="100" align="right" class="key"><label for="comment"> <?php echo VUOutput::_( 'YLANG_COMMENT' ); ?>:
		</label></td>
		<td><textarea class="text_area" type="text" name="comment" id="comment" rows="5" cols="26" maxlength="250" ><?php echo $this->item->comment; ?></textarea></td>
	</tr>
</table>
</fieldset>
</div>
<div class="clr"></div>
<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_virtueupload" />
<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="entry" />
</form>
<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');


?>
