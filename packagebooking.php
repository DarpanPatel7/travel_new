<?php session_start();
if (!isset($_SESSION["username"])) {
	header("Location:blocked.php");
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
?>

<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="author" content="Joydeep Dev Nath">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/favicon.ico">

	<?php $titleNameT = 'Booking';
	include("common/title.php"); ?>

	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>

<!-- HEAD TAG ENDS -->

<!-- BODY TAG STARTS -->

<body>

	<?php include("common/headerLoggedIn.php"); ?>

	<?php

	$mode = $_POST["modeHidden"] ?? '';

	?>
	<?php include("common/config.php"); ?>

	<div class="spacer">a</div>

	<div class="bookingWrapper">

		<div class="headingOne">

			Please review and confirm your booking

		</div>

		<!-- changing contents of the page based on mode -->

		<div class="col-sm-12 bookingHotel">

			<?php
			$packageID = $_GET["packageID"] ?? '';
			$PackagePrice = $_GET["PackagePrice"] ?? 0;
			$city = $_GET["city"] ?? '';
			$passengersBus = $_GET["passengersBus"] ?? 0;
			$checkIn = $_GET["checkIn"] ?? '';

			$tbltourpackagesSQL = "SELECT * FROM `tbltourpackages` WHERE packageID='$packageID'";
			$tbltourpackagesQuery = $conn->query($tbltourpackagesSQL);
			$row = $tbltourpackagesQuery->fetch(PDO::FETCH_ASSOC);

			?>

			<div class="col-sm-7"> <!-- hotel summary container -->

				<div class="col-sm-12">

					<div class="boxLeftHotel">

						<div class="col-sm-12 hotelMode">Booking Summary</div>

						<div class="col-sm-12 hotelName">

							Name of the package: <span class="nameText"><?php echo $row["PackageName"]; ?></span>
							<!-- Location: <span class="nameText"><?php echo $row["PackageLocation"]; ?></span> -->

						</div>

						<div class="col-sm-3 borderRight">
							<div class="noOfGuests"><?php echo $city ?? ''; ?></div>
							<div class="noOfGuestsSubscript">City</div>
						</div>

						<div class="col-sm-3 borderRight">
							<div class="checkIn"><?php echo $checkIn ?? ''; ?></div>
							<div class="checkInSubscript">Date</div>
						</div>

						<div class="col-sm-3">
							<div class="noOfRooms"><?php echo $passengersBus ?? ''; ?></div>
							<div class="noOfRoomsSubscript">No. of person</div>
						</div>

					</div> <!-- boxLeft -->

				</div> <!-- col-sm-7 Departure -->

			</div>

			<div class="col-sm-5"> <!-- fare container -->

				<div class="col-sm-12">

					<div class="boxRightHotel">

						<div class="col-sm-12 fareSummary">Payment Summary</div>

						<div class="col-sm-8">

							<?php

							$var1 = $_SESSION["checkIn"] ?? '';
							$var2 = $_SESSION["checkOut"] ?? '';
							$date1 = date_create(str_replace('/', '-', $var1));
							$date2 = date_create(str_replace('/', '-', $var2));
							$diff = date_diff($date1, $date2);

							?>

							<div class="heading"><?php echo $_SESSION["noOfRooms"] ?? ''; ?> Rooms x <?php echo $diff->format("%a Days"); ?></div>
							<div class="heading">Convenience Fee</div>
						</div>

						<?php $noOfDays = $diff->format("%a"); ?>

						<div class="col-sm-4">
							<div class="price"><span class="sansSerif">₹ </span><?php echo $passengersBus * $PackagePrice; ?></div>
							<div class="price"><span class="sansSerif">₹ </span>250</div>
						</div>

						<div class="col-sm-12">

							<div class="calcBar"></div>

						</div>

						<div class="col-sm-8">
							<div class="headingTotal">Total Payment</div>
						</div>

						<div class="col-sm-4">
							<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($passengersBus * $PackagePrice) + 250; ?></div>
						</div>

						<form action="payment.php" method="POST">

							<div class="bookingButton text-center">
								<input type="submit" class="confirmButton" value="Confirm Booking">
							</div>

							<?php $totalFare = ($passengersBus * $PackagePrice) + 250; ?>

							<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
							<input type="hidden" name="packageIDHidden" value="<?php echo $packageID; ?>">
							<input type="hidden" name="passengersBusHidden" value="<?php echo $passengersBus; ?>">
							<input type="hidden" name="checkInHidden" value="<?php echo $checkIn; ?>">
							<input type="hidden" name="cityHidden" value="<?php echo $city; ?>">
							<input type="hidden" name="modeHidden" value="<?php echo "package" ?>">

						</form>

					</div>

				</div> <!-- col-sm-5 Fare -->

			</div> <!-- fare container -->

		</div> <!-- hotel -->



	</div> <!--bookingWrapper -->

	<div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->

	<?php include("common/footer.php"); ?>

</body>

<!-- BODY TAG ENDS -->

</html>