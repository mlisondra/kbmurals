 <?php

$action = $_REQUEST['action'];
$response = "";
$content = ""; 
$price = 0;
extract($_POST);
switch($action){
	case "save_order_attributes";
		$status = "success";
		break;
	case "get_estimate_price":
		$status = "success";
		//extract($_POST);
		$price = $product_price;
		switch($mural_size){
			case "3_3":
				$price = 50; 
				break;
			case "4_4":
				$price = 60;
				break;
			case "5_5":
				$price = 70;
				break;
			case "7_7":
				$price = 85;
				break;				
		}
		
		switch($tile_type){
			case "Ceramic":
				$price += 10;
				break;
			case "Marble":
				$price += 20;
				break;
		}
		
		switch($tile_size){
			case "4.25":
				$price += 10;
				break;
			case "6.00":
				$price += 20;
				break;
		}

		$quantity = $quantity[0]; //VIRTUEMART sets the quantity within an array for use by the cart page
		
		//TODO: Add the product to session so that the actual prices, size, etc. can be made available to the cart
		//Can I just add it to the VMCart session variables?
		
		$kbcart = array("product_id"=>array(
					"quantity"=>$quantity,
					"mural_size" => $mural_size,
					"tile_size" => $tile_size,
					"tile_material" => $tile_material,
					"frame_style" => $frame_style 
				)
				);
define( '_JEXEC', 1 );
define('JPATH_BASE', '../' );//this is when we are in the root
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
//require_once ('../includes/defines.php' );
//require_once ('../includes/framework.php' );

$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

		
		$session_handler = JFactory::getSession();
		$session_handler->set('kbcart',$kbcart);
		
		$content = "<i>$</i>" . number_format($quantity * $price,0) . '.<i>00</i>';
		break;
}

$response = array("status"=>$status,"content"=>$content);
print json_encode($response);