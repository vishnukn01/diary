<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'diary';


$link = new mysqli($host, $user, $pass, $db_name);
if($link->connect_errno){
	
	die('Connection error: '. $link->connect_error);
}


$res = $link->query("CREATE TABLE IF NOT EXISTS `users` (

  `id` int(11) NOT NULL auto_increment,   
  `email` text NOT NULL,       
  `password` varchar(250)  NOT NULL,     
  `diary` text NOT NULL,     
   PRIMARY KEY  (`id`)

)");

if(!$res){
	//echo 'Failed to create table';
}else{
	//echo 'Tables set up';
}
?>