<?php
// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
<table class="adminlist">
	<thead>
		<tr>
			<th width="5"><?php echo JText::_( 'ID' ); ?></th>
			<th width="20"><input type="checkbox" name="toggle" value=""
				onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
			<th width="160"><?php echo JHTML::_('grid.sort',  VUOutput::_('YLANG_DATE'), 'a.date1', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="400"><?php echo JHTML::_('grid.sort',  VUOutput::_('YLANG_FILENAME'), 'a.file_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th><?php echo VUOutput::_('YLANG_DOWNLOADLINK'); ?>
			</th>
			<th><?php echo JHTML::_('grid.sort',  VUOutput::_('YLANG_FILESIZE'), 'a.file_size', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
<!--
			<th><?php echo JHTML::_('grid.sort',  VUOutput::_('YLANG_ORDERID'), 'a.order_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>-->
			</th>
			<th><?php echo JHTML::_('grid.sort',  VUOutput::_('YLANG_UPLOADBY'), 'a.upload_by', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		

		// some more needed variables
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_virtueupload&controller=entry&task=edit&cid[]='. $row->id );
		$row->thumb_img = VUOutput::getThumb ($row->thumb, 1);
		$row->thumb_img = VUOutput::makeDLoadLink ($row->id, $row->thumb_img);

		?>
	<tr class="<?php echo "row$k"; ?>">
		<td><?php echo $row->id; ?></td>
		<td><?php echo $checked; ?></td>
		<td align="center"><?php echo JHTML::_('date', $row->date, "Y-m-d"); ?></td>
		<td><a href="<?php echo $link; ?>"><?php echo $row->file_name; ?></a></td>
		<td align="center"><?php echo $row->thumb_img; ?></td>
		<td><?php echo $row->file_size; ?></td>
		<!-- <td><?php echo $row->order_id; ?></td> -->
		<td align="center"><?php echo $row->upload_by; ?></td>
	</tr>
	<?php
	$k = 1 - $k;
	}
	?>
	<tfoot>
		<tr>
			<td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>
</table>
</div>
<input type="hidden" name="option" value="com_virtueupload" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" /> 
<input type="hidden" name="controller" value="entry" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
<?php
echo JHTML::_( 'form.token' );

?>