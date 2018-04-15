<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'diary';


$link = new mysqli($host, $user, $pass, $db_name);
if($link->connect_errno){
	
	die('Connection error: '. $link->connect_error);
}

$q = "
		CREATE TABLE IF NOT EXISTS users
		id int NOT NULL AUTO_INCREMENT,
		email text NOT NULL,
		password text NOT NULL,
		diary longtext NOT NULL
		PRIMARY KEY (id)
	 ";
$result = $link->query($q);
if(!$result){
	//echo '<strong>Failed to create table</strong>';
}

?>