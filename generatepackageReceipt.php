<?php session_start();
if (!isset($_SESSION["username"])) {
	header("Location:blocked.php");
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
?>

<!-- dumping the current page to buffer -->
<?php
ob_start();
?>

<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="author" content="Joydeep Dev Nath">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/favicon.ico">

	<?php $titleNameT = 'Receipt';
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

	<div class="spacer">a</div>

	<?php

	date_default_timezone_set("Asia/Kolkata");
	$date = date('l jS \of F Y \a\t h:i:s A');

	$packageID = $_POST["packageIDHidden"];
	$fare = $_POST["fareHidden"];
	$passengersBus = $_POST["passengersBusHidden"];
	$checkIn = $_POST["checkInHidden"];
	$city = $_POST["cityHidden"];

	?>
	<?php include("common/config.php"); ?>

	<div class="col-sm-12 generateReceipt">

		<div class="commonHeader">

			<div class="col-sm-1"></div>

			<div class="col-sm-7 text-left">

				<div class="headingOne">

					Booking Receipt

				</div>

				<div class="dateTime">

					<span class="generated">Generated: </span><?php echo $date; ?>

				</div>

			</div>

			<div class="col-sm-3 text-right">

				<a href="./"><img src="images/logo.png" alt="Travel Logo" /></a>

			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-12"></div>

			<div class="col-sm-1"></div>
			<div class="col-sm-10 bar"></div>
			<div class="col-sm-1"></div>

		</div> <!-- contains the header and logo -->

		<div class="col-sm-12"></div> <!-- empty class -->

		<div class="col-sm-1"></div>

		<div class="col-sm-10">

			<div class="subHeading">

				Booking Information:

			</div>

		</div>

		<div class="col-sm-12"></div> <!-- empty class -->

		<div class="col-sm-1"></div>

		<div class="col-sm-10 boxCenter"> <!-- outboundFlight Box -->

			<?php

			$sql = "SELECT * FROM tbltourpackages WHERE PackageId='$packageID'";
			$result = $conn->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC)

			?>

			<div class="col-sm-1 borderRight text-center">

				<div class="flightOperatorHeading">

					Package ID

				</div>

				<div class="flightOperator">

					<?php $packageID = $row["PackageId"];
					echo substr($packageID, 0, 3) ?>

				</div>

				<div class="flightNo">

					<?php $packageID = $row["PackageId"];
					echo substr($packageID, 3) ?>

				</div>

			</div> <!-- col-sm-4 -->

			<div class="col-sm-3 borderRight text-center">

				<div class="flightOperatorHeading">

					Hotel Name

				</div>

				<div class="flightOperator">

					<?php echo $row["PackageName"]; ?>

				</div>

				<div class="flightNo">

					<?php echo $row["PackageLocation"]; ?>

				</div>

			</div> <!-- col-sm-4 -->

			<div class="col-sm-2 borderRight text-center">

				<div class="departsHeading">

					City

				</div>

				<div class="departs">

					<?php echo $$city ?? ''; ?>

				</div>

			</div> <!-- col-sm-4 -->

			<div class="col-sm-2 borderRight text-center">

				<div class="departsHeading">

					Date

				</div>

				<div class="departs">

					<?php echo $checkIn ?? ''; ?>

				</div>

			</div> <!-- col-sm-4 -->

			<div class="col-sm-2 text-center">

				<div class="originHeading">

					No. of person

				</div>

				<div class="origin">

					<?php echo $passengersBus ?? ''; ?>

				</div>

			</div> <!-- col-sm-4 -->



		</div> <!-- outboundFlight Box -->

		<div class="col-sm-12 spacer">a</div>

		<div class="col-sm-1"></div>

		<div class="col-sm-10">

			<div class="subHeading">

				Payment Information

			</div>

		</div>

		<div class="col-sm-12"></div> <!-- empty class -->

		<div class="col-sm-1"></div>

		<div class="col-sm-12"></div> <!-- empty class -->

		<div class="col-sm-1"></div>

		<div class="col-sm-10 boxCenter">

			<div class="columnHeaders">



				<div class="col-sm-6 borderBottom">

					<div class="passengerNameHeader text-center">

						Amount paid

					</div>

				</div>

				<div class="col-sm-6 borderBottom">

					<div class="genderHeader text-center">

						Payment Mode

					</div>

				</div>

			</div> <!-- columnHeaders -->

			<div class="col-sm-6">

				<div class="serialNo text-center">

					<span class="rupee">₹</span><?php echo $fare ?>

				</div>

			</div>

			<div class="col-sm-6">

				<div class="serialNo text-center">

					Card Payment

				</div>

			</div>

		</div> <!-- boxCenter -->

		<div class="col-sm-1"></div>

		<div class="importantInfo">

			<div class="col-sm-12"></div> <!-- empty class -->

			<div class="col-sm-12 spacer">a</div>
			<div class="col-sm-12 spacer">a</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-10">

				<div class="subHeading">

					Important Information

				</div>

			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-12"></div>

			<div class="col-sm-1"></div>
			<div class="col-sm-10 bar"></div>
			<div class="col-sm-1"></div>

			<div class="col-sm-12"></div>

			<div class="col-sm-1"></div>

			<div class="col-sm-10">

				<div class="info">

					<span class="strong">1.</span> A printed copy of this receipt must be presented at the time of check-in.

				</div>

				<div class="info">

					<span class="strong">2.</span> It is mandatory to have a Government recognised photo identification (ID) when checking-in. This can include: Driving License, Passport, PAN Card, Voter ID Card or any other ID issued by the Government of India.

				</div>

			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-12 spacer">a</div>

			<div class="col-sm-12"></div> <!-- empty class -->

		</div> <!-- importantInfo -->



	</div> <!-- generateTicket -->

	<div class="spacer">a</div>

</body>

<!-- BODY TAG ENDS -->

</html>

<!-- after user login system is built push the username usign the curent session to the database -->

<?php

$user = $_SESSION["username"];
$dateFormatted = date("d-m-Y"); //formatting the date as DD-MM-YY
$packageName = $row["PackageName"];
$bookingDataInsertSQL = "INSERT INTO `packagebookings`(packageName,date,username,cancelled) VALUES('$packageName','$dateFormatted','$user','no')";
$bookingDataInsertQuery = $conn->query($bookingDataInsertSQL);

$bookingIDSQL = "SELECT * FROM `packagebookings` ORDER BY `bookingID` DESC LIMIT 1";
$bookingIDQuery = $conn->query($bookingIDSQL);
$bookingIDGet = $bookingIDQuery->fetch(PDO::FETCH_NUM);
$latestBookingID = $bookingIDGet[0];
$currentBookingID = $latestBookingID;

?>

<!-- saving the file as temp.html -->
<?php
file_put_contents('packageReceipts\receipt' . $currentBookingID . '.html', ob_get_contents());
?>