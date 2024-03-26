<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
	
  		<meta charset="UTF-8">
  		<meta name="author" content="Joydeep Dev Nath">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	
		<?php $titleNameT = 'Contact Us'; include("common/title.php"); ?>
    
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="public/libs/toastr/toastr.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/main.js"></script>
    	<script src="js/bootstrap.min.js"></script>
		<script src="public/libs/toastr/toastr.js"></script>
    	<script>
			$(document).ready(function() {
				$('#contactAction').submit(function(event) {
					// Prevent the form from submitting normally
					event.preventDefault(); // Prevent default form submission
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#name'))) {
						showToastr("Enter Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#email'))) {
						showToastr("Enter Email!", "error");
						isError = true;
					} else if (!ValidateControl($('#mobile'))) {
						showToastr("Enter Mobile!", "error");
						isError = true;
					} else if (!ValidateControl($('#subject'))) {
						showToastr("Enter Subject!", "error");
						isError = true;
					} else if (!ValidateControl($('#queries'))) {
						showToastr("Enter Queries!", "error");
						isError = true;
					}
					if (!isError) {
						var form = event.target; // Get the form element from the event
						form.submit(); // Submit the form
					}
				});
			});
		</script>
	</head>
	
	<!-- HEAD TAG ENDS -->
	
	<!-- BODY TAG STARTS -->
	
	<body>
		
		<?php 
		
			if(!isset($_SESSION["username"])) {
				include("common/headerLoggedOut.php");
			}
			else {
				include("common/headerLoggedIn.php");
			}
		
		?>
		
		<div class="spacer">a</div>
		
		<div class="col-sm-12 contactUsWrapper">
			
			<div class="headingOne">
				
				Contact Us
				
			</div>
			
			<!-- uncomment this if required

			<div class="para">
				
				Lorem ipsum dolr sit amet
				
			</div>
	
			-->
			
		</div> <!-- paymentWrapper -->
		
		<div class="col-xs-12 contactPadding">
			
		<div class="col-sm-1"></div>
		
		<div class="col-sm-5 contactUsExtras">
			
			<div class="col-sm-12 heading">
				
				<span class="bold">We're located at:</span>
				</br>
				3rd floor, Basai Enclave, Sector 10, Gurugram-122006, Haryana
			
			</div>
		
			<div class="col-sm-12 mapImage">
				
				<img src="images/map/map.jpg" alt="map" class="mapDim"/>
				
			</div>
			
		</div>
		
		<div class="col-sm-5 contactUsForm">
			
			<!-- <form id="contactForm"> -->
			<form action="contactAction.php" method="POST" id="contactAction">
				
			<label for="name">Full Name:</label>
			<input type="text" class="input" name="name" id="name"/>
			
			<label for="email">E-mail:</label>
			<input type="text" class="input" name="email" id="email"/>

			<label for="mobile">Mobile Number:</label>
			<input type="text" class="input" name="mobile" id="mobile"/>

			<label for="subject">Subject:</label>
			<input type="text" class="input" name="subject" id="subject"/>
			
			<label for="queries">Queries:</label>
			<textarea class="input" name="queries" id="queries"></textarea>
			
			<div class="text-center">
				<input type="submit" class="contactButton" value="Send"/>
			</div>
				
			</form>
			
		</div>
		
		<div class="col-sm-1"></div>
		
		</div>
	
	<div class="col-xs-12 spacer">.</div> <!-- just a dummy class for creating some space -->
	<div class="col-xs-12 spacer">.</div> <!-- just a dummy class for creating some space -->
			
		<?php include("common/footer.php"); ?>
				
	</body>
	
	<!-- BODY TAG ENDS -->
	
</html>