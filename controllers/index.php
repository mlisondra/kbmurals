<?php

$action = $_REQUEST['action'];
$status = "success";
switch($action){
	case "get_thumbnails":
		extract($_REQUEST);
		switch($theme){
			case "nature":
				$content = trim(file_get_contents("../templates/thumbnails_nature.html"));
				break;
			case "sports":
				$content = trim(file_get_contents("../templates/thumbnails_sports.html"));
				break;				
		}
		
		break;
}
$response = array("content"=>$content,"status"=>$status);
print json_encode($response);