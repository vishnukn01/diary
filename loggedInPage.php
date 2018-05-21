<?php
include('header.php');
session_start();
if(array_key_exists('id', $_SESSION)){
	include('header.php');
	if(array_key_exists('id',$_COOKIE)){
		$_SESSION['id'] = $_COOKIE['id'];
	}	
}else{
	header('Location: index.php');
}
?>

<div class='container' id='textarea_container'>

	<span class='headings'>WELCOME</span><br>
	<p><a href="index.php?loggedout=1" class='btn btn-primary'>LOG OUT</a></p>
	<textarea rows='22' id='diary'></textarea>

</div>

<?php
include('footer.php');
?>