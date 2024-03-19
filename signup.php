<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="author" content="Joydeep Dev Nath">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/favicon.ico">

	<?php $titleNameT = 'Sign Up';
	include("common/title.php"); ?>

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
	<!-- script-for sticky-nav -->
	<script>
		$(document).ready(function() {
			$('#signupAction').submit(function(event) {
				var isOtpSend = $('#isOtpSend').val();
				if (isOtpSend == 0) {
					// Prevent the form from submitting normally
					event.preventDefault(); // Prevent default form submission
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#fullname'))) {
						showToastr("Enter Full Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#email'))) {
						showToastr("Enter Email!", "error");
						isError = true;
					} else if (!ValidateControl($('#phone'))) {
						showToastr("Enter Phone Number!", "error");
						isError = true;
					} else if (!ValidateControl($('#username'))) {
						showToastr("Enter Username!", "error");
						isError = true;
					} else if (!ValidateControl($('#password'))) {
						showToastr("Enter Password!", "error");
						isError = true;
					} else if (!ValidateControl($('#addressLine1'))) {
						showToastr("Enter Address Line 1!", "error");
						isError = true;
					} else if (!ValidateControl($('#addressLine2'))) {
						showToastr("Enter Address Line 2!", "error");
						isError = true;
					} else if (!ValidateControl($('#city'))) {
						showToastr("Enter City!", "error");
						isError = true;
					} else if (!ValidateControl($('#state'))) {
						showToastr("Enter State!", "error");
						isError = true;
					}
					if (!isError) {
						// Serialize form data
						var otp = Math.floor(1000 + Math.random() * 9000);
						$('#otpHidden').val(otp);
						var formData = $(this).serialize();
						showToastr("please wait while sending mail!", "info");
						$('#signupButton').prop("disabled", true);
						$.ajax({
							type: "POST",
							url: "send_email.php", // PHP file to handle email sending logic
							data: $(this).serialize(), // Serialize form data
							success: function(response) {
								// Handle success response
								console.log(response); // Show success message
								showToastr("mail succesfully send to above provided E-mail!", "success");
								$('#otpblock').show();
								$('#isOtpSend').val('1');
							},
							error: function(xhr, status, error) {
								// Handle error
								console.error(xhr.responseText); // Log error message
								showToastr("Something went wrong while sending mail!", "error");
							}
						});
						$('#otpblock').hide();
						$('#signupButton').prop("disabled", false);
					}
				}
				if (isOtpSend == 1) {
					// Prevent the form from submitting normally
					event.preventDefault(); // Prevent default form submission
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#fullname'))) {
						showToastr("Enter Full Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#email'))) {
						showToastr("Enter Email!", "error");
						isError = true;
					} else if (!ValidateControl($('#phone'))) {
						showToastr("Enter Phone Number!", "error");
						isError = true;
					} else if (!ValidateControl($('#username'))) {
						showToastr("Enter Username!", "error");
						isError = true;
					} else if (!ValidateControl($('#password'))) {
						showToastr("Enter Password!", "error");
						isError = true;
					} else if (!ValidateControl($('#addressLine1'))) {
						showToastr("Enter Address Line 1!", "error");
						isError = true;
					} else if (!ValidateControl($('#addressLine2'))) {
						showToastr("Enter Address Line 2!", "error");
						isError = true;
					} else if (!ValidateControl($('#city'))) {
						showToastr("Enter City!", "error");
						isError = true;
					} else if (!ValidateControl($('#state'))) {
						showToastr("Enter State!", "error");
						isError = true;
					}
					if (!isError) {

						if ($('#otp').val() == $('#otpHidden').val()) {
							var form = event.target; // Get the form element from the event
							form.submit(); // Submit the form 
						} else {
							showToastr("Invalid Otp!", "error");
						}
					}
				}
			});
		});
	</script>
	<!-- /script-for sticky-nav -->
</head>

<!-- HEAD TAG ENDS -->



<!------------------------------------------------------------------------------------------------------
		
		
			  ADD CONDITION TO PREVENT USERS FROM SIGNING UP IN CASE THE CHOSEN USERNAME ALREADY EXISTS
			  					USE AJAX TO CHECK AND JQUERY TO DISPLAY AN ERROR MESSAGE
			  					
			  											OR
			  											
			  					ADD CONDITION IN SIGNUP ACTION PAGE TO CHECK FOR EXISTING
			 				  USER WITH SAME USERNAME AND DISALLOW THE USER FROM SIGNING UP.
		
		
		------------------------------------------------------------------------------------------------------->




<!-- BODY TAG STARTS -->

<body>

	<div class="container-fluid">

		<div class="signup">

			<div class="col-sm-12">

				<div class="heading text-center">
					Sign Up
				</div>

			</div>

			<div class="col-sm-6 col-sm-offset-3">

				<div class="containerBox">

					<form action="signupAction.php" method="POST" id="signupAction">
						<input type="hidden" name="otpHidden" id="otpHidden">
						<input type="hidden" name="isOtpSend" id="isOtpSend" value="0">
						<label for="name">Full Name: <span class="red-star">⋆</span></label>
						<input type="text" class="input" name="name" placeholder="Enter your full name here" id="fullname">

						<label for="email">E-mail:<span class="red-star">⋆</span></label>
						<input type="email" class="input" name="email" placeholder="Enter your email here" id="email">

						<label for="phone">Phone:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="phone" placeholder="Enter your phone no. here" id="phone">

						<label for="username">Username:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="username" placeholder="Enter a username here" id="username">

						<p id="usernameExists" style="font-size: 1.2em; color: red; font-weight: 400; margin-top: -1.75em; text-align: center; background: rgba(0,0,0,0.4); display: none;">This username already exists. Please choose a different one.</p>

						<label for="password">Password:<span class="red-star">⋆</span></label>
						<input type="password" class="input" name="password" placeholder="Enter a password here" id="password">

						<label for="repeatPassword">Repeat Password:<span class="red-star">⋆</span></label>
						<input type="password" class="input" name="repeatPassword" placeholder="Enter the same password again" id="repeatPassword">

						<label for="addressLine1">Address Line 1:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="addressLine1" placeholder="Enter your House No./ Flat No. or Apartment No." id="addressLine1">

						<label for="addressLine2">Address Line 2:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="addressLine2" placeholder="Enter the name of your Lane, Locality" id="addressLine2">

						<label for="city">City:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="city" placeholder="Enter the name of your city here" id="city">

						<label for="addressLine2">State:<span class="red-star">⋆</span></label>
						<input type="text" class="input" name="state" placeholder="Enter the name of your state here" id="state">

						<div style="display: none;" id="otpblock">
							<label for="otp">OTP:<span class="red-star">⋆</span></label>
							<input type="text" class="input" name="otp" placeholder="Enter otp here" id="otp">
						</div>

						<div class="col-sm-12 text-center">
							<input type="submit" class="button" name="signup" value="Sign Up" id="signupButton">
						</div>

					</form>

					<div class="col-sm-12 text-center">
						<div class="loginPrompt">
							Already have an account? <a href="login.php"><span class="dots">Login</span></a> instead.
						</div>
					</div>

				</div>

			</div>

		</div>

	</div> <!-- container-fluid -->

</body>


<!-- BODY TAG ENDS -->

</html>