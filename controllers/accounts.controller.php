 <?php
include('../config/config.php');
include('../config/db.php');

function __autoload($class){
	include '../classes/' .$class . '.class.php';
}

$accounts_obj = new Accounts();

$action = $_REQUEST['action'];
$response = "";
$status = "";

extract($_POST);
switch($action){
	case "register";
		$status = "success";
		break;
	case "auth":
		$accounts_obj->auth($_POST);
		$status = "success";
		break;
}

$response = array("status"=>$status);
print json_encode($response);