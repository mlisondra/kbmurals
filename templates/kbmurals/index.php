<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<?php 
$menu = & JSite::getMenu();
$_SESSION['user']['authenticated'] = false;
$user =& JFactory::getUser();
$baseurl = JURI::root();

?>
<!DOCTYPE html>
<html>
	<head>
		<jdoc:include type="head" />
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="description" name="description" content="">
		<meta http-equiv="keywords" name="keywords" content="">
		<meta name="robots" content="index,follow">
		<meta name="revisit-after" content="10 days">
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/kbmurals/css/styles.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/kbmurals/css/template.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Economica:400,700|Oswald:400,700,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/kbmurals/css/jquery.bxslider.css" />
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/jquery.bxslider.min.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/css_browser_selector.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/scripts.js"></script>	
		
		<?php JHTML::_('behavior.mootools'); JHTML::_('behavior.modal'); ?>
		
		<script type="text/javascript">
			window.addEvent('domready', function(){
				if( $('system-message') ){
					SqueezeBox.initialize();
						SqueezeBox.open( $('system-message'), {
							handler: 'adopt',
							shadow: true,
							overlayOpacity: 0.2,
							size: {x: 600, y: 100},
							onOpen: function(){
							$('system-message').setStyle('visibility', 'visible');
						}
					});
				}
			});
		</script>
			
	</head>
<body>
	<div id="wrapper" style="padding-bottom:10px;"> <!--Start Wrapper-->
		<div class="content"> <!--Start Container-->
			<div id="navigation"> <!--Start Navigation-->
               	<a href="<?php echo JURI::base() ?>" id="logo">KB Murals</a>
				<div id="cta_bar"> <!--Start CTA Bar-->
					<div id="social">
						<a href="https://twitter.com/kbmurals" id="icon_twitter" target="_blank">Twitter</a>
						<a href="http://pinterest.com/kbmurals/" id="icon_pinterest" target="_blank">Pinterest</a>
						<a href="http://www.facebook.com/pages/KB-Murals/219778541474317?ref=stream" id="icon_facebook" target="_blank">Facebook</a>
					</div>                    
					<div id="sub_nav">
                          	<div id="username">
							<?php
                            // Displays name of logged in user.
							if ( $user->id ) 
							{
								$user =& JFactory::getUser();
								echo "<strong>Welcome ".$user->name."&nbsp;&nbsp;&nbsp;|&nbsp;</strong>";
							}
                                   ?>
                              </div> <!-- End username -->   
                                                       
                         	<jdoc:include type="modules" name="KBSubNav" />                   
					</div>
				</div> <!--End CTA Bar-->
				<jdoc:include type="modules" name="KBTopNav" />
				<div class="clear"></div>
			</div> <!--End Navigation-->


			<?php if ($menu->getActive() == $menu->getDefault()) { ?>
			<div id="home_header"> <!--Start Header-->
				<?php
					$article =& JTable::getInstance("content");
					$article->load(121);
					echo $article->get("introtext");						
				?>
			</div> <!--End Header-->
			<?php } ?>
			<div class="breadcrumb-container">
                    <jdoc:include type="modules" name="KBBreadcrumb" style="xhtml" />
                    <jdoc:include type="component" />
                    <jdoc:include type="modules" name="KBContactForm" />
                    <jdoc:include type="modules" name="KBShoppingCart" />
                    <jdoc:include type="modules" name="KBMainContent" style="xhtml" />
               </div>
		
          	<jdoc:include type="message" />
		
			<?php if ($menu->getActive() == $menu->getDefault()) { ?>
			<div id="home_content_left"> <!--Start Left Content-->
				<a href="index.php?option=com_virtuemart&view=categories&virtuemart_category_id=24" class="actions">
					<div class="title" id="ready_hang">
						<span></span>
					</div>
					<div class="kb_details">
						<?php
							$article =& JTable::getInstance("content");
							$article->load(93);
							echo $article->get("introtext");						
						?>
					</div>
				</a>
				<a href="###" class="video_cta modal" id="video_ready_hang" rel="ready_hang_video"></a>
				<div class="holder" id="ready_hang_video">
			    	<iframe width="640" height="480" src="http://www.youtube.com/embed/iIQ6VqFEN0o" frameborder="0" allowfullscreen></iframe>
			    </div>
			</div><!--End Left Content-->
			<div id="home_content_right"> <!--Start Right Content-->
				<a href="index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=56&virtuemart_category_id=26" class="actions">
					<div class="title" id="customize">
						<span></span>
					</div>
					<div class="kb_details">
						<?php
							$article =& JTable::getInstance("content");
							$article->load(94);
							echo $article->get("introtext");						
						?>
					</div>
				</a>
				<a href="###" class="video_cta modal" id="video_customize" rel="customize_video"></a>
				<div class="holder" id="customize_video">
					<iframe width="640" height="360" src="http://www.youtube.com/embed/BNagG6Wm9W0" frameborder="0" allowfullscreen></iframe>
				</div>
			</div> <!--End Right Content-->
			<?php } ?>
			<div class="clear"></div>

		</div> <!--End Container-->
	</div> <!--End Wrapper-->
	<div id="footer"> <!--Start Footer-->
		<div class="content">
			<div class="f_col">
				<!--<h4>Get Help</h4>-->
				<jdoc:include type="modules" name="KBFooterCol1" />
			</div>
			<div class="f_col">
				<h4>About KB Murals</h4>
				<jdoc:include type="modules" name="KBFooterCol2" />	
			</div>
			<div class="f_col">
				<h4>Policies</h4>
				<jdoc:include type="modules" name="KBFooterCol3" />
			</div>
			<div class="f_col">
				<h4>Resources</h4>
				<jdoc:include type="modules" name="KBFooterCol4" />
			</div>
			<div id="share">
				share icons here
			</div>
			<div id="gift_card">
				<a href="###">Mural Gift Card</a>
			</div>
			<div class="clear"></div>
			<div id="copyright">
				&copy;<?php echo date("Y",time()); ?> KB Murals. All Rights Reserved.
			</div>
		</div>
	</div> <!--End Footer-->
</body>
</html>