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
class VUThumb {

	function makeThumb( $file_path, $file_name, $upload_id ) {
	    $config 	= VUOutput::config();
		$thumbpath 	= 'components'.DS.'com_virtueupload'.DS.'assets'.DS.'icons'.DS;
		$fileinfo = VUOutput::FiletypeInfo ($file_name);
		if ($fileinfo->thumb == 'image') {
			$thumburl = VUThumb::makeThumbnail($file_path, $upload_id );
			$thumburl = $thumburl;
		} else {
			$thumburl = $thumbpath.$fileinfo->thumb;
		}
		
		return $thumburl; 
	}




	
	///// Thumbnail aanmaken van bronfile
	///// returns  $thumb_link 
	function makeThumbnail( $image_path, $upload_id ) {
		$config 	= VUOutput::config();
		$thumbwidth = $config->thumbwidth;
		if (substr($thumbwidth, -2, 2 ) == 'px') {
			$thumbwidth = substr($thumbwidth, 0, -2 );
		}
		$thumbheight = $config->thumbheight;
		if (substr($thumbheight, -2, 2 ) == 'px') {
			$thumbheight = substr($thumbheight, 0, -2 );
		}
		//thumbgrootte bepalen
		$imgArr = @getimagesize( $image_path );
		if ($imgArr[0] < $imgArr[1]) {
			$width = round((($imgArr[0] / $imgArr[1])*$thumbheight));
			$height = $thumbheight;
		} else {
			$width = $thumbwidth;
			$height = round((($imgArr[1] / $imgArr[0])*$thumbwidth));
		}
		//filename ophalen
		$resizedFile = VUThumb::getResizedFilename( $image_path, $upload_id );
		$resizedFile = $config->uploadpath.DS.$resizedFile;
		$resizedFilepath = JPATH_ROOT.DS.$resizedFile;
		
	

		//resizen
		if (VUThumb::resizeImage($image_path, $resizedFilepath, $height, $width)) {
			return $resizedFile;
		}
		else {
			return false;
		}
	}

	///// Thumbnail aanmaken 
	///// oproepem Virtuemart Img2Thumb class 
	function resizeImage($sourceFile, $resizedFile, $height, $width, $enlargeSmallerImg=false ) {
		
		//Class for resizing Thumbnails
		//require_once( JPATH_BASE."/administrator/components/com_virtuemart/classes/ps_main.php");
		require_once( JPATH_BASE."/administrator/components/com_virtueupload/classes/class.img2thumb.php");  //mod by ym in 2012-1-4
		$Img2Thumb = new Img2Thumb( $sourceFile, $width, $height, $resizedFile, 0, 255, 255, 255 );
		if( is_file( $resizedFile )) {
			return true;
		}
		else {
			return false;
		}
	}

	///// Resized filename bepalen.
	function getResizedFilename( $filename, $upload_id ) {
		$fileinfo = pathinfo( $filename );
		if( $ext == '' ) {
			$ext = $fileinfo['extension'];
		}
		$basename =  basename( $filename, '.'.$ext ) ;

		return $upload_id.DS."thumb".DS.$basename.'_thumb.'.$ext;
	}

}
?>
