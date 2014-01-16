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
		<link href='../css/pepper-grinder/jquery-ui-1.8.23.custom.css' rel='stylesheet' type='text/css'>
		<style>
			label.custom {display:block;width:100px;margin-top:10px;}
			label.error {color:red;font-weight:bold;}
			select {width:150px;}
		</style>
		<script src="js/jquery.js"></script>
		<script src="js/css_browser_selector.js"></script>
		<script src="js/scripts.js"></script>
		<script src="../js/jqueryui_custom.min.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		
		<script>
			var post_data = "";
			
			$(document).ready(function(){
				$("form#mural_attributes_form").validate({
					rules: {
						mural_size : "required",
						tile_type : "required",
						tile_size : "required",
						tile_finish : "required",
						frame : "required",
						quantity: {
							required : true,
							number : true
						}
					},
					messages : {
						mural_size : "Select Mural Size",
						tile_type : "Select Tile Type",
						tile_size : "Select Tile Size",
						tile_finish : "Select Tile Finish",
						frame : "Frame Type",
						quantity : {
							required : "Enter Quantity",
							number : "Only numbers allowed"
						}
					},
					submitHandler : continue_checkout
				});
				
				$("#mural_size, #tile_type, #tile_size, #tile_finish, #frame, #quantity").change(function(){
					if($("#mural_attributes_form").valid()){
						get_estimate();
					}
				});
				
				$("#get_estimate").change(function(){
					if($("#mural_attributes_form").valid()){
						get_estimate();
					}
				});
				
			}); //End doc ready
			
			function continue_checkout(){
				post_data = $("#mural_attributes_form").serialize();
				$.post("../controllers/orders.controller.php", post_data,
					function(data){
						if(data.status == "success"){
							window.location.href = "access_account.php";
						}else{
						
						}
					},"json"
				);
			}
			
			function get_estimate(){
				var post_data = $("#mural_attributes_form").serialize() + "&action=get_estimate_price";
				$.post("../controllers/orders.controller.php",post_data,
					function(data){
						if(data.status == "success"){
							$("#amount").html(data.content);
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
				<div id="home_header" style="height:150px;"> <!--Start Header-->
					<img src="http://placehold.it/960x150" />
				</div> <!--End Header-->
				<div id="breadcrumb" style="margin:10px 0px 30px 25px;"><a href="">Home</a> : <a href="">Ready To Hang</a> : <a href="">Choose A Theme</a> : Preview Mural</div>
				<div id="home_content_left"> <!--Start Left Content-->
					<div id="image_preview" style="margin: 0px 0px 5px 25px;padding:0px;">
						<img src="http://lorempixel.com/400/265/nature/<?php echo $_GET['image_id']; ?>/" />
					</div>
					<div id="product_help" style="margin: 0px 0px 5px 25px;padding:0px;">
						Product Information here
					</div>					
				</div> <!--End Left Content-->
				<div id="home_content_right"> <!--Start Right Content-->
					<div id="product_info" style="margin: 0px 0px 0px 5px;float:left;">
						<h2>Product Title</h2>
						
						<form name="mural_attributes_form" id="mural_attributes_form">
							<label for="mural_size" class="custom">Mural Size</label>
							<select name="mural_size" id="mural_size">
								<option value="">-- Select Size --</option>
								<option value="3_3">3 x 3 square</option>
								<option value="4_4">4 x 4 square</option>
								<option value="5_5">5 x 5 square</option>
								<option value="7_7">7 x 7 square</option>
								<option value="4_3">4 x 3 rectangle</option>
								<option value="5_3">5 x 3 rectangle</option>
								<option value="6_4">6 x 4 rectangle</option>
								<option value="7_5">7 x 5 rectangle</option>
							</select>
							<br/>
							<label for="tile_type" class="custom">Material Type</label>
							<select name="tile_type" id="tile_type">
								<option value="">-- Select Type --</option>
								<option value="Ceramic">Ceramic</option>
								<option value="Marble">Marble</option>
							</select>	
							<br/>
							<label for="tile_size" class="custom">Tile Size</label>
							<select name="tile_size" id="tile_size">
								<option value="">-- Select Size --</option>
								<option value="4.25">4.25" X 4.25"</option>
								<option value="6.00">6" X 6"</option>
							</select>
							<br/>
							<label for="tile_finish" class="custom">Tile Finish</label>
							<select name="tile_finish" id="tile_finish">
								<option value="">-- Select Finish --</option>
								<option value="Gloss">Gloss</option>
								<option value="Matte">Matte</option>
							</select>
							<br/>
							<label for="frame" class="custom">Frame Color</label>
							<select name="frame" id="frame">
								<option value="">-- Select Frame --</option>
								<option value="Black">Black</option>
							</select>							
							<br/>
							<label for="quantity" class="custom">Quantity</label>
							<input type="text" name="quantity" id="quantity" size="2">
							<br/><br/>
							<input type="hidden"  name="action" value="save_order_attributes">
							<input type="button" name="get_estimate" value="Get Estimate">
							<input type="submit" value="Continue Checkout" style="margin-left:80px;">
						</form>
					</div>
					
					<div style="float:left;margin:50px 25px 0px 10px;"><strong>Estimated Price</strong><br/><br/><span id="amount">$0.00</span></div>
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