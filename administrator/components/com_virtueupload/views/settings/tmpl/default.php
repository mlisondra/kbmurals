<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
// JSColor color picker
$document 	= & JFactory::getDocument();
$document->addScript('components/com_virtueupload/assets/js/jscolor/jscolor.js');

?>
<script language="javascript" type="text/javascript">

	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.uploadpath.value == ""){
			alert( "<?php echo VUOutput::_( 'YLANG_NOUPLOADFOLDER'); ?>" );
		} else  {
			submitform( pressbutton );
		}
	}
</script>
<form action="index.php?option=com_virtueupload&amp;controller=virtueupl&amp;view=calendar" method="post" name="adminForm" id="adminForm">
	<div class="col width-50">
		<fieldset class="adminform">
		<legend><?php echo VUOutput::_( 'YLANG_OVERALL' ); ?></legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key">
				<label for="allow_upload">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_UPLOADENABLE'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_UPLOADENABLE_DES' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<?php echo $this->lists['allow_upload']; ?>
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
				<label for="uploadpath">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_UPLOADFOLDER_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_UPLOADFOLDER' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="uploadpath" id="uploadpath" size="30" maxlength="128" value="<?php echo $this->items->uploadpath;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
				<label for="extensions">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_NOEXT_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_NOEXT' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="extensions" id="extensions" size="60" maxlength="256" value="<?php echo $this->items->extensions;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
				<label for="maxsize">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_MAXSIZE_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_MAXSIZE' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="maxsize" id="maxsize" size="16" maxlength="128" value="<?php echo $this->items->maxsize;?>" />
				</td>
			</tr>

			<tr>
				<td width="100" align="right" class="key">
				<label for="maxsize">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_MAXFILES_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_MAXFILES' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="maxuploadfiles" id="maxsize" size="16" maxlength="128" value="<?php echo $this->items->maxuploadfiles;?>" />
				</td>
			</tr>

		</table>
		</fieldset>


		</div>
	<div class="col width-50">
		<fieldset class="adminform">
		<legend><?php echo VUOutput::_( 'YLANG_THUMBNAILS' ); ?></legend>
		<table class="admintable">
			<tr>
				<td width="100" align="right" class="key">
				<label for="show_thumb">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_THUMBENABLE_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_THUMBENABLE' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<?php echo $this->lists['show_thumb']; ?>
				</td>
			</tr>
<!--
			<tr>
				<td width="100" align="right" class="key">
				<label for="iconwidth">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_IMGWIDTH_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_IMGWIDTH' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="iconwidth" id="iconwidth" size="16" maxlength="64" value="<?php echo $this->items->iconwidth;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
				<label for="iconheight">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_IMGHEIGHT_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_IMGHEIGHT' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="iconheight" id="iconheight" size="16" maxlength="64" value="<?php echo $this->items->iconheight;?>" />
				</td>
			</tr>
-->
			<tr>
				<td width="100" align="right" class="key">
				<label for="thumbwidth">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_THUMBWIDTH_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_THUMBWIDTH' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="thumbwidth" id="thumbwidth" size="16" maxlength="64" value="<?php echo $this->items->thumbwidth;?>" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
				<label for="thumbheight">
					<span class="editlinktip hasTip" title="<?php echo VUOutput::_( 'YLANG_NOTICE' ); ?>::<?php echo VUOutput::_('YLANG_THUMBHEIGHT_DES'); ?>">
			    	<?php echo VUOutput::_( 'YLANG_THUMBHEIGHT' ); ?>:
			    	</span>
				</label>
				</td>
				<td>
					<input class="text_area" type="text" name="thumbheight" id="thumbheight" size="16" maxlength="64" value="<?php echo $this->items->thumbheight;?>" />
				</td>
			</tr>
		</table>
		</fieldset>
	</div>
	<input type="hidden" name="option" value="com_virtueupload" />
	<input type="hidden" name="id" value="<?php echo $this->items->id; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="settings" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>



		