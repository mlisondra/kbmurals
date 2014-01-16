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
/**
 * Handles basic output of strings 
 *
 */

class VUOutput {

	// Statusmelding in JS zetten

	function getStatus ($msg) {
	$status = ''; 
		if($msg == '1') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_NOFILE')."';document.adminForm.status.style.color = '#FF0000';</script>";
		  }

		if($msg == '2') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_EXISTS')."';document.adminForm.status.style.color = '#FF0000';</script>";
		  }

		if($msg == '3') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_WRONGEXT')."';document.adminForm.status.style.color = '#FF0000';</script>";
		  }

		if($msg == '4') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_WRONGSIZE')."';document.adminForm.status.style.color = '#FF0000';</script>";
		  }

		if($msg == '5') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_SUCCESS')."';document.adminForm.status.style.color = '#339900';</script>";
		  }

		if($msg == '6') {
		  $status = "<script type='text/javascript'>document.adminForm.status.value = '".VUOutput::_('YLANG_STAT_WRONGFILENUM')."';document.adminForm.status.style.color = '#FF0000';</script>";
		  }

	  return $status;
	}
	
	/**
	 * Returns the URI string of the page we are looking at.
	 *
	 * @return URI string 
	 */
	function _getUriString() {
		//TODO: refactor this part to correct SEO/SEF behaviour - no absolute urls, only relative!
		$uri = JFactory::getURI();
		$suffix = '?';

		//modify by ym in 2012-1-27
		if ( $uri->getQuery() != '' ) {
			$suffix = '&';
		}
		//mod by ym in 2012-1-27
		$uriString = $uri->toString().$suffix;
		return $uriString;
	}


	function UploadInfo ($prod_params, $output = 1 ) {
		//$upload_id = VUOutput::UploadidfromAttrib ( $prod_params );
		//if ( $upload_id == 'geen' ) {
		//	$upload_id = 0;
		//}

         $database =& JFactory::getDBO();


		$query = "SELECT fileid 
			FROM `jos_joomlavm_ordref` 
			WHERE `orderid` = '$prod_params'";
	
		
		$database->setQuery($query);
		$retarr=$database->loadResultArray();
		if(!$retarr) return '';  //2011-3-25	

		foreach($retarr as $ret)
        {
		  $html =$html. VUOutput::UploadInfoId($ret, $output);
	    }
		return $html;
	
	}

//add by ym in 2012-2-5
	function UploadInfoX ($prod_params, $output = 1 ) {
		//$upload_id = VUOutput::UploadidfromAttrib ( $prod_params );
		//if ( $upload_id == 'geen' ) {
		//	$upload_id = 0;
		//}

        $database =& JFactory::getDBO();
		$query = "SELECT id 
			FROM `#__virtueuploads` 
			WHERE session_id = '$prod_params'";
//echo $query ; exit();

		$database->setQuery($query);
		$retarr=$database->loadResultArray();
		foreach($retarr as $ret)
        {
			//echo $ret;
		  $html =$html. VUOutput::UploadInfoId($ret, $output);
	    }

		return $html;
	}


	function UploadInfoId($upload_id, $output = 1 ) { 
	    $config 	= VUOutput::config();
	    $database =& JFactory::getDBO();
		$upload_id = intval($upload_id);
		if ( $upload_id === 0 ) {
			return false;
		}
		$query = "SELECT * 
			FROM `#__virtueuploads` 
			WHERE `id` = '$upload_id'";
		$database->setQuery($query);
		$upload = $database->loadObject();
		
		//url s en paden aanvullen
		$fileinfo = VUOutput::FiletypeInfo ($upload->file_name);
		$upload->file_ctype = $fileinfo->ctype;
		$upload->file_type = $fileinfo->type;
		$upload->download_url = '/index.php?option=com_virtueupload&controller=virtueupload&task=download&dl_id='.$upload_id;
		$upload->thumb_img = '';
		$upload->path = JPATH_ROOT.DS.$upload->link;
		$upload->url = JURI::root().DS.$upload->link;
		if ($upload->thumb && $config->show_thumb) {
			$upload->thumb_path = JPATH_ROOT.DS.$upload->thumb;
			$upload->thumb_url = JURI::root().DS.$upload->thumb;
			$upload->thumb_img = VUOutput::getThumb ($upload->thumb);
			$upload->thumb_img_small = VUOutput::getThumb ($upload->thumb,1);

		}
		
		//Object teruggeven als geen outputmode gevraagd is 
		$html='';
		//weergave maken
		switch( $output ) {
			case 1: 
			$html = $upload; 
			break;
			case "module": 
				$html .= '<table width="100%"><tr><td colspan="2"><h4>';
				$html .= VUOutput::_('YLANG_STAT_SUCCESS'); 
				$html .= '</h4></td><td rowspan="4" align="right" valign="bottom">';
				$html .= VUOutput::makeDLoadLink ($upload_id, $upload->thumb_img);
				$html .= '</td></tr><tr><td>';
				$html .= VUOutput::_('YLANG_FILE').":"; 
				$html .= '</td><td>';
				$html .= VUOutput::makeDLoadLink ($upload_id, $upload->file_name);
				$html .= '</td></tr><tr><td>';
				$html .= VUOutput::_('YLANG_FILETYPE').":"; 
				$html .= '</td><td>';
				$html .= $upload->file_type;
				$html .= '</td></tr><tr><td>';
				//add for jeena
				$html .= "SKU:"; 
				$html .= '</td><td>';
				$html .= $upload->ip;
				//$html .= $upload->ip;  //1028
				$html .= '</td></tr><tr><td>';


				$html .= VUOutput::_('YLANG_SIZE').":"; 
				$html .= '</td><td>';
				$html .= VUOutput::_getFileSize($upload->file_size);
				$html .= '</td></tr></table>';

			break;

			case "cart": 
				$html = '<br/>';
				$html .= VUOutput::_('YLANG_FILE').": ".VUOutput::makeDLoadLink ($upload_id, $upload->file_name)."<br/>"; 
				$html .= VUOutput::_('YLANG_SIZE').": ".VUOutput::_getFileSize($upload->file_size)."<br/>"; 
				$html .= VUOutput::makeDLoadLink ($upload_id, $upload->thumb_img_small)."<br/>";;
                $html .= "SKU:".$upload->ip;
				$html .= '<br/>';
			break;
			
			default:
				$html .= VUOutput::_('YLANG_ERROR_REQUEST'); 
		}
		return $html;
		$html='';
	}

	function getThumb ($thumburl, $small = false) {
	    $config 	= VUOutput::config();
		$iconwidth = $config->iconwidth;
		$iconheight = $config->iconheight;
		$file_name = VUOutput::lastPart ($thumburl, DS, $lowercase=true);
		$thumburlarr = explode ( DS , $thumburl );
		if ( $thumburlarr[0] != $config->uploadpath) {
			$icon = true;
		} 
		$attrib = Array('title'=>VUOutput::_( 'YLANG_DOWNLOAD' ), 'class'=>'vu_thumb');
		$imgArr = @getimagesize( JPATH_ROOT.DS.$thumburl );


    	if($imgArr[0]!=0 && $imgArr[1]!=0)  //2011-3-25
		{
			if ($imgArr[0] < $imgArr[1]) {
				$width = round((($imgArr[0] / $imgArr[1])*45));
				$height = 45;
			} else {
				$width = 45;
				$height = round((($imgArr[1] / $imgArr[0])*45));
			}
        }
		if ( $small && $icon ) {
			$style = array( width=>'45px', height=>'45px');
		} 
		if ( !$small && $icon ) {
			$style = array( width=>$iconwidth, height=>$iconheight);
		} 
		if ($small && !$icon ) {
			$style = array( width=>$width, height=>$height);
		}
		$thumb = JHTML::image( JURI::root().$thumburl , VUOutput::_( 'YLANG_DOWNLOAD' ), array_merge((array)$style, (array)$attrib)  );
		
		return $thumb; 
	
	}
	//javascript om upload_ip in te vullen in VirtueMart  
	function prepareScript() {
		$config = VUOutput::config();
		$upload_id = JRequest::getInt('upload_id', 0);
		$script = '';
		$script = "<script type='text/javascript'>";
		//verbergen of disabelen????
		$script .= "
window.addEvent('domready',function(){
		var uploadattr =  $('".$config->vm_attribute."_field');
		if (uploadattr) {
			uploadattr.readOnly = true;
			uploadattr.className = 'readonly';
			uploadattr.size = 2;
			if (uploadattr.value == '') {
				uploadattr.value = 'geen';
			}
		}
		";
		if ($upload_id > 0) {
			$script .= "uploadattr.value = '".$upload_id."';";
		}
		$script .= "});	"
				."</script>";
		return $script;
	}
	


// --------------------------------------------------------------------------------
// Helpers
// --------------------------------------------------------------------------------
	function FiletypeInfo ($file_name) {
		$ext = VUOutput::lastPart ($file_name, '.', true);
		//This will set the Content-Type to the appropriate setting for the file
		switch( $ext ) {
			 case "pdf": 
			 $fileinfo->ctype="application/pdf";
			 $fileinfo->type="PDF-file";
			 $fileinfo->thumb="pdf.gif";
			 break;
			 case "psd": 
			 $fileinfo->ctype="application/photoshop";
			 $fileinfo->type="Photoshop-file";
			 $fileinfo->thumb="psd.gif";
			 break;
			 case "ai": 
			 $fileinfo->ctype="application/illustrator";
			 $fileinfo->type="Illustrator-file";
			 $fileinfo->thumb="ai.gif";
			 break;
			 case "id": 
			 $fileinfo->ctype="application/imagedraw";
			 $fileinfo->type="ImageDraw-file";
			 $fileinfo->thumb="id.gif";
			 break;
			 case "zip": 
			 $fileinfo->ctype="application/zip";
			 $fileinfo->type="ZIP-file";
			 $fileinfo->thumb="zip.gif";
			 break;
			 case "docx":
			 case "doc":
			 $fileinfo->ctype="application/msword";
			 $fileinfo->type="Word-file";
			 $fileinfo->thumb="doc.gif";
			 break;
			 case "xlsx":
			 case "xls": 
			 $fileinfo->ctype="application/vnd.ms-excel";
			 $fileinfo->type="Excel-file";
			 $fileinfo->thumb="xls.gif";
			 break;
			 case "pptx":
			 case "ppt":
			 $fileinfo->ctype="application/vnd.ms-powerpoint";
			 $fileinfo->type="Powerpoint-file";
			 $fileinfo->thumb="ppt.gif";
			 break;
			 case "gif":
			 $fileinfo->ctype="image/gif";
			 $fileinfo->type="GIF-image";
			 $fileinfo->thumb="image";
			 break;
			 case "png":
			 $fileinfo->ctype="image/png";
			 $fileinfo->type="PNG-image";
			 $fileinfo->thumb="image";
			 break;
			 case "jpg":
			 case "jpeg":
			 $fileinfo->ctype="image/jpeg";
			 $fileinfo->type="JPG-image";
			 $fileinfo->thumb="image";
			 break;
			 case "mp3": 
			 $fileinfo->ctype="audio/mpeg";
			 $fileinfo->type="MP3-file";
			 $fileinfo->thumb="mp3.gif";
			 break;
			 case "mpeg":
			 case "mpg":
			 case "mpe":
			 $fileinfo->ctype="video/mpeg";
			 $fileinfo->type="MPG Video-file";
			 $fileinfo->thumb="video.gif";
			 break;
			 case "mov": 
			 $fileinfo->ctype="video/quicktime";
			 $fileinfo->type="MOV Video-file";
			 $fileinfo->thumb="video.gif";
			 break;
			 case "avi":
			 $fileinfo->ctype="video/x-msvideo";
			 $fileinfo->type="AVI Video-file";
			 $fileinfo->thumb="video.gif";
			 break;

			 //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
			 case "php":
			 case "htm":
			 case "html": if ($downpath) die("<b>Cannot be used for ". $file_extension ." files!</b>"); 

			 default:
			 $fileinfo->ctype="application/force-download";
			 $fileinfo->type="unknow file";
			 $fileinfo->thumb="default.gif";
			 
		}

		return $fileinfo;
	}
 	
	///// Upload-id herleiden vanuit orderitem-attributen
	///// returns $upload_id
	function UploadidfromAttrib ( $prod_attribs ) {

		$config = VUOutput::config();
		$vuattrib = strtolower($config->vm_attribute);
		$prod_attribs = strtolower($prod_attribs);
		//als enkel attribuut
		$attrib1 = explode ( ":" ,$prod_attribs) ;
		if ( $attrib1[0] == $vuattrib ) {
		return $attrib1[1];
		} 		
		//als meerdere attribs
		$prod_attribs1 = explode ( "; " , $prod_attribs ) ;
		foreach ( $prod_attribs1 as $prod_attrib) {	
		$attrib = explode ( ":" ,$prod_attrib) ;
		$attribs1[$attrib[0]] = $attrib[1];
		}
		if ($attribs1[$vuattrib]) {
		return $attribs1[$vuattrib];
		} 
		//zoeken in string
		$length = strlen ($vuattrib) + 2;
		$search = $vuattrib.":";
		if (stripos ( strtolower($prod_attribs) , $search )) {
			$start = stripos ( $prod_attribs , $search ) + $length;
			$upload_id = intval (substr ( $prod_attribs , $start, 5 ) );
			
			return $upload_id;
		}
		//anders geen id
		$upload_id = 0;
		return $upload_id;
	} 
	
	
///// Voeg order-id toe aan  image-record
///// vanuit orderitem-attributen en oder-id



function AddOrderid($order_id ) {

	$database 	= &JFactory::getDBO(); 
	$query = "select order_number from #__virtuemart_orders where virtuemart_order_id=".$order_id;
	$database->setQuery($query);
	$order_number = $database->loadResult();

	$query = "select first_name,last_name from #__virtuemart_order_userinfos where virtuemart_order_id=".$order_id;
	$database->setQuery($query);
    $row_usrname = $database->loadRow();
	$order_usrname = $row_usrname['2']." ".$row_usrname['1'];



			$user =& JFactory::getUser();  
			$userid=0;
            $username='';
 
         if(!$user->id)		
	     {		  
			//$myfolder=session_id();
		    $username=$order_usrname;
		 }
		 else
	     {
            //$myfolder="ID".$user->get('id')."ID";
			$userid=$user->get('id');
            $username=$user->get('username');
         } 


  $config = VUOutput::config();
  $config_uploadfolder=$config->uploadpath;



	$fileid_arr=$_SESSION['bindfiles'];


  if($fileid_arr!=null)
  {
    foreach($fileid_arr as $fileid)
	{



		$sql = 'SELECT * FROM #__virtueuploads WHERE id = '.$fileid;
		$database->setQuery($sql);
		$uploadfile = $database->loadObject();
		$filepath=$uploadfile->link;
        $thumbpath=$uploadfile->thumb;
        $finename=$uploadfile->file_name;

if(!$uploadfile->user_id)
  $myfolder=session_id();
else
  $myfolder="ID".$user->get('id')."ID";


		$filepathnew=str_replace($myfolder,$order_number,$filepath);

//echo $filepath."ddddddddddddddddd".$filepathnew; exit();

        VUOutput::movefile($filepath,$filepathnew,$config_uploadfolder,$order_number);

        if(strstr($thumbpath,$myfolder))
        {
         $thumbpathnew= str_replace($myfolder,$order_number,$thumbpath);
         VUOutput::movefile($thumbpath,$thumbpathnew,$config_uploadfolder,$order_number);
        } 
		else
          $thumbpathnew=$thumbpath;

        $finenamenew=str_replace($myfolder,$order_number,$finename);


        


		$data = new stdClass;
		$data->id = $fileid;
        $data->file_name = $finenamenew; 
		$data->upload_by = $username;
		$data->user_id = $userid;
        $data->session_id ="finished";
        $data->link =$filepathnew;
		$data->thumb =$thumbpathnew;
       // $data->comment =$text2comments;   

		if (!$database->updateObject( '#__virtueuploads', $data,'id')) {
			echo $database->stderr();
			return false;
		}





		$data = new stdClass;
		$data->orderid = $order_id;
		$data->fileid = $fileid;
		if (!$database->insertObject( 'jos_joomlavm_ordref', $data)) {
			echo $database->stderr();
			return false;
		}







    }
	$_SESSION['bindfiles']=null;
	$_SESSION['bindtexts']=null;
  }
  else
  {
     return false;
  }

  

}
	
	
	function lastPart ($field, $separator, $lowercase=true) {
		$split_array = explode ( $separator, $field);
		$last = $split_array[count($split_array)-1];
		if ($lowercase) return strtolower($last);
	return $last;
	}

	
	function makeDLoadLink ($upload_id, $content) {
		$upload = VUOutput::UploadInfoId($upload_id);
		
		$link = '<a href="'.JURI::root().substr($upload->download_url,1).'" class="vu_dllink">';
		$link .= $content;
		$link .= '</a>';

		return $link;
	}
	
	
	/**
	 * Returns the singular or plural of "DATE" according to the dates set.
	 *
	 * @param date $date1
	 * @param date $date2
	 * @param date $date3
	 * @return string "date" or "dates"
	 */
	function getDatesType($date1, $date2, $date3) {
 		$dateText = VUOutput :: _('Date');
 		if (strtotime($date2) > strtotime($date1) || strtotime($date3) > strtotime($date1)) {
 			$dateText = VUOutput :: _('Dates');
 		}
 		return $dateText;
 	}

 	/**
 	 * Returns a formatted date
 	 *
 	 * @param date $date1
 	 * @param date $date2
 	 * @param date $date3
 	 * @param string $longFormat
 	 * @param string $shortFormat
 	 * @return date string 
 	 */
 	function getFormattedDate($date1, $date2, $date3, $longFormat, $shortFormat) {
		$dateString = '';
		if (strtotime($date2) > strtotime($date1)) {
			$strDate1 = JHTML::_('date', $date1, $longFormat, 0);
			$strDate2 = JHTML::_('date', $date2, $longFormat, 0);
			$dateString .= $strDate1 . ' - ' . $strDate2;
		} else {
			$strDate1 = JHTML::_('date', $date1, $longFormat, 0);
			$dateString = $strDate1;
		}
		if (strtotime($date3) >= strtotime($date1)) {
			$strDate3 = JHTML ::_('date', $date3, $longFormat, 0);
			$dateString .= '<br />('.VUOutput::_('YLANG_RESERVEDATE_LC').': ' . $strDate3 . ')';
		}
		return $dateString;
 	}

 	/**
 	 * Returns a formatted time
 	 *
 	 * @param time $from_time
 	 * @param time $to_time
 	 * @param string $format
 	 * @return time string
 	 */
 	function getFormattedTime($from_time, $to_time, $format) {
 		$timeString = '';
		if ( $from_time != NULL) {
			if (strtotime($from_time) !=  strtotime('00:00:00')) {
				$timeString = VUOutput::_('FROM_TIME_LC').' '.JHTML::_('date', $from_time, $format, 0);
				if ($to_time != NULL || strtotime($to_time) != strtotime($from_time)) {
					$timeString .= ' '.VUOutput::_('TO_TIME_LC').' '.JHTML::_('date', $to_time, $format, 0);
				}
			}
		}
		return $timeString;
 	}
 	
 	/**
 	 * Counts the days between today and a date
 	 *
 	 * @param date $date1
 	 * @param time $time1
 	 * @return integer string
 	 */
 	function countDays($date1, $time1) {
 		// catch null times
		if ($time1 == NULL) {
			$time1 = '00:00:00';
		}
		// get today date
		$date =& JFactory::getDate();
		$now  = $date->toMySQL();

		// get the date array
		$gd_today = getdate(strtotime($now));
		$gd_date1 = getdate(strtotime($date1.' '.$time1));

		// get the timestamp of the array
		$date1_ts = mktime($gd_date1['hours'], $gd_date1['minutes'], 0, $gd_date1['mon'], $gd_date1['mday'], $gd_date1['year'] );
		$today_ts = mktime(12, 0, 0, $gd_today['mon'], $gd_today['mday'], $gd_today['year'] );

		// get the result (difference in seconds between today and date1, divided by # of seconds in a day
		$result = round( ($today_ts - $date1_ts) / 86400 );

		// return the result
		return $result;
 	}


// --------------------------------------------------------------------------------
// Settings and parameter methods
// --------------------------------------------------------------------------------

 	/**
	 * Loads the configuration settings from the db, returns the object
	 *
	 * @return object $config
	 * @version 0.1
	 */
	function config() {
		$db =& JFactory::getDBO();

		$sql = 'SELECT * FROM #__virtueuploads_settings WHERE id = 1';
		$db->setQuery($sql);
		$config = $db->loadObject();

		return $config;
	}

	
// --------------------------------------------------------------------------------
// ComboBox helpers
// --------------------------------------------------------------------------------


	
// --------------------------------------------------------------------------------
// Category helpers 
// --------------------------------------------------------------------------------
	
	function showCategoryColor( $color, $title ) {
		JHTML::_('behavior.tooltip');
		$html = '<div style="height:100%; width: 5px; background-color: #'.$color.';">'. JHTML::tooltip($title, VUOutput::_('YLANG_Category'), '', '&nbsp;') .'</div>';
		return $html;
	}

// --------------------------------------------------------------------------------
// File download helper
// --------------------------------------------------------------------------------
	
	/**
	 * Helper to return the file size with the most appropriate size unit
	 *
	 * @since 0.7
	 * @param string $size
	 * @return string formatted size with unit
	 */
	function _getFileSize($size) {
		if ( (int) $size < 1024 ) {
			return (int) $size . ' bytes';
		} else if ( (int) $size >= 1024 && (int) $size < 1048576 ) {
			return (int) ($size/1024) . ' kB';
		} else if ( (int) $size >= 1048576 ) {
			return (int) ($size/1048576) . ' MB';
		}
		return '';
	}
	
	/**
	 * Returns the file Description and download link - checking the extension against its Mime Type
	 *
	 * @since 0.7
	 * @param string $file filename (incl. mime type and size info)
	 * @param string $link full path to file
	 * @param string $description the description of the file
	 * @return string $html the complete download link.
	 */
	function showFileDescription ( $file, $link, $description ) {
		$html = '';
		$filepart = explode('|', $file);
		if ( $description == '' ) {
			$html .= '<a href="'. JRoute::_($link). '">' . $filepart[0] . '</a>';
		} else {
			$html .= '<a href="'. JRoute::_($link). '">' . $description . '</a>';
		}
		$filetype = VUUpload ::extensionFromMime($filepart[1]);
		$html .= ' (' . strtoupper($filetype) . ', ' . VUOutput::_getFileSize($filepart[2]) . ')';
		return $html;
	}

//add by ym
		function _getUriString2() {
		//TODO: refactor this part to correct SEO/SEF behaviour - no absolute urls, only relative!


		$uri =& JFactory::getURI();   //modify by ym in 2012-1-27
		$suffix = '?';

		
		//$uriString = $uri->_path.$suffix;
		$uriString = $uri->getPath().$suffix;  //add by ym in 2012-1-27
		return $uriString;
	}
    
//add by ym
	function _($langTxt)
    {
/*
       if(!isset($GLOBALS['VM_LANG']->modules['upload'])) 
         $GLOBALS['VM_LANG']->load('upload');


       return $GLOBALS['VM_LANG']->modules['upload'][$langTxt];	
       
*/


	   return JText::_($langTxt); // add by ym in 2012-1-1
	}

    function movefile($src,$dest,$uploadfolder,$username)
    {
            /*
			if (!file_exists( JPATH_BASE.DS.$config->uploadpath)) {
			mkdir ( JPATH_BASE.DS.$config->uploadpath);
			}

			if (!file_exists( JPATH_BASE.DS.$config->uploadpath.DS.$myfolder)) {
			mkdir ( JPATH_BASE.DS.$config->uploadpath.DS.$myfolder);
			}
			$file_name = $myfolder."-".$file_name;
			move_uploaded_file($tmp_file,  JPATH_BASE.DS.$config->uploadpath.DS.$myfolder.DS.$file_name);	
			*/
			if (!file_exists( JPATH_BASE.DS.$uploadfolder)) {
			mkdir ( JPATH_BASE.DS.$uploadfolder);
			}

			if (!file_exists( JPATH_BASE.DS.$uploadfolder.DS.$username)) {
			mkdir ( JPATH_BASE.DS.$uploadfolder.DS.$username);
			}


			if (!file_exists( JPATH_BASE.DS.$uploadfolder.DS.$username.DS."thumb")) {
			mkdir ( JPATH_BASE.DS.$uploadfolder.DS.$username.DS."thumb");
			}		

			copy($src,  $dest);		
	
	}


}
?>