<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 6433 2012-09-12 15:08:50Z openglobal $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
?>
<div class="addtocart-area">

	<form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php'); ?>">
		<?php // Product custom_fields
		if (!empty($this->product->customfieldsCart)) {
			?>
			<div class="product-fields">
               	<?php $fieldCount = 1; ?>
                    
				<?php foreach ($this->product->customfieldsCart as $field) {
				if($this->product->category_name == "Customize") {
				?>
					<div class="customize-field product-field product-field-type-<?php echo $field->field_type ?>">
					<?php if ($fieldCount == 1) { ?>
						<div id="size_mural_customize" class="customize_title">
							<h4>Size Your Mural</h4>
						</div>						
					<?php } elseif ($fieldCount == 2) { ?>
						<div id="materials_customize" class="customize_title">
							<h4>Choose Your Materials</h4>
						</div>
					<?php }// if/elsif ?>
				<?php } else { ?>
					<div class="product-field product-field-type-<?php echo $field->field_type ?>">
					<?php if ($fieldCount == 1) { ?>
						<div id="size_mural" class="customize_title">
							<h4>Size Your Mural</h4>
						</div>						
					<?php } elseif ($fieldCount == 2) { ?>
						<div id="materials" class="customize_title">
							<h4>Choose Your Materials</h4>
						</div>
					<?php }// if/elsif ?>
				<?php }// End if/else	?>
                    
					<span class="product-fields-title-wrapper"><span class="product-fields-title"><?php echo JText::_ ($field->custom_title) ?></span>
					<?php if ($field->custom_tip) {
					echo JHTML::tooltip ($field->custom_tip, JText::_ ($field->custom_title), 'tooltip.png');
				} ?></span>
					<span class="product-field-display"><?php echo $field->display ?></span>
					<span class="product-field-desc"><?php echo $field->custom_field_desc ?></span>
				</div><br/>
				<?php
				
				$fieldCount++;
			}// End foreach
				?>
			</div>
			<?php
		}
		/* Product custom Childs
			 * to display a simple link use $field->virtuemart_product_id as link to child product_id
			 * custom_value is relation value to child
			 */

		if (!empty($this->product->customsChilds)) {
			?>
			<div class="product-fields">
				<?php foreach ($this->product->customsChilds as $field) { ?>
				<div class="product-field product-field-type-<?php echo $field->field->field_type ?>">
					<span class="product-fields-title"><strong><?php echo JText::_ ($field->field->custom_title) ?></strong></span>
					<span class="product-field-desc"><?php echo JText::_ ($field->field->custom_value) ?></span>
					<span class="product-field-display"><?php echo $field->display ?></span>

				</div><br/>
				<?php } ?>
			</div>
			<?php }

		if (!VmConfig::get('use_as_catalog', 0) and !empty($this->product->prices['salesPrice'])) {
		?>

		<?php
		if($this->product->category_name == "Customize") {
		?>
		<div class="addtocart-bar addtocart-bar-customize">
		<?php } else { ?>
		<div class="addtocart-bar">
		<?php }// end if/else ?>

			<?php // Display the quantity box

			$stockhandle = VmConfig::get ('stockhandle', 'none');
			if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($this->product->product_in_stock - $this->product->product_ordered) < 1) {
				?>
				<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $this->product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>

				<?php } else { ?>
				<!-- <label for="quantity<?php echo $this->product->virtuemart_product_id; ?>" class="quantity_box"><?php echo JText::_ ('COM_VIRTUEMART_CART_QUANTITY'); ?>: </label> -->
				<span class="quantity-box">
                    <label>Quantity</label>
				<input type="text" class="quantity-input js-recalculate" name="quantity[]" value="<?php if (isset($this->product->min_order_level) && (int)$this->product->min_order_level > 0) {
				echo $this->product->min_order_level;
		} else {
			echo '1';
		} ?>"/>
	    </span>
          <span class="quantity-controls js-recalculate">
          <!-- Removed for KB Murals theme. -->
		<!-- <input type="button" class="quantity-controls quantity-plus"/> -->
		<!-- <input type="button" class="quantity-controls quantity-minus"/> -->
	    </span>
				<?php // Display the quantity box END ?>

				<?php
				// Display the add to cart button
				?>
				<span class="addtocart-button">
		<?php echo shopFunctionsF::getAddToCartButton ($this->product->orderable); ?>
		</span>
				<?php } ?>

			<div class="clear"></div>
		</div>
		<?php }
		 // Display the add to cart button END  ?>
		<input type="hidden" class="pname" value="<?php echo htmlentities($this->product->product_name, ENT_QUOTES, 'utf-8') ?>"/>
		<input type="hidden" name="option" value="com_virtuemart"/>
		<input type="hidden" name="view" value="cart"/>
		<noscript><input type="hidden" name="task" value="add"/></noscript>
		<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $this->product->virtuemart_product_id ?>"/>
	</form>

	<div class="clear"></div>
</div>
