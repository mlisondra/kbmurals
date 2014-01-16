<?php
$thumbWidth = 100;
$thumbHeight = 100;
$newFilename = 'newfilename.jpg';
extract($_POST); // Extract the $x1, $y1, $w, $h, $extension, 
//$filename, $width, $height variables
 
//Now lets create the thumbnail

// GD Function List
$gdExtensions = array (
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
$source_handle = $function_to_read($filename);

if ($source_handle) {
	// Create a blank image
	$destination_handle = ImageCreateTrueColor($thumbWidth, $thumbHeight);

	// Put the cropped area onto the blank image
	$check = ImageCopyResampled($destination_handle, $source_handle, 0, 0, $x1, $y1, $thumbWidth, $thumbHeight, $w, $h);
}// End if

// Save the image
$function_to_write($destination_handle, $newFilename);
ImageDestroy($destination_handle);

// Check for any errors
if ($check) {
	echo "Thumbnail created";
} else {
	echo "Thumbnail failed to create";
}// End if/else
?>