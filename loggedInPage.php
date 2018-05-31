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

<nav class="navbar navbar-light bg-faded">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href=""><h3>Diary</h3></a>
		    </div>
		   
		    <div class="pull-xs-right">
		      <a href="index.php?loggedout=1"><button class="btn btn-success">Log out</button></a>
		    </div>
		  </div>
</nav>

<div class='container-fluid' id='textarea_container'>
 
	<?php
	include('connection.php');
	$q = "SELECT diary FROM `users` WHERE id=".mysqli_real_escape_string($link, $_SESSION['id']);
	$result = $link->query($q);
	$row = $result->fetch_array();
	$diary_content = $row['diary'];
	?>
	<textarea rows='20' cols="20" id='diary'><?php if($diary_content){echo $diary_content; } ?></textarea>

</div>

<?php
include('footer.php');
?>