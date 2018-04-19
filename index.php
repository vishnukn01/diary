<?php
session_start();

if(isset($_GET['loggedout'])){
	session_destroy();
	setcookie('id','', time()-60*60);
	$_COOKIE['id'] = '';
}

if(array_key_exists('id', $_SESSION)){
	header('Location: loggedInPage.php');
}

if(isset($_POST['submit'])){

	require('connection.php');
	$errors = '';
	
	if($_POST['email'] == ''){
		$errors .= 'An email address is required<br>';
	}
	
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
		$errors .= "The email address is not valid<br>";
	}
	
	if($_POST['password'] == ''){
		$errors .= 'A password is required<br>';
	}
	if($errors != ''){	
		$errors = '<p>There were the following error(s) in your form</p>'. $errors;
	}else{
	
		if($_POST['signingUp'] == 1){
		
			//check if the email has already been registered
			$email = mysqli_real_escape_string($link, $_POST['email']);
			$password = mysqli_real_escape_string($link, $_POST['password']);
			
			$q = "
					SELECT * FROM users
					WHERE email = '$email'
				 ";
			$result = $link->query($q);
			if($result->num_rows != 0){
				$errors = 'That email has already been registered';
			}else{
				// proceed with registeration
				$query = "
						INSERT INTO users (email, password)
						VALUES ('$email' , '$password')
					 ";
				$result = $link->query($query);
				if($result){
				
					$insertId = $link->insert_id;
					$pwd = md5( md5($insertId).$_POST['password']);
					$query = "
								UPDATE users
								SET password = '$pwd'
								WHERE id = $insertId
								LIMIT 1
							 ";
					$result = $link->query($query);
					if($result){
						$_SESSION['id'] = $link->insert_id;
						if($_POST['stayLoggedIn']){
							setcookie('id', $link->insert_id , time() + (86400 * 30));
						}
						header('Location: loggedInPage.php');
					}
					
				}else{
					$errors = 'Failed to register. Please try again.'; 
				}		
			}
		}else{
		
			// log in
			// check if email is registerd
			$email = mysqli_real_escape_string($link, $_POST['email']);
			$pass = mysqli_real_escape_string($link, $_POST['password']);
			$query = "SELECT * FROM users
					  WHERE email = '$email'
					";
			$result = $link->query($query);
			if($result->num_rows > 0){
				//proceed to log in
				$row = $result->fetch_assoc();
				$insertId = $row['id'];
				if($row['password'] == md5( md5($insertId). $pass )){
					
					if(array_key_exists('id',$_COOKIE)){
						setcookie('id','',time() + (86400 * 30));
					}
					$_SESSION['id'] = $row['id'];
					header('Location: loggedInPage.php');
					
				}else{
					$errors .='Email and password do not match!';
				}	
			}else{
				$errors = 'That email has not been registered!';
			}
		}	
	}
}

include('header.php');
?>
  
  <div class='container'id='forms_container'>
	<h1 class='headings'>Secret Diary</h1>
	<h6 class='headings'>Store your thoughts permanently and securely.</h6>
	<div id='errorsBox'>
	<?php
	if(!empty($errors)){
	
		echo "<div class=\"alert alert-danger\">
				".$errors."
			  </div>";
	
	}
	?>
	</div>
	<form id='signUpForm' action='' method='post'>
	
		  <h5 class='headings'>Interested? Sign up now</h5>
		  <div class="form-group">
			<input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email">
		  </div>
		  <div class="form-group">
			<input type="password" class="form-control" id="password"  name='password' placeholder="Password">
		  </div>
		  <div class="form-check">
			<input type="checkbox" class="form-check-input" id="stayLoggedIn" name='stayLoggedIn' value='1'>
			<label class="form-check-label headings" for="stayLoggedIn" >Stay logged in</label>
			<input type='hidden' name='signingUp' value='1'>
		  </div>
		  <button type="submit" class="btn btn-primary" name='submit'>Sign up</button>
			<p><a href='#' class='toggleForms'>Log in</a></p>
		
	</form>
	
	<form id='logInForm' action='' method='post'>
	
		  <h5 class='headings'>Have an account? Log in</h5>
		  <div class="form-group">
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter registered email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>">
		  </div>
		  <div class="form-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="Password">
		  </div>
		  <div class="form-check">
			<input type="checkbox" class="form-check-input" id="stayLoggedIn" name='stayLoggedIn' value='1'>
			<label class="form-check-label headings" for="stayLoggedIn">Stay logged in</label>
			<input type='hidden' name='signingUp' value='0'>
		  </div>
		  <button type="submit" class="btn btn-primary" name='submit'>Log in</button>
		  <p><a href='#' class='toggleForms'>Sign up</a></p>
	  
	</form>
  
  </div>

<?php
include('footer.php');
?>   