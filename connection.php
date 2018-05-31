<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'diary';


$link = new mysqli($host, $user, $pass, $db_name);
if($link->connect_errno){
	
	die('Connection error: '. $link->connect_error);
}



?>