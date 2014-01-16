<?php
$host_name = $_SERVER['HTTP_HOST'];
if($host_name == "localhost"){
	$DBserverName = "localhost";
	$DBusername = "root";
	$DBpassword =  "";
	$dbToUse = "roundtable";
}else{
	$DBserverName = "mysql55a.ayera.com";
	$DBusername = "i_mldl699485";
	$DBpassword =  "025zeus";
	$dbToUse = "MLDL699485";
}

$sqli = new mysqli($DBserverName, $DBusername, $DBpassword, $dbToUse);
