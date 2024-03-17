<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>TMS | Admin Package Creation</title>

		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link rel="stylesheet" href="public/libs/toastr/toastr.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/main.js"></script>
		<script src="public/libs/toastr/toastr.js"></script>
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>
		<script>
			$(document).ready(function() {
				$('#addflight').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#flight_no'))) {
						showToastr("Enter FlightNo!", "error");
						isError = true;
					} else if (!ValidateControl($('#origin'))) {
						showToastr("Enter Origin!", "error");
						isError = true;
					} else if (!ValidateControl($('#destination'))) {
						showToastr("Enter Destination!", "error");
						isError = true;
					} else if (!ValidateControl($('#distance'))) {
						showToastr("Enter Distance!", "error");
						isError = true;
					} else if (!ValidateControl($('#fare'))) {
						showToastr("Enter Fare!", "error");
						isError = true;
					} else if (!ValidateControl($('#class'))) {
						showToastr("Enter Class!", "error");
						isError = true;
					} else if (!ValidateControl($('#departs'))) {
						showToastr("Enter Departs!", "error");
						isError = true;
					} else if (!ValidateControl($('#arrives'))) {
						showToastr("Enter Arrives!", "error");
						isError = true;
					} else if (!ValidateControl($('#operator'))) {
						showToastr("Enter Operator!", "error");
						isError = true;
					} else if (!ValidateControl($('#origin_code'))) {
						showToastr("Enter Origin Code!", "error");
						isError = true;
					} else if (!ValidateControl($('#destination_code'))) {
						showToastr("Enter Destination Code!", "error");
						isError = true;
					} else if (!ValidateControl($('#refundable'))) {
						showToastr("Enter Refundable!", "error");
						isError = true;
					}
					if (isError) {
						return false;
					}
				});
			});
		</script>
	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>

					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="manage-flights.php">Home</a><i class="fa fa-angle-right"></i>Create Flight</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Create Flight</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">
								<form class="form-horizontal" name="addflight" method="post" enctype="multipart/form-data" id="addflight">
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">FlightNo</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="flight_no" id="flight_no" placeholder="FlightNo">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Origin</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="origin" placeholder="Origin" id="origin">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Destination</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="destination" id="destination" placeholder=" Destination">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Distance</label>
										<div class="col-sm-8">
											<input type="number" class="form-control1" name="distance" id="distance" placeholder="Distance">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Fare</label>
										<div class="col-sm-8">
											<input type="number" class="form-control1" name="fare" id="fare" placeholder="Fare">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Class</label>
										<div class="col-sm-8">
											<select class="form-control1" name="class" id="class">
												<option value="">Select Class</option>
												<option value="Business">Business</option>
												<option value="Economy">Economy</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Departs</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="departs" id="departs" placeholder="Departs">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">arrives</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="arrives" id="arrives" placeholder="Arrives">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">operator</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="operator" id="operator" placeholder="Operator">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Origin Code</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="origin_code" id="origin_code" placeholder="Origin Code">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Destination Code</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="destination_code" id="destination_code" placeholder="Destination Code">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Refundable</label>
										<div class="col-sm-8">
											<select class="form-control1" name="refundable" id="refundable">
												<option value="">Select</option>
												<option value="Refundable">Yes</option>
												<option value="Non-Refundable">No</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Create</button>
											<button type="reset" class="btn-inverse btn">Reset</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--//grid-->

				<!-- script-for sticky-nav -->
				<script>
					$(document).ready(function() {
						var navoffeset = $(".header-main").offset().top;
						$(window).scroll(function() {
							var scrollpos = $(window).scrollTop();
							if (scrollpos >= navoffeset) {
								$(".header-main").addClass("fixed");
							} else {
								$(".header-main").removeClass("fixed");
							}
						});

					});
				</script>
				<!-- /script-for sticky-nav -->
				<!--inner block start here-->
				<div class="inner-block">

				</div>
				<!--inner block end here-->
				<!--copy rights start here-->
				<?php include('includes/footer.php'); ?>
				<!--COPY rights end here-->
			</div>
		</div>
		<!--//content-inner-->
		<!--/sidebar-menu-->
		<?php include('includes/sidebarmenu.php'); ?>
		<div class="clearfix"></div>
		</div>
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function() {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({
						"position": "absolute"
					});
				} else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function() {
						$("#menu span").css({
							"position": "relative"
						});
					}, 400);
				}

				toggle = !toggle;
			});
		</script>
		<!--js -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- /Bootstrap Core JavaScript -->

	</body>

	</html>
<?php
	if (isset($_POST['submit'])) {
		$pflight_no = $_POST['flight_no'];
		$porigin = $_POST['origin'];
		$pdestination = $_POST['destination'];
		$pdistance = $_POST['distance'];
		$pfare = $_POST['fare'];
		$pclass = $_POST['class'];
		$pdeparts = $_POST['departs'];
		$parrives = $_POST['arrives'];
		$poperator = $_POST['operator'];
		$porigin_code = $_POST['origin_code'];
		$pdestination_code = $_POST['destination_code'];
		$prefundable = $_POST['refundable'];
		try {
			$sql = "INSERT INTO flights(flight_no,origin,destination,distance,fare,class,departs,arrives,operator,origin_code,destination_code,refundable) VALUES(:flight_no, :origin, :destination, :distance, :fare, :class, :departs, :arrives, :operator, :origin_code, :destination_code, :refundable)";

			$query = $dbh->prepare($sql);
			$query->bindParam(':flight_no', $pflight_no, PDO::PARAM_STR);
			$query->bindParam(':origin', $porigin, PDO::PARAM_STR);
			$query->bindParam(':destination', $pdestination, PDO::PARAM_STR);
			$query->bindParam(':distance', $pdistance, PDO::PARAM_STR);
			$query->bindParam(':fare', $pfare, PDO::PARAM_STR);
			$query->bindParam(':class', $pclass, PDO::PARAM_STR);
			$query->bindParam(':departs', $pdeparts, PDO::PARAM_STR);
			$query->bindParam(':arrives', $parrives, PDO::PARAM_STR);
			$query->bindParam(':operator', $poperator, PDO::PARAM_STR);
			$query->bindParam(':origin_code', $porigin_code, PDO::PARAM_STR);
			$query->bindParam(':destination_code', $pdestination_code, PDO::PARAM_STR);
			$query->bindParam(':refundable', $prefundable, PDO::PARAM_STR);

			$success = $query->execute();
			if ($success) {
				$msg = "Flight Created Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Flight Created Successfully');$('#succWrap').show();</script>";
			} else {
				$error = "Something went wrong. Please try again";
				echo "<script>showToastr('$error', 'error');</script>"; // Assuming showToastr is a JavaScript function to show a notification
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}
?>