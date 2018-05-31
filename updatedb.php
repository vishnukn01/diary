<?php
session_start();
	if(array_key_exists('value', $_POST)){

		include('connection.php');
		$value = $_POST['value'];
		$id = $_SESSION['id'];
		$q = "UPDATE `users` 
			  SET `diary`='$value'
			  WHERE id=$id
			  ";

		$result = $link->query($q);
		
	}
?>