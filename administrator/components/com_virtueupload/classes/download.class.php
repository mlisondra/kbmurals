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
class VUDownload {

	function download ($id) {


//add by ym
if(!isset($GLOBALS['VM_LANG']))
{

require_once  JPATH_COMPONENT_ADMINISTRATOR . DS . 'classes' . DS .'language.class.php';
  $GLOBALS['VM_LANG'] = $GLOBALS['PHPSHOP_LANG'] =& new vmLanguage();
  $GLOBALS['VM_LANG']->load('upload');
}


		$file = VUOutput::UploadInfoId($id);

		$absOrRelFile	= JPATH_BASE.DS.$file->link; 

		$fileWithoutPath	= basename($absOrRelFile);
		$fileSize 			= filesize($absOrRelFile);
		$ctype				= "application/force-download";
		$filetype 			= VUOutput::FiletypeInfo (fileWithoutPath);
		$ctype 				= $filetype->ctype;
				
		clearstatcache();
		ob_end_clean();
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Cache-Control: public");
					header("Content-Description: File Transfer");
					header('Content-Type:' . $ctype ) ;
					header('Content-Length: ' . $fileSize);
					header('Content-Disposition: attachment; filename='.$fileWithoutPath);
					header("Content-Transfer-Encoding: binary\n");
		ob_clean();
		readfile($absOrRelFile);
		exit;
	}





}
?>