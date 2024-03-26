<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

	<meta charset="UTF-8">
	<meta name="author" content="Joydeep Dev Nath">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="images/favicon.ico">

	<?php $titleNameT = 'Sig Up'; include("common/title.php"); ?>

	<link href="css/main.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
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

</head>

<body>

	<?php include("common/config.php"); ?>
	<?php

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s');

	$name = $_POST["name"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	$subject = $_POST["subject"];
	$queries = $_POST["queries"];

    $insertDataSQL = "INSERT INTO `tblenquiry`(FullName,EmailId,MobileNumber,Subject,Description,PostingDate,Status) VALUES('$name','$email','$mobile','$subject','$queries','$date',0)";
    $insertDataQuery = $conn->query($insertDataSQL);

    if ($insertDataQuery) { ?>

        <?php $titleNameT = 'Message Send'; include("common/title.php"); ?>

        <div class="container-fluid">

            <div class="col-sm-12 messages">

                <div class="col-sm-12 text-center">

                    <div class="col-sm-12 heading">
                        Message Received
                    </div>

                </div>

                <div class="col-sm-3"></div> <!-- empty class -->

                <div class="col-sm-6 containerBox">

                    <div class="col-sm-12 text">

                        You've submitted message successfully.

                    </div>

                    <div class="col-sm-12 text-center">
                        <a href="index.php">
                            <input type="button" class="button" name="home" value="Home">
                        </a>
                    </div>

                </div>

                <div class="col-sm-3"></div> <!-- empty class -->

            </div>

        </div> <!-- container-fluid -->

    <?php } else { ?>

        <?php $titleNameT = "Message Send Failed"; include("common/title.php"); ?>

        <div class="container-fluid">

            <div class="messages">

                <div class="col-sm-12">

                    <div class="heading text-center">
                        Message Send Failed
                    </div>

                </div>

                <div class="col-sm-6 col-sm-offset-3">

                    <div class="col-sm-12 containerBox">

                        <div class="col-sm-12 text">

                            Sorry we couldn't received your message.
                            <br />
                            Please try again in a while.

                        </div>

                        <div class="col-sm-12 text-center">
                            <a href="contactUs.php">
                                <input type="button" class="button" name="contactUs" value="Contact Us">
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->

    <?php } ?>



</body>

</html>