<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
global $Itemid;
$mainframe = JFactory::getApplication();

//global $vm_mainframe;




JHTML::stylesheet('virtueupl_front.css','components/com_virtueupload/assets/css/');
JHTML::stylesheet('slimbox.css','administrator/components/com_virtueupload/assets/css/');

// CSS for Custom File Upload styling. For KB Murals theme.
JHTML::stylesheet('enhanced.css','components/com_virtueupload/assets/css/');
JHTML::stylesheet('basic.css','components/com_virtueupload/assets/css/');


// Commented out scripts for KB Murals site. They conflicting with existing scripts.
//mod by ym in 2012-1-27 new attribute number
//JHTML::script('administrator/components/com_virtueupload/assets/js/mootools.js',true);
//JHTML::script('administrator/components/com_virtueupload/assets/js/slimbox.js',true);
JHTML::script('administrator/components/com_virtueupload/assets/js/kevinAdd.js',true);  //add by ym in 2012-1-1

//jQuery Custom File Upload Input styling. For KB Murals theme.
JHTML::script('components/com_virtueupload/assets/js/jQuery.fileinput.js',true);

//JHTML::script( 'mootools.js','administrator/components/com_virtueupload/assets/js/',true );
//JHTML::script( 'slimbox.js','administrator/components/com_virtueupload/assets/js/',true  );

$document = JFactory::getDocument();
$document->addScriptDeclaration('
    jQuery(document).ready(function($) {
        $("#file").customFileInput();
    });
');

	    $config 		= VUOutput::config();
	    $user 			=& JFactory::getUser();
	    $document		=& JFactory::getDocument();
		$jscript		= '';
		//vars VU
	    $msg			= JRequest::getVar('msg', '');
	    $upload_id		= JRequest::getInt('upload_id', 0);




if($config->allow_upload)
{
	if ($upload_id) {
		$uploadinfo = VUOutput::UploadInfoId($upload_id, 'module');
	}
?>

<div id="virtueupl_form">
<div id="upload_image" class="customize_title">
	<h4>Upload Your Image</h4>
</div>

<span>For best results choose high-resolution images.</span><br />
<span>PNG, JPG, GIF, BMP and TIF files accepted.</span><br /><br />  
<form id="adminForm" name="adminForm"  action="<?php echo JRoute::_('index.php?option=com_virtueupload&view=form'); ?>" method="post" enctype="multipart/form-data" onSubmit="return checkForm();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="3" valign="top">
    	<!-- Commented out for KB Murals theme. -->
		<!-- <label for="file"><?php //echo VUOutput::_('YLANG_FORM_LBL_FILE'); ?></label><br/> -->
		<input name="file" type="file" id="file" />
    </td>
  </tr>
  <tr>  
    <td colspan="3" valign="bottom" align="left">
		<input id="upload_button" class="button" type="submit" value="<?php echo VUOutput::_('YLANG_UPLOAD'); ?>" onclick="this.form.status.value = '<?php echo VUOutput::_('YLANG_STAT_INITUPL'); ?> '; $('spinner').style.display = 'block';	this.form.status.style.color = '#339900';" />
    </td>
  </tr>
  <tr>
  	<!-- Commented out for KB Murals theme. -->
    <!--
    <td colspan="3" width="" height="30px" align="left" valign="middle">
		<label for="status"><?php echo VUOutput::_('YLANG_FORM_STATUS'); ?></label>
    </td>
    -->
    <td>
		<img id="spinner" src="/components/com_virtueupload/assets/ajax-loader.gif" alt="Loading...">
	</td>
     <td colspan="3" >
         <input class="vu_status" size="30" type="text" id="status" name="status" readonly="readonly" value="" />
     </td>
 </tr>
<?php 
 if ($uploadinfo) {
?>
  <tr>
    <td colspan="3">
		<?php 
			//echo $uploadinfo; 
			echo VUOutput::getStatus($msg);
			
		?>
	</td>
 </tr>

<?php 
}
?>

<?php

$jconfig=& JFactory::getConfig(); 

$mosConfig_host=$jconfig->getValue( 'config.host' );
$mosConfig_db=$jconfig->getValue( 'config.db' );
$mosConfig_user=$jconfig->getValue( 'config.user' );
$mosConfig_password=$jconfig->getValue( 'config.password' );

//$db=& JFactory::getDBO(); 

	$dbtmp=mysql_connect($mosConfig_host,$mosConfig_user ,$mosConfig_password);
	mysql_select_db($mosConfig_db,$dbtmp);

    $user = & JFactory::getUser();
	$userid=$user->id;

    $folder="";
    //if(!$userid)
    // $folder=$_SESSION['sid_before_login'];
	//else
     //$folder="ID".$userid."ID";      


//echo "SELECT * FROM  jos_virtueuploads WHERE (user_id <> 0 and user_id=".$userid.")  or session_id='".$_SESSION['sid_before_login']."' order by id desc"; exit();


//2012-1-27    hlptw_
$db=& JFactory::getDBO(); 
$dbprfix=$db->getPrefix();
$tablevmuploadmain=$dbprfix."virtueuploads";
	$dbrs=mysql_query("SELECT * FROM  ".$tablevmuploadmain." WHERE ((user_id <> 0 and user_id=".$userid.")  or session_id='".$_SESSION['sid_before_login']."' )	and session_id<>'finished'  and ip='".$this->product->product_sku."' order by id desc");   //add [and ip='".$this->product->product_sku."'] in 2012-3-1

//echo "SELECT * FROM  #__virtueuploads WHERE ((user_id <> 0 and user_id=".$userid.")  or session_id='".$_SESSION['sid_before_login']."' )	and session_id<>'finished' order by id desc";

	while ($dbrs && $myrow_cur = mysql_fetch_array($dbrs))
	{
		if(!$myrow_cur["user_id"])
		 $folder=$_SESSION['sid_before_login'];
		else
		 $folder="ID".$userid."ID";  

        $mainpic=$config->uploadpath.'/'.$folder.'/'.$myrow_cur["file_name"];

		$fileinfo2 = pathinfo( $myrow_cur["file_name"]);

			$ext2 = $fileinfo2['extension'];

		$basename =  basename( $myrow_cur["file_name"], '.'.$ext2 ) ;
       
   if($_SESSION['bindfiles'] && in_array($myrow_cur["id"],$_SESSION['bindfiles']))
   {
	  // Hidding checkbox for KB Murals theme.
	  echo '<tr>
	  			<td style="display:none"><input type=checkbox name=selectedfiles[] id=selectedfiles value='.$myrow_cur["id"].' checked></td>
	  		</tr>';
?>
			<tr>
				<td height="50px" valign="top" align="left">
					<input id="delete_button" type="submit" value="<?php echo VUOutput::_('YLANG_DELETEFILE'); ?>" onclick="this.form.status.value = 'Deleting uploaded file...'; $('spinner').style.display = 'block'; this.form.status.style.color = '#339900'; return( del_file( this.form ) );" />
				</td>
<?php	  		
	  		
   }
   else
      echo '<tr><td><input type=checkbox name=selectedfiles[] id=selectedfiles value='.$myrow_cur["id"].'></td>';
	 //echo '<td><a rel="SqueezeBox" href="'.$mainpic.'" title="CAPTION" class="modal"><img src="'.$thumbpic.'" alt="The thumb" /><span>image description</span></a></td>';
		$fileinfo = VUOutput::FiletypeInfo ($myrow_cur["file_name"]);

     if ($config->show_thumb) {
		if ($fileinfo->thumb == 'image') {
			 $thumbpic=$config->uploadpath.'/'.$folder.'/'.'thumb'.'/'.$basename.'_thumb.'.$ext2;
              echo '<td><a  href="'.$mainpic.'" rel="lightbox" title="enlarge"><img src="'.$thumbpic.'" alt="The thumb" /></a></td>';
		}
		else
        {
			 $thumbpic="components/com_virtueupload/assets/icons/".$fileinfo->thumb;
              echo '<td><a  href="#"  title="download"><img src="'.$thumbpic.'" alt="The thumb" /></a></td>';		      
		}
     }
     // Commented out for KB Murals theme.
	 //echo '<td>'.$myrow_cur["file_name"];
	 //echo "</td>";

/*mask by ym in 2012-3-1
	    if($_SESSION['bindfiles'])
		{
	       if(in_array($myrow_cur["id"],$_SESSION['bindfiles']))
		   {
		      echo "<td><span style='color:red'>".VUOutput::_( 'YLANG_BINDTOORDER')."</span></td>";
		   }
	    }
*/
     echo "</tr>";

    }
?>

<!-- mask by ym in 2012-3-1
    <td height="70px" valign="bottom" align="right">
		<input id="addfile_button" class="button" type="submit" value="<?php echo VUOutput::_('YLANG_BIND'); ?>" onclick="return( add_file( this.form ) );" />
	</td>
-->
</tr>
<!-- mask by ym in 2012-3-1
<tr>
   <td colspan=4 height="70px" valign="bottom" align="left"><span style="color:red"><?php echo VUOutput::_('YLANG_BIND_DES'); ?><span></td>
</tr>
-->

 </table>
<?php echo $jscript; ?>

<?php echo JHTML::_( 'form.token' ); ?>

<input type="hidden" name="task" value="submit" />
<input type="hidden" name="prod_id" value="<?php echo $form->prod_id; ?>" />
<input type="hidden" name="cat_id" value="<?php echo $form->cat_id; ?>" />
<input type="hidden" name="uri_url" value="<?php echo  VUOutput::_getUriString(); ?>" />
<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
<input type="hidden" name="userid" value="<?php echo $user->id; ?>" />
<input type="hidden" name="session_id" value="<?php echo $form->session_id; ?>" />
<input type="hidden" name="sku" value="<?php echo $this->product->product_sku; ?>" />
<input type="hidden" name="controller" value="entry" />

<!-- card_data -->
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid']; ?>" />
	<input type="hidden" name="user_id" value="<?php echo $_REQUEST['user_id']; ?>" />
	<input type="hidden" name="func" value="checkoutProcess" /> 
	<input type="hidden" name="zone_qty" value="<?php echo $_REQUEST['zone_qty']; ?>" />
    <input type="hidden" name="ship_to_info_id" value="<?php echo $_REQUEST['ship_to_info_id']; ?>" />
    <input type="hidden" name="shipping_rate_id" value="<?php echo urlencode($_REQUEST['shipping_rate_id']); ?>" />
    <input type="hidden" name="payment_method_id" value="<?php echo $_REQUEST['payment_method_id']; ?>" />
    <input type="hidden" name="checkout_this_step[]" value="<?php echo $_REQUEST['checkout_this_step']; ?>" />



</form>

</div>

<?php


/*  //mask by ym in 2012-1-1

	echo vmCommonHTML::scriptTag('', "function del_file( form ) {
        var if_checked = 0;


                if(form.elements['selectedfiles'].checked)
                {
                        if_checked = 1;
                }

        for (var i=0; i < form.elements['selectedfiles'].length; i++)
        {

                if(form.elements['selectedfiles'][i].checked)
                {
                        if_checked = 1;
                        break;
                }
        }
        if(if_checked == 0)
        {
                alert('please select one file at least!');
                return false;
        }
        

		form.task.value='delete_file'; 
        return true;
}" );

	echo vmCommonHTML::scriptTag('', "function add_file( form ) {

        
		form.task.value='add_file'; 
        return true;
}" );

*/

//echo VUOutput::getStatus($msg);

}//if allow_upload

?>