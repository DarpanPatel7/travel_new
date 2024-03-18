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

	<?php $titleNameT = 'Package Details';
	include("common/title.php"); ?>

	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="public/libs/toastr/toastr.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/hotelDetails.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.js"></script>
	<script src="js/bootstrap-dropdown.js"></script>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/moment-with-locales.js"></script>
	<script src="js/bootstrap-datetimepicker.js"></script>
	<script src="public/libs/toastr/toastr.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#datetimepicker5').datetimepicker({
				format: 'L',
				locale: 'en-gb',
				useCurrent: false,
				minDate: moment()
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#packagebooking').submit(function(event) {
				// Your form submission logic here
				var isError = false;
				if (!ValidateControl($('#city'))) {
					showToastr("Enter City!", "error");
					isError = true;
				} else if (!ValidateControl($('#adults'))) {
					showToastr("Enter No. of person!", "error");
					isError = true;
				} else if (!ValidateControl($('#datetime5'))) {
					showToastr("Enter Date!", "error");
					isError = true;
				}
				if (isError) {
					return false;
				}
			});
		});
	</script>
</head>

<!-- HEAD TAG ENDS -->

<!-- BODY TAG STARTS -->

<body>

	<?php include("common/headerLoggedIn.php"); ?>

	<?php

	$PackageId = $_GET["PackageId"];

	?>

	<div class="spacer">a</div>
	<div class="spacer">a</div>
	<?php include("common/config.php"); ?>
	<?php

	$sql = "SELECT * FROM tbltourpackages WHERE PackageId='$PackageId'";
	$result = $conn->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC)

	?>

	<div class="col-sm-1"></div> <!-- empty div -->

	<div class="col-sm-10 hotelDetails">

		<div class="col-sm-12 listItem">

			<div class="col-sm-8 leftBox">

				<div class="col-sm-12 imageContainer">

					<!-- <img src="<?php echo $row["mainImage"]; ?>" alt="Image not found" /> -->
					<img src="./admin/pacakgeimages/<?php echo $row['PackageImage'] ?? '' ?>" alt="Image not found" />

				</div>

			</div>

			<div class="col-sm-4 rightBox borderLeft">

				<div class="hotelName col-sm-12 text-center noMargin">

					<?php echo $row["PackageName"]; ?>

				</div>

				<div class="location col-sm-12 text-center">

					<span class="fa fa-map-marker"></span> <?php echo $row["PackageLocation"]; ?>
					<!-- <span class="fa fa-map-marker"></span> <?php echo $row["locality"] . ', ' . $row["city"]; ?> -->

				</div>

				<div class="col-sm-12 priceContainer text-center">

					₹ <?php echo $row["PackagePrice"] ?? 0; ?>

				</div>

				<div class="col-sm-12 priceNote text-center">

					per person

				</div>

				<!-- creating a form -->

				<form name="packagebooking" method="post" id="packagebooking">

					<div class="col-sm-6">
						<div class="form-group">
							<label for="city">City:<p> </p></label>
							<select id="city" data-live-search="true" class="selectpicker form-control" data-size="5" title="Select City" name="city">
								<option value="New Delhi" data-tokens="DEL New Delhi">New Delhi</option>
								<option value="Mumbai" data-tokens="BOM Mumbai">Mumbai</option>
								<option value="Kolkata" data-tokens="CCU Kolkata">Kolkata</option>
								<option value="Bangalore" data-tokens="BLR Bangalore">Bangalore</option>
								<option value="Chennai" data-tokens="MAA Chennai">Chennai</option>
								<option value="Pune" data-tokens="PNQ Pune">Pune</option>
								<option value="Kerala" data-tokens="KER Kerala">Kerala</option>
								<option value="Guwahati" data-tokens="GAU Guwahati">Guwahati</option>
								<option value="Manali" data-tokens="MAN Manali">Manali</option>
								<option value="Shillong" data-tokens="SHL Shillong">Shillong</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="passengers">No. of person:<p> </p></label>
						<div class="form-group">
							<select id="adults" class="selectpicker form-control" data-size="5" title="Select no. of passengers" name="passengersBus">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="datetime5">Date:<p> </p></label>
							<div class="input-group date" id="datetimepicker5">
								<input id="datetime5" type="text" class="inputDate form-control" placeholder="Select Check-in Date" name="checkIn" />
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 text-center">

						<input type="submit" name="submit" class="bookNow" value="Book Now" />

					</div>

					<input type="hidden" name="modeHidden" value="package" />
					<input type="hidden" name="packageIDHidden" value="<?php echo $PackageId; ?>" />

				</form>

			</div> <!-- right box -->

			<div class="col-sm-12 hotelDesc">

				<?php echo $row["PackageDetails"]; ?>

			</div>

			<div class="col-sm-12 hotelDesc">

				<?php echo $row["PackageFetures"]; ?>

			</div>

		</div>

	</div>

	<div class="col-sm-1"></div> <!-- empty div -->

	<div class="col-sm-12 spacer">.</div> <!-- just a dummy class for creating some space -->
	<div class="col-sm-12 spacer">.</div> <!-- just a dummy class for creating some space -->
	<div class="col-sm-12 spacer">.</div> <!-- just a dummy class for creating some space -->

	<?php include("common/footer.php"); ?>

</body>



<!-- BODY TAG ENDS -->

</html>
<?php
	if (isset($_POST['submit'])) {
		$pcity = $_POST['city'];
		$ppassengersBus = $_POST['passengersBus'];
		$pcheckIn = $_POST['checkIn'];
		$packageIDHidden = $_POST['packageIDHidden'];
		$PackagePrice = $row["PackagePrice"] ?? 0;

		echo "<script>window.location = 'packagebooking.php?packageID=$packageIDHidden&PackagePrice=$PackagePrice&city=$pcity&passengersBus=$ppassengersBus&checkIn=$pcheckIn';</script>";
	}

?>