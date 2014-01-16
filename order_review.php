<!DOCTYPE html>
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
		<style>
			label.custom {display:block;width:100px;margin-top:10px;float:left;}
			label.error {color:red;font-weight:bold;}
			input[type="text"] {width:250px;}
			select {width:250px;}
			#shipping_address, #payment_information, #gift_message_container {margin: 20px 0px 5px 25px;padding:0px;}
		</style>
		<script src="../templates/kb/js/jquery.js"></script>
		<script src="../templates/kb/js/css_browser_selector.js"></script>
		<script src="../templates/kb/js/scripts.js"></script>
		<script src="../templates/kb/js/jqueryui_custom.min.js"></script>
		<script src="../templates/kb/js/jquery.validate.min.js"></script>
		
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
				
			}); //End doc ready
			
			function login(){
				post_data = $("#login_form").serialize();
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
				<div id="home_content_left" style="width:800px;"> <!--Start Left Content-->
					<div style="margin: 0px 0px 5px 25px;padding:0px;">
					<h3>Choose Shipping Option</h3>
						Enter Zipcode:<br/>
						<input type="text" name="ship_postal_code" id="ship_postal_code">&nbsp;<input type="button" value="Get Rates"><br/><br/>
						<input type="radio" name="ship_option"> UPS Ground (4 - 5 business days) : $30.00<br/>
						<input type="radio" name="ship_option"> UPS 2-Business Day Shipping : $50.00<br/>
						<input type="radio" name="ship_option"> UPS Overnight Shipping : $100.00<br/>
					</div>
					<div class="clear"></div>
					
					<div id="shipping_address">
						<h3>Shipping Information</h3>
						<label for="ship_first_name" class="custom">First Name</label><input type="text" name="ship_first_name" id="ship_first_name"><br/>
						<label for="ship_last_name" class="custom">Last Name</label><input type="text" name="ship_last_name" id="ship_last_name"><br/>
						<label for="ship_address1" class="custom">Address</label><input type="text" name="ship_address1" id="ship_address1"><br/>
						<label for="ship_address2" class="custom">Address 2</label><input type="text" name="ship_address2" id="ship_address2"><br/>
						<label for="ship_city" class="custom">City</label><input type="text" name="city" id="city"><br/>
						<label for="ship_state" class="custom">State</label>
						<select name="state" id="state">
							<option value="">-- Select State --</option>
							<option value="CA">-- California --</option>
						</select><br/>
						<label for="zip" class="custom">Zipcode</label>
						<input type="text" name="zip" id="zip"><br/>
						<label for="phone" class="custom">Phone Number</label>
						<input type="text" name="phone" id="phone"><br/>
					</div>
					
					<div class="clear:both;"></div>
					
					<div id="payment_information" style="float:left;">
					<h3>Payment Information</h3>
						<label for="billing_first_name" class="custom">First Name</label>
						<input type="text" name="billing_first_name" id="billing_first_name"><br/>
						
						<label for="billing_last_name" class="custom">Last Name</label>
						<input type="text" name="billing_last_name" id="billing_last_name"><br/>
						
						<label for="cc_type" class="custom">Credit Card Type</label>
						<input type="text" name="cc_type" id="cc_type"><br/>
						
						<label for="cc_number" class="custom">Card Number</label>
						<input type="text" name="cc_number" id="cc_number"><br/>

						<label for="cc_expire_month" class="custom">Card Expiration</label>
						
						<select name="cc_expire_month" id="cc_expire_month" style="width:100px;">
							<option value="January">January</option>
						</select> 
						<select name="cc_expire_year" id="cc_expire_year" style="width:100px;">
							<option value="2012">2012</option>
						</select>
						
						<br/><br/>
						
						<h3>Billling Address</h3>
						<input type="checkbox" name="same_as_shipping" id="same_as_shipping">&nbsp; Same as Shipping Address<br/><br/>
						
						<label for="billing_first_name" class="custom">First Name</label><input type="text" name="billing_first_name" id="billing_first_name"><br/>
						<label for="ship_last_name" class="custom">Last Name</label><input type="text" name="ship_last_name" id="ship_last_name"><br/>
						<label for="ship_address1" class="custom">Address</label><input type="text" name="ship_address1" id="ship_address1"><br/>
						<label for="ship_address2" class="custom">Address 2</label><input type="text" name="ship_address2" id="ship_address2"><br/>
						<label for="ship_city" class="custom">City</label><input type="text" name="city" id="city"><br/>
						<label for="ship_state" class="custom">State</label>
						<select name="state" id="state">
							<option value="">-- Select State --</option>
							<option value="CA">-- California --</option>
						</select><br/>
						<label for="zip" class="custom">Zipcode</label>
						<input type="text" name="zip" id="zip"><br/>
						<label for="phone" class="custom">Phone Number</label>
						<input type="text" name="phone" id="phone"><br/>						
						
					</div>
					
					<div style="float:left;margin:20px 0px 5px 25px;">
						<h3>Gift Card</h3>
						<label for="billing_first_name" class="custom">First Name</label><input type="text" name="billing_first_name" id="billing_first_name"><br/>	
					</div>
					
					<div style="clear:both;"></div>
					<div id="gift_message_container">
						<h3>Gift Message (optional)</h3>
						<textarea name="gift_message" id="gift_message" style="width:325px;height:115px;"></textarea><br/><br/>
						<input type="submit" value="Continue" style="margin-left:25px;">
					</div>
					
					
				</div> <!--End Left Content-->
				
				<div class="clear"></div>
				

			<div id="bottom_cap"></div>
			</div> <!--End Box-->
			<?php readfile("footer.html"); ?>
		</div> <!--End Container-->
	</div> <!--End Wrapper-->
	
	<div id="thumbnail_detail"></div>
</body>
</html>