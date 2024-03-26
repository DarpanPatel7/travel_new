<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
	
  		<meta charset="UTF-8">
  		<meta name="author" content="Joydeep Dev Nath">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	
		<?php $titleNameT = 'Forgot Password'; include("common/title.php"); ?>
    
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/bootstrap-select.css" rel="stylesheet">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
		<link href="public/libs/toastr/toastr.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/main.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/bootstrap-select.js"></script>
    	<script src="js/bootstrap-dropdown.js"></script>
    	<script src="js/jquery-2.1.1.min.js"></script>
    	<script src="js/moment-with-locales.js"></script>
    	<script src="js/bootstrap-datetimepicker.js"></script>
		<script src="public/libs/toastr/toastr.js"></script>
		<script>
			$(document).ready(function() {
				$('#resetLinkSent').submit(function(event) {
					// Prevent the form from submitting normally
					event.preventDefault(); // Prevent default form submission
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#email'))) {
						showToastr("Enter Email!", "error");
						isError = true;
					}
					if (!isError) {
						var formData = $(this).serialize();
						showToastr("please wait while sending mail!", "info");
						$('#reset_password').prop("disabled", true);
						$.ajax({
							type: "POST",
							url: "send_email_reset_password.php", // PHP file to handle email sending logic
							data: $(this).serialize(), // Serialize form data
							success: function(response) {
								// Handle success response
								var result = $.parseJSON(response);
								if (result.success === false) {
									showToastr(result.message, "error");
								} else {
									showToastr("reset mail succesfully send to above provided E-mail!", "success");
								}
							},
							error: function(xhr, status, error) {
								// Handle error
								console.error(xhr.responseText); // Log error message
								showToastr("Something went wrong while sending mail!", "error");
							}
						});
						$('#reset_password').prop("disabled", false);
					}
				});
			});
		</script>
	</head>
	
	<!-- HEAD TAG ENDS -->
	
	<!-- BODY TAG STARTS -->
	
	<body>
	
		<div class="container-fluid">
		
		<div class="forgotPassword">
				
			<div class="col-sm-12">
					
				<div class="heading text-center">
					Forgot Password
				</div>
						
			</div>
			
			<div class="col-sm-6 col-sm-offset-3">
				
				<div class="containerBox" style="min-height: 16em !important;">
				
				<form action="resetLinkSent.php" method="POST" id="resetLinkSent">
					
					<label for="email">Enter the email ID associated with your account:</label>
					<input type="email" class="input" name="email" id="email" placeholder="Enter email here">
					
					<div class="col-sm-12 text-center">
					<input type="submit" class="button" name="login" value="Reset password" id="reset_password">
					</div>
					<a href="login.php"><p class="col-xs-12 dots" style="color: white; font-size: 1.1em; margin-top: 1em; text-align: center;">Login?</p></a>
					
				</form>
				
				</div>
				
			</div>
			
		</div>
		
		</div> <!-- container-fluid -->
		
	</body>
	

	<!-- BODY TAG ENDS -->
	
</html>
	