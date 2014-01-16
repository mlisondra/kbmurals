<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_images.php 6188 2012-06-29 09:38:30Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
vmJsApi::css('jquery.fancybox-1.3.4');
$document = JFactory::getDocument ();
$imageJS = '
jQuery(document).ready(function() {
	jQuery("a[rel=vm-additional-images]").fancybox({
		"titlePosition" 	: "inside",
		"transitionIn"	:	"elastic",
		"transitionOut"	:	"elastic"
	});
});
';
$document->addScriptDeclaration ($imageJS);

// Changes frame style, to preview, depending on user selection in the cart.
$document->addScriptDeclaration('
	jQuery(document).ready(function($) {
		// Main image size changed
		$("#customPrice024").change(function() {
			var main_image_size = $(this).val();
			
			switch (main_image_size)
			{
				// Square image
				case "57":
					$(".main-image img").attr("src", "/images/stories/virtuemart/product/product_sunset_abyss8.jpg");
					$(".main-image img").css({
						"width":"425px",
						"margin":"74px 85px 100px 85px"
					});					
					var current_tile_size = get_current_tile_size();
					var current_frame_type = get_current_frame_type();
					change_tile_size(current_tile_size, main_image_size);
					change_frame_type(current_frame_type, main_image_size);
					break;
				// Rectangle image					
				case "36":
					$(".main-image img").attr("src", "/images/stories/virtuemart/product/product_sunset_abyss8_rectangle.jpg");
					$(".main-image img").css({
						"width":"425px",
						"margin":"120px 85px 100px 85px"
					});
					var current_tile_size = get_current_tile_size();
					var current_frame_type = get_current_frame_type();
					change_tile_size(current_tile_size, main_image_size);
					change_frame_type(current_frame_type, main_image_size);
					break;				
			}//End switch
		});// End main image size changed
		
		// Frame type changed
		$("#customPrice327").change(function() {
			var frame_type = $(this).val();
			var current_main_image_size = get_current_main_image_size();
			change_frame_type(frame_type, current_main_image_size);
		});// End frame type changed		
					  
		// Tile size changed
		$("#customPrice125").change(function() {
			var tile_size = $(this).val();
			var current_main_image_size = get_current_main_image_size();
			change_tile_size(tile_size, current_main_image_size);
		});// End tile size changed
		
		/* FUNCTIONS */
		// Get current main image size
		function get_current_main_image_size() {
			var select_main_image_size = $("#customPrice024 :selected").val();
			return select_main_image_size;
		}// End get_current_main_image_size
			
		// Get current frame type
		function get_current_frame_type() {
			var select_frame_type = $("#customPrice327 :selected").val();
			return select_frame_type;
		}// End get_current_frame_type
		
		// Get current tile size
		function get_current_tile_size() {
			var select_tile_size = $("#customPrice125 :selected").val();
			return select_tile_size;
		}// End get_current_tile_size function
		
		function change_tile_size(tile_size_returned, main_image_size_returned) {
			// Square image
			if(main_image_size_returned == "57") {
				switch (tile_size_returned)
				{
					// Small square tiles
					case "58":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_small_tiles.png\')");
						break;
					// Medium square tiles	
					case "40":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_medium_tiles.png\')");
						break;
					// Large square tiles	
					case "42":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_large_tiles.png\')");
						break;					
				}// End switch	
				
				$("#main-image-tiles").css({
					"height":"425px",
					"top":"145px"
				});	
			// Rectangle image						
			} else if(main_image_size_returned == "36") {
				switch (tile_size_returned)
				{
					// Small rectangle tiles
					case "58":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_small_tiles.png\')");
						break;
					// Medium rectangle tiles	
					case "40":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_medium_tiles.png\')");
						break;
					// Large rectangle tiles	
					case "42":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_large_tiles.png\')");
						break;					
				}// End switch	
				
				$("#main-image-tiles").css({
					"height":"328px",
					"top":"194px"
				});		
			}// End if/else if
		}// End of change_tile_size function
		
		function change_frame_type(frame_type_returned, main_image_size_returned) {
			// Square image
			if(main_image_size_returned == "57") {
				switch (frame_type_returned)
				{
					case "60":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_stone_frame.png\')");
						break;
					case "62":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_metal_black_frame.png\')");
						break;
					case "47":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_oak_wood_frame.png\')");
						break;		
					case "63":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_cherry_wood_frame.png\')");
						break;				
				}// End switch
			// Rectangle image
			} else if(main_image_size_returned == "36") {	
				switch (frame_type_returned)
				{
					case "60":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_stone_frame.png\')");
						break;
					case "62":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_metal_black_frame.png\')");
						break;
					case "47":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_oak_wood_frame.png\')");
						break;		
					case "63":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_cherry_wood_frame.png\')");
						break;				
				}// End switch
			}// End if/else if	
		}// End of change_frame_type function							  
	});// End document ready
');

if (!empty($this->product->images)) {
	$image = $this->product->images[0];
	?>
<div class="main-image">

	<?php
		echo $image->displayMediaFull("",true,"rel='vm-additional-images'");
	?>

	 <div class="clear"></div>
</div>

<?php if ($this->product->category_name != "Sale" && $this->product->category_name != "Featured") { ?>
	<div id="main-image-tiles"></div>
	<div id="main-image-frame"></div>
<?php } ?>

<?php
	$count_images = count ($this->product->images);
	if ($count_images > 1) {
		?>
    <div class="additional-images">
		<?php
		for ($i = 1; $i < $count_images; $i++) {
			$image = $this->product->images[$i];
			?>
            <div class="floatleft">
	            <?php
	                echo $image->displayMediaFull("",true,"rel='vm-additional-images'");
	            ?>
            </div>
			<?php
		}
		?>
        <div class="clear"></div>
    </div>
	<?php
	}
}
  // Showing The Additional Images END ?>