<?php

include('connection.php');

$res = $link->query("CREATE TABLE IF NOT EXISTS `users` (

  `id` int(11) NOT NULL auto_increment,   
  `email` text NOT NULL,       
  `password` varchar(250)  NOT NULL,     
  `diary` text NOT NULL,     
   PRIMARY KEY  (`id`)

)");

if(!$res){
	echo 'Failed to create table';
}else{
	echo 'Tables set up';
}

?>