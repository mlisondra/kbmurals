<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<?php 
$menu = & JSite::getMenu();
$_SESSION['user']['authenticated'] = false;
$user =& JFactory::getUser();
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
		
		<link rel="stylesheet" href="/media/plg_fancybox/css/jquery.fancybox-1.3.4.css" type="text/css" />
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/jquery.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/css_browser_selector.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/scripts.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.breadcrumbs img').replaceWith("<i></i>");
		});
	</script>		
	</head>
<body>
	<div id="wrapper" style="padding-bottom:10px;"> <!--Start Wrapper-->
		<div class="content"> <!--Start Container-->
			<div id="navigation"> <!--Start Navigation-->
				<div id="cta_bar"> <!--Start CTA Bar-->
					<div id="cart_price">$358.79</div>
					<div id="cart_count">4</div>
					<div id="sub_nav">
						<?php if($user->id != 0) { ?>
							<a href="index.php?option=com_virtuemart&view=user&layout=edit">My Account</a> | <a href="###">Help</a> | <a href="###">Cart</a>
						<?php }else{ ?>
							<a href="/index.php?option=com_virtuemart&view=user&layout=edit&loginonly=1">Login</a> | <a href="/index.php?option=com_virtuemart&view=user&layout=edit&regonly=1">Register</a> | <a href="###">Help</a> | <a href="###">Cart</a>
						<?php } ?>
					</div>
					<div id="social">
						<a href="https://twitter.com/kbmurals" id="icon_twitter" target="_blank">Twitter</a>
						<a href="http://pinterest.com/kbmurals/" id="icon_pinterest" target="_blank">Pinterest</a>
						<a href="http://www.facebook.com/pages/KB-Murals/219778541474317?ref=stream" id="icon_facebook" target="_blank">Facebook</a>
					</div>
				</div> <!--End CTA Bar-->
				<a href="/" id="logo">KB Murals</a>
				<jdoc:include type="modules" name="KBTopNav" />
				<div class="clear"></div>
			</div> <!--End Navigation-->


			<?php if ($menu->getActive() == $menu->getDefault()) { ?>
			<div id="home_header"> <!--Start Header-->
				<img src="<?php echo $this->baseurl ?>/templates/kbmurals/images/header_img_1.jpg" />
			</div> <!--End Header-->
			<?php } ?>
			<jdoc:include type="modules" name="KBBreadcrumb" />
			<br/>
			<jdoc:include type="component" />
			<jdoc:include type="modules" name="KBContactForm" />
			<jdoc:include type="modules" name="KBShoppingCart" />
		
		
			<?php if ($menu->getActive() == $menu->getDefault()) { ?>
			<div id="home_content_left"> <!--Start Left Content-->
				<a href="/index.php?option=com_virtuemart&view=categories&virtuemart_category_id=6" class="actions">
					<div class="title" id="ready_hang">
						<span></span>
					</div>
					<div class="details">
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
				<a href="###" class="actions">
					<div class="title" id="customize">
						<span></span>
					</div>
					<div class="details">
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
			<!--<div class="f_col">
				<h4>Our Other Products</h4>
				<jdoc:include type="modules" name="KBFooterCol5" />
			</div>-->
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
<script src="<?php echo $this->baseurl ?>/templates/kbmurals/js/jquery.validate.min.js"></script>
</html>