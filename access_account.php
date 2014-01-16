<!DOCTYPE html><?php phpinfo(); ?>
<html>
	<head>
		<title>KB Murals :: Ready To Hang</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="description" name="description" content="">
		<meta http-equiv="keywords" name="keywords" content="">
		<meta name="robots" content="index,follow">
		<meta name="revisit-after" content="10 days">
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../templates/kb/css/styles.css" />
		<link href='http://fonts.googleapis.com/css?family=Economica:400,700|Oswald:400,700,300' rel='stylesheet' type='text/css'>
		<link href='../css/pepper-grinder/jquery-ui-1.8.23.custom.css' rel='stylesheet' type='text/css'>
		<style>
			label.custom {display:block;width:150px;margin-top:10px;}
			label.error {color:red;font-weight:bold;}
		</style>
		<script src="js/jquery.js"></script>
		<script src="js/css_browser_selector.js"></script>
		<script src="js/scripts.js"></script>
		<script src="../js/jqueryui_custom.min.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		
		<script>
			var post_data = "";
			
			$(document).ready(function(){
				$("form#login_form").validate({
					rules: {
						email : "required",
						password : "required"
					},
					messages : {
						email : "Enter Email Address",
						password : "Enter Password"
					},
					submitHandler : login
				});
				
				$("form#registration_form").validate({
					rules: {
						first_name : "required",
						last_name : "required",
						email : {
							required : true,
							email : true
						},
						confirm_email : {
							required : true,
							equalTo : "#registration_form #email"
						},
						password : "required",
						confirm_password : {
							required : true,
							equalTo : "#registration_form #password"
						}
						
					},
					messages : {
						first_name : "Enter First Name",
						last_name : "Enter Last Name",
						email : {
							required : "Enter Email",
							email : "Enter Valid Email Format"
						},
						confirm_email : {
							required : "This field is required",
							equalTo : "Re-enter Email"						
						},
						password : "Enter Password",
						confirm_password : {
							required : "This field is required",
							equalTo : "Re-enter Password"
						}
					},
					submitHandler : register
				});				
				
			}); //End doc ready
			
			function login(){
				post_data = $("#login_form").serialize();
				$.post("../controllers/accounts.controller.php", post_data,
					function(data){
						if(data.status == "success"){
							window.location.href = "shipping.php";
						}else{
						
						}
					},"json"
				);
			}
			
			function register(){
				post_data = $("#registration_form").serialize();
				$.post("../controllers/orders.controller.php", post_data,
					function(data){
						if(data.status == "success"){
							window.location.href = "access_account.php";
						}else{
						
						}
					},"json"
				);
			}			
		</script>		
	</head>
<body>
	<div id="wrapper"> <!--Start Wrapper-->
		<div id="container"> <!--Start Container-->
			<div id="cta_bar"> <!--Start CTA Bar-->
				<div id="cart_count">
					4
				</div>
				<!--<div id="search">
					search
				</div>-->
				<div id="sub_nav">
					<a href="###">Login</a> | <a href="###">Register</a> | <a href="###">Help</a>
				</div>
				<div id="promo">
					Up to 15% off Selected Ready to Hang Murals. Ends 8/6. Use code: <strong>KBMSALE</strong>
				</div>
			</div> <!--End CTA Bar-->
			<div id="box"> <!--Start Box-->
			<div id="top_cap"></div>
				<div id="navigation"> <!--Start Navigation-->
					<div id="logo_wrap">
						<a href="###" id="logo">KB Murals</a>
						<span>Custom tile murals for yovur kitchen, bath and more...</span>
					</div>
					<div id="social">
						<a href="###" id="icon_twitter">Twitter</a>
						<a href="###" id="icon_pinterest">Pinterest</a>
						<a href="###" id="icon_facebook">Facebook</a>
					</div>
					<ul id="nav">
						<li><a href="###">SALE</a></li>
						<li><a href="###">IDEA BOOK</a></li>
						<li><a href="###">OUR PROCESS</a></li>
						<li><a href="###">ABOUT US</a></li>
					</ul>
					<div class="clear"></div>
				</div> <!--End Navigation-->
				<div id="home_header" style="height:150px;display:none;"> <!--Start Header-->
					<img src="http://placehold.it/960x150" />
				</div> <!--End Header-->
				<div id="breadcrumb" style="margin:10px 0px 30px 25px;"><a href="">Home</a> : <a href="">Ready To Hang</a> : <a href="">Choose A Theme</a> : Preview Mural</div>
				<div id="home_content_left"> <!--Start Left Content-->
					<div id="image_preview" style="margin: 0px 0px 5px 25px;padding:0px;">
					<h2>Loging to your KB Murals Account</h2>
						<form name="login_form" id="login_form">
							<label for="email" class="custom">Email Address</label>
							<input type="text" name="email" id="email">
							<br/>
							<label for="password" class="custom">Password</label>
							<input type="password" name="password" id="password">
							<br/><br/>
							<input type="hidden"  name="action" value="auth">
							<input type="submit" value="Login" style="margin-left:60px;">
						</form>
					</div>
				
				</div> <!--End Left Content-->
				<div id="home_content_right"> <!--Start Right Content-->
					<div id="product_info" style="margin: 0px 0px 0px 5px;">
						<h2>Register for a KB Murals Account</h2>
						
						<form name="registration_form" id="registration_form">
							<label for="mural_size" class="custom">First Name</label>
							<input type="text" name="first_name" id="first_name">
							<br/>
							<label for="last_name" class="custom">Last Name</label>
							<input type="text" name="last_name" id="last_name">	
							<br/>
							<label for="email" class="custom">Email Address</label>
							<input type="text" name="email" id="email">
							<br/>

							<label for="confirm_email" class="custom">Confirm Email Address</label>
							<input type="text" name="confirm_email" id="confirm_email">
							<br/>
							
							<label for="password" class="custom">Password</label>
							<input type="password" name="password" id="password">
							<br/>
							<label for="confirm_password" class="custom">Confirm Password</label>
							<input type="password" name="confirm_password" id="confirm_password">
							<br/>
							<br/>
							<input type="checkbox" name="newsletter" id="newsletter" style="float:left;"><label for="newsletter" style="float:left;margin-top:2px;">Yes, subscribe me to...</label>
							<br/><br/>
							<input type="hidden"  name="action" value="register">
							<input type="submit" value="Register" style="margin-left:60px;">
						</form>
					</div>
				</div> <!--End Right Content-->
				<div class="clear"></div>
				

			<div id="bottom_cap"></div>
			</div> <!--End Box-->
			<?php readfile("footer.html"); ?>
		</div> <!--End Container-->
	</div> <!--End Wrapper-->
	
	<div id="thumbnail_detail"></div>
</body>
</html>