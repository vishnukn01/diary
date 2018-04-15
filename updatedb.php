<?php
session_start();
if(!empty($_POST['content'])){
	include('connection.php');
	$content = mysqli_real_escape_string($link, $_POST['content']);
	$q = "
		 UPDATE users
		 SET diary = '$content'	
		 WHERE id = $_SESSION['id']
		 ";
	$result = $link->query($q);
	if($result){
		echo 'Done';
	}	
}
?>