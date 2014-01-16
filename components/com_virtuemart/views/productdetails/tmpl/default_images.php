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
vmJsApi::js( 'jquery.imgareaselect.pack');
vmJsApi::css('imgareaselect-default');
vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
vmJsApi::css('jquery.fancybox-1.3.4');
$document = JFactory::getDocument ();
$mainframe = JFactory::getApplication();

// Obtain file upload information.
$upload_id = JRequest::getInt('upload_id', 0);
$database =& JFactory::getDBO();
$query = "SELECT * 
	FROM `#__virtueuploads` 
	WHERE `id` = '$upload_id'";
$database->setQuery($query);
$upload_info = $database->loadObject();

$_SESSION["upload_info"] = $upload_info;

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

// Changes frame style, tile size and mural size, to preview, depending on user selection in the cart.
$document->addScriptDeclaration('
	jQuery(document).ready(function($) {
		// Obtain square image name and location
		var square_image = $(".main-image img").attr("src");
		// Obtain rectangle image name and location
		//var rectangle_image = square_image.replace(".jpg","_rectangle.jpg");
		var rectangle_image = $(".additional-images img").attr("src");
		$(".additional-images").hide();
			
		// Main image size changed
		$("#customPrice024").change(function() {
			var main_image_size = $(this).find("option:selected").text();
			
			switch (main_image_size)
			{
				// Square image
				case "Square  ":
					$(".main-image img").attr("src", square_image);
					$(".main-image img").css({
						"width":"425px",
						"margin":"75px 85px 75px 85px"
					});					
					var current_tile_size = get_current_tile_size();
					var current_frame_type = get_current_frame_type();
					change_tile_size(current_tile_size, main_image_size);
					change_frame_type(current_frame_type, main_image_size);
					break;
				// Rectangle image					
				case "Rectangle +$200.00":
					$(".main-image img").attr("src", rectangle_image);
					$(".main-image img").css({
						"width":"425px",
						"margin":"120px 85px 75px 85px"
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
			var frame_type = $(this).find("option:selected").text();
			var current_main_image_size = get_current_main_image_size();
			change_frame_type(frame_type, current_main_image_size);
		});// End frame type changed		
					  
		// Tile size changed
		$("#customPrice125").change(function() {
			var tile_size = $(this).find("option:selected").text();
			var current_main_image_size = get_current_main_image_size();
			change_tile_size(tile_size, current_main_image_size);
		});// End tile size changed
		
		/* FUNCTIONS */
		// Get current main image size
		function get_current_main_image_size() {
			var select_main_image_size = $("#customPrice024").find("option:selected").text();
			return select_main_image_size;
		}// End get_current_main_image_size
			
		// Get current frame type
		function get_current_frame_type() {
			var select_frame_type = $("#customPrice327").find("option:selected").text();
			return select_frame_type;
		}// End get_current_frame_type
		
		// Get current tile size
		function get_current_tile_size() {
			var select_tile_size = $("#customPrice125").find("option:selected").text();
			return select_tile_size;
		}// End get_current_tile_size function
		
		function change_tile_size(tile_size_returned, main_image_size_returned) {
			// Square image
			if(main_image_size_returned == "Square  ") {
				switch (tile_size_returned)
				{
					// Small square tiles
					case "Small  ":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_small_tiles.png\')");
						break;
					// Medium square tiles	
					case "Medium +$50.00":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_medium_tiles.png\')");
						break;
					// Large square tiles	
					case "Large +$100.00":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/square_large_tiles.png\')");
						break;					
				}// End switch	
				
				$("#main-image-tiles").css({
					"height":"425px",
					"top":"131px"
				});	
			// Rectangle image						
			} else if(main_image_size_returned == "Rectangle +$200.00") {
				switch (tile_size_returned)
				{
					// Small rectangle tiles
					case "Small  ":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_small_tiles.png\')");
						break;
					// Medium rectangle tiles	
					case "Medium +$50.00":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_medium_tiles.png\')");
						break;
					// Large rectangle tiles	
					case "Large +$100.00":
						$("#main-image-tiles").css("background-image", "url(\'/images/stories/virtuemart/tiles/rectangle_large_tiles.png\')");
						break;					
				}// End switch	
				
				$("#main-image-tiles").css({
					"height":"328px",
					"top":"180px"
				});		
			}// End if/else if
		}// End of change_tile_size function
		
		function change_frame_type(frame_type_returned, main_image_size_returned) {
			// Square image
			if(main_image_size_returned == "Square  ") {
				switch (frame_type_returned)
				{
					case "Stone  ":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_stone_frame.png\')");
						break;
					case "Black Metal +$25.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_metal_black_frame.png\')");
						break;
					case "Oak Wood +$100.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_oak_wood_frame.png\')");
						break;		
					case "Cherry Wood +$100.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/square_cherry_wood_frame.png\')");
						break;				
				}// End switch
			// Rectangle image
			} else if(main_image_size_returned == "Rectangle +$200.00") {	
				switch (frame_type_returned)
				{
					case "Stone  ":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_stone_frame.png\')");
						break;
					case "Black Metal +$25.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_metal_black_frame.png\')");
						break;
					case "Oak Wood +$100.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_oak_wood_frame.png\')");
						break;		
					case "Cherry Wood +$100.00":
						$("#main-image-frame").css("background-image", "url(\'/images/stories/virtuemart/frames/rectangle_cherry_wood_frame.png\')");
						break;				
				}// End switch
			}// End if/else if	
		}// End of change_frame_type function							  
	});// End document ready
');

// Determine natural size of photo for imgAreaSelect's imageHeight and imageWidth attributes.
list($photoWidth, $photoHeight, $photoType, $photoAttr) = getimagesize($upload_info->link);

if(!isset($photoWidth)) {
	$photoWidth = 0;
}// End if

if(!isset($photoHeight)) {
	$photoHeight = 0;
}// End if

// Bind imgAreaSelect plugin to custom photo, make crop selection and validate crop selection.
$document->addScriptDeclaration('
	jQuery(document).ready(function($) {
		jQuery.extend(jQuery.imgAreaSelect.prototype, {
			animateSelection: function (x1, y1, x2, y2, duration) {
				var fx = jQuery.extend(jQuery("<div/>")[0], {
					ias: this,
					start: this.getSelection(),
					end: { x1: x1, y1: y1, x2: x2, y2: y2 }
				});

				jQuery(fx).animate({
					cur: 1
				},
				{
					duration: duration,
					step: function (now, fx) {
						var start = fx.elem.start, end = fx.elem.end,
							curX1 = Math.round(start.x1 + (end.x1 - start.x1) * now),
							curY1 = Math.round(start.y1 + (end.y1 - start.y1) * now),
							curX2 = Math.round(start.x2 + (end.x2 - start.x2) * now),
							curY2 = Math.round(start.y2 + (end.y2 - start.y2) * now);
						fx.elem.ias.setSelection(curX1, curY1, curX2, curY2);
						fx.elem.ias.update();
					}
				});
			}
		});

		jQuery(function () {
			jQuery("#rectangle_crop_button").click(function () {
				var ias = jQuery("#custom_photo").imgAreaSelect({ 
					aspectRatio: "4:3", 
					fadeSpeed: 400, 
					handles: true, 
					persistent: true, 
					instance: true, 
					imageHeight:' . $photoHeight . ',
					imageWidth:' . $photoWidth . ',					
					onSelectEnd: function (img, selection) {
						jQuery("#x1").val(selection.x1);
						jQuery("#y1").val(selection.y1);
						jQuery("#x2").val(selection.x2);
						jQuery("#y2").val(selection.y2); 
						jQuery("#w").val(selection.width);
						jQuery("#h").val(selection.height);           
					} 
				});
				
				if (!ias.getSelection().width) {
					ias.setOptions({ show: true, x1: 199, y1: 149, x2: 200, y2: 150 });
				}// End if
				
				ias.animateSelection(100, 75, 300, 225, "slow");
			});
			
			jQuery("#square_crop_button").click(function () {
				var ias = jQuery("#custom_photo").imgAreaSelect({ 
					aspectRatio: "1:1", 
					fadeSpeed: 400, 
					handles: true, 
					persistent: true, 
					instance: true,
					imageHeight:' . $photoHeight . ',
					imageWidth:' . $photoWidth . ',
					onSelectEnd: function (img, selection) {
						jQuery("#x1").val(selection.x1);
						jQuery("#y1").val(selection.y1);
						jQuery("#x2").val(selection.x2);
						jQuery("#y2").val(selection.y2); 
						jQuery("#w").val(selection.width);
						jQuery("#h").val(selection.height);           
					} 
				});
				if (!ias.getSelection().width) {
					ias.setOptions({ show: true, x1: 199, y1: 149, x2: 200, y2: 150 });
				}// End if
				
				ias.animateSelection(125, 75, 275, 225, "slow");
			});
		});	  

        jQuery("#saveThumb").click(function(){
            var x1 = jQuery("#x1").val();
            var y1 = jQuery("#y1").val();
            var x2 = jQuery("#x2").val();
            var y2 = jQuery("#y2").val();
            var w = jQuery("#w").val();
            var h = jQuery("#h").val();
            if (x1 == "" || y1 == "" || x2 == "" || y2 == "" || w == "" || h == "") {
                alert("You must make a selection first");
                return false;
            }
            else {
            	localStorage["cropped"] = "yes";
                return true;
            }
        });	
        
        var yetCropped = localStorage["cropped"];
        if (yetCropped == "yes") {
			jQuery(".customize_title#size_mural_customize").css("opacity", "1");
			jQuery(".customize_title#materials_customize").css("opacity", "1");	
			jQuery(".customize-field .product-fields-title-wrapper").css("display", "block");
			jQuery(".customize-field .product-field-display").css("display", "block");
			jQuery(".addtocart-bar-customize").css("opacity", "1");
			jQuery(".addtocart-bar-customize .addtocart-button").removeAttr("disabled");
			jQuery(".addtocart-bar-customize .addtocart-button").css("cursor", "pointer"); 
			jQuery(".addtocart-bar-customize .quantity-input").removeAttr("disabled"); 
			jQuery(".addtocart-bar-customize .quantity-input").css("cursor", "pointer");
			localStorage["cropped"] = "no";
        } else {
			jQuery(".customize_title#size_mural_customize").css("opacity", "0.2");
			jQuery(".customize_title#materials_customize").css("opacity", "0.2");	
			jQuery(".customize-field .product-fields-title-wrapper").css("display", "none");
			jQuery(".customize-field .product-field-display").css("display", "none");  
			jQuery(".addtocart-bar-customize").css("opacity", "0.2"); 
			jQuery(".addtocart-bar-customize .addtocart-button").attr("disabled", "disabled");
			jQuery(".addtocart-bar-customize .addtocart-button").css("cursor", "default");
			jQuery(".addtocart-bar-customize .quantity-input").attr("disabled", "disabled"); 
			jQuery(".addtocart-bar-customize .quantity-input").css("cursor", "default");    
        }
	});// End document ready
');

if (!empty($this->product->images)) {
	$image = $this->product->images[0];
	?>
<div class="main-image">

	<?php
		// Parse out file's name to extract file extension and determine file type.
		$split_file_name = explode(".", $upload_info->file_name);
		$file_name_extension = $split_file_name[count($split_file_name) - 1];
		$_SESSION["file_name_extension"] = $file_name_extension;
		
		// Parse out file's name to remove file extension.
		$file_name_no_extension = $split_file_name[0];
		
		// Parse out link to extract upload directory and upload user folder.
		$split_link = explode("/", $upload_info->link);
		$upload_directory = $split_link[0];
		$upload_user_folder = $split_link[1];
		$upload_directory_location = $upload_directory."/".$upload_user_folder."/";
		
		// Test if file was uploaded. If file was uploaded change default image to uploaded image, 
		// provide crop selection buttons, and crop selection submit button.
		if(isset($upload_info->id)) {
			if(!isset($_POST["x1"])) {
				echo "<div class='customize_main_image'>";
				echo "<img id='custom_photo' src='".$upload_info->link."' >";
				echo "</div>";
			} else {
				$file_name = $_SESSION["uploaded_file_name"];
				//echo "<img id='custom_photo' src='".$upload_directory_location."cropped_file.jpg' >";
				echo "<div class='customize_main_image'>";
				echo "<img id='custom_photo' src='".$upload_info->link."' >";
				echo "</div>";
				
				// Create cropped image.

				// Extract the $x1, $y1, $w, $h, $extension, $filename, $width, $height variables.
				extract($_POST);
				$thumbWidth = $w;
				$thumbHeight = $h;
				$croppedFilename = $upload_directory_location.'cropped_file.jpg';				
 				
				//Now lets create the thumbnail

				// GD Function List
				$gdExtensions = array (
				'jpeg'=>'JPEG',
				'jpg'=>'JPEG',
				'gif'=>'GIF',
				'bmp'=>'WBMP',
				'png'=>'PNG'
				);

				$check = false;

				$gdExtension = $gdExtensions[$extension];
				$function_to_read = "ImageCreateFrom".$gdExtension;
				$function_to_write = "Image".$gdExtension;

				// Read the source file
				$source_handle = $function_to_read($upload_directory_location.$filename);

				if ($source_handle) {
					// Create a blank image
					$destination_handle = ImageCreateTrueColor($thumbWidth, $thumbHeight);

					// Put the cropped area onto the blank image
					$check = ImageCopyResized($destination_handle, $source_handle, 0, 0, $x1, $y1, $thumbWidth, $thumbHeight, $w, $h);
				}// End if

				// Save the image
				$function_to_write($destination_handle, $croppedFilename);
				ImageDestroy($destination_handle);
				
				// Rename orignal file by appending _original to the file name. 
				// Rename new cropped file with original file name.
				$original_file_name = $upload_info->link;
				$cropped_file_name = $upload_directory_location.'cropped_file.jpg';
				$renamed_original_file_name = $upload_directory_location.$file_name_no_extension."_original.".$file_name_extension;
								
				rename($original_file_name, $renamed_original_file_name);
				rename($cropped_file_name, $original_file_name);

				// Check for any errors
				if ($check) {
					$mainframe->enqueueMessage(JText::_('Cropped image created!'));
				} else {
					$mainframe->enqueueMessage(JText::_('Cropped image failed to be created!'), 'error');
				}// End if/else	
			}// End if/elseif
		} else {
			if($this->product->category_name == "Customize") {
				echo "<div class='customize_main_image'>";
				echo $image->displayMediaFull("",true,"rel='vm-additional-images'");
				echo "</div>";
			} else {
				echo $image->displayMediaFull("",true,"rel='vm-additional-images'");
			}// Enf if/else
		}// End if/else
	?>

	 <div class="clear"></div>
</div>

<?php if ($this->product->category_name != "Sale" && $this->product->category_name != "Featured" && $this->product->category_name != "Customize") { ?>
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