    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
	<script >
	
		$('.toggleForms').click(function(){
			
			$('#logInForm').toggle();
			$('#signUpForm').toggle();
			//$('#errorsBox').css('display','none');
			
		});
		
		$("#diary").on('change keyup paste', function() {
			alert('asdf');
		});
	
	</script>
  </body>
</html>