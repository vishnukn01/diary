<?php
session_start();
	if(array_key_exists('value', $_POST)){

		include('connection.php');
		$value = $link->real_escape_string($_POST['value']);
		$id = $_SESSION['id'];
		
		$q = "UPDATE users SET diary='$value' WHERE id=$id";
		if($link->query("UPDATE users SET diary='$value' WHERE id=$id")){
			//echo 'Done. The query :'.$q;
		}else{
			//secho 'Not done. The query : '.$q;
		}
		
	}

?>