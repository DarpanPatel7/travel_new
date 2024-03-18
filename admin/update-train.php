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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				$('#updatetrain').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#region'))) {
						showToastr("Enter Region!", "error");
						isError = true;
					} else if (!ValidateControl($('#returnTrainNo'))) {
						showToastr("Enter Return TrainNo!", "error");
						isError = true;
					} else if (!ValidateControl($('#trainName'))) {
						showToastr("Enter Train Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#origin'))) {
						showToastr("Enter Origin!", "error");
						isError = true;
					} else if (!ValidateControl($('#destination'))) {
						showToastr("Enter Destination!", "error");
						isError = true;
					} else if (!ValidateControl($('#originCode'))) {
						showToastr("Enter Origin Code!", "error");
						isError = true;
					} else if (!ValidateControl($('#destinationCode'))) {
						showToastr("Enter Destination Code!", "error");
						isError = true;
					} else if (!ValidateControl($('#originTime'))) {
						showToastr("Enter Origin Time!", "error");
						isError = true;
					} else if (!ValidateControl($('#destinationTime'))) {
						showToastr("Enter Destination Time!", "error");
						isError = true;
					} else if (!ValidateControl($('#originPlatform'))) {
						showToastr("Enter Origin Platform!", "error");
						isError = true;
					} else if (!ValidateControl($('#destinationPlatform'))) {
						showToastr("Enter Destination Platform!", "error");
						isError = true;
					} else if (!ValidateControl($('#duration'))) {
						showToastr("Enter Duration!", "error");
						isError = true;
					} else if (!ValidateControl($('#classes'))) {
						showToastr("Enter Classes!", "error");
						isError = true;
					} else if (!ValidateControl($('#seats1AC'))) {
						showToastr("Enter Seats 1AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#seats2AC'))) {
						showToastr("Enter Seats 2AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#seats3AC'))) {
						showToastr("Enter Seats 3AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#seatsSL'))) {
						showToastr("Enter Seats SL!", "error");
						isError = true;
					} else if (!ValidateControl($('#seatsChairCar'))) {
						showToastr("Enter Seats Chair Car!", "error");
						isError = true;
					} else if (!ValidateControl($('#priceChairCarAC'))) {
						showToastr("Enter Seats Chair Car AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#price1AC'))) {
						showToastr("Enter Price 1AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#price2AC'))) {
						showToastr("Enter Price 2AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#price3AC'))) {
						showToastr("Enter Price 3AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#priceSL'))) {
						showToastr("Enter Price SL!", "error");
						isError = true;
					} else if (!ValidateControl($('#priceChairCar'))) {
						showToastr("Enter Price Chair Car!", "error");
						isError = true;
					} else if (!ValidateControl($('#priceChairCarAC'))) {
						showToastr("Enter Price Chair Car AC!", "error");
						isError = true;
					} else if (!ValidateControl($('#runsOn'))) {
						showToastr("Enter Runs On!", "error");
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
					<li class="breadcrumb-item"><a href="manage-trains.php">Home</a><i class="fa fa-angle-right"></i>Update Train</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Update Train</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">

								<?php
								try {
									$pid = $_GET['pid'] ?? '';
									$sql = "SELECT * from trains where trainNo=:pid";
									$query = $dbh->prepare($sql);
									$query->bindParam(':pid', $pid, PDO::PARAM_STR);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_ASSOC);
								} catch (PDOException $e) {
									echo "Error: " . $e->getMessage();
								}
								$cnt = 1;
								if ($query->rowCount() > 0) {
									foreach ($results as $result) {	?>

										<form class="form-horizontal" name="updatetrain" method="post" enctype="multipart/form-data" id="updatetrain">
											<input type="hidden" name="trainNo" value="<?php echo $pid ?>">
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Region</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="region" placeholder="Region" id="region" value="<?php echo $result['region'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Return TrainNo</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="returnTrainNo" id="returnTrainNo" placeholder="returnTrainNo" value="<?php echo $result['returnTrainNo'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Train Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="trainName" id="trainName" placeholder="Train Name" value="<?php echo $result['trainName'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="origin" id="origin" placeholder="Origin" value="<?php echo $result['origin'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destination" id="destination" placeholder="Destination" value="<?php echo $result['destination'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin Code</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="originCode" id="originCode" placeholder="Origin Code" value="<?php echo $result['originCode'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination Code</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destinationCode" id="destinationCode" placeholder="Destination Code" value="<?php echo $result['destinationCode'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin Time</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="originTime" id="originTime" placeholder="Origin Time" value="<?php echo $result['originTime'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination Time</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destinationTime" id="destinationTime" placeholder="Destination Time" value="<?php echo $result['destinationTime'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin Platform</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="originPlatform" id="originPlatform" placeholder="Origin Platform" value="<?php echo $result['originPlatform'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination Platform</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="destinationPlatform" id="destinationPlatform" placeholder="Destination Platform" value="<?php echo $result['destinationPlatform'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Duration</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="duration" id="duration" placeholder="Duration" value="<?php echo $result['duration'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Classes</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="classes" id="classes" placeholder="Classes" value="<?php echo $result['classes'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats 1AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seats1AC" id="seats1AC" placeholder="Seats 1AC" value="<?php echo $result['seats1AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats 2AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seats2AC" id="seats2AC" placeholder="Seats 2AC" value="<?php echo $result['seats2AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats 3AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seats3AC" id="seats3AC" placeholder="Seats 3AC" value="<?php echo $result['seats3AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats SL</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seatsSL" id="seatsSL" placeholder="Seats SL" value="<?php echo $result['seatsSL'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats Chair Car</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seatsChairCar" id="seatsChairCar" placeholder="Seats Chair Car" value="<?php echo $result['seatsChairCar'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats Chair Car Ac</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="priceChairCarAC" id="priceChairCarAC" placeholder="Seats Chair Car Ac" value="<?php echo $result['priceChairCarAC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price 1AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="price1AC" id="price1AC" placeholder="Price 1AC" value="<?php echo $result['price1AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price 2AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="price2AC" id="price2AC" placeholder="Price 2AC" value="<?php echo $result['price2AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price 3AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="price3AC" id="price3AC" placeholder="Price 3AC" value="<?php echo $result['price3AC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price SL</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="priceSL" id="priceSL" placeholder="Price SL" value="<?php echo $result['priceSL'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price Chair Car</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="priceChairCar" id="priceChairCar" placeholder="Price Chair Car" value="<?php echo $result['priceChairCar'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Price Chair Car AC</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="priceChairCarAC" id="priceChairCarAC" placeholder="Price Chair Car AC" value="<?php echo $result['priceChairCarAC'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Runs On</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="runsOn" id="runsOn" placeholder="Runs On" value="<?php echo $result['runsOn'] ?? ''; ?>">
												</div>
											</div>
									<?php }
								} ?>

									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Update</button>
											<a href="manage-train.php" class="btn-primary btn">Back</a>
										</div>
									</div>





							</div>

							</form>





							<div class="panel-footer">

							</div>
							</form>
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
		$ptrainNo = $_POST['trainNo'];
		$pregion = $_POST['region'];
		$preturnTrainNo = $_POST['returnTrainNo'];
		$ptrainName = $_POST['trainName'];
		$porigin = $_POST['origin'];
		$pdestination = $_POST['destination'];
		$poriginCode = $_POST['originCode'];
		$pdestinationCode = $_POST['destinationCode'];
		$poriginTime = $_POST['originTime'];
		$pdestinationTime = $_POST['destinationTime'];
		$poriginPlatform = $_POST['originPlatform'];
		$pdestinationPlatform = $_POST['destinationPlatform'];
		$pduration = $_POST['duration'];
		$pclasses = $_POST['classes'];
		$pseats1AC = $_POST['seats1AC'];
		$pseats2AC = $_POST['seats2AC'];
		$pseats3AC = $_POST['seats3AC'];
		$pseatsSL = $_POST['seatsSL'];
		$pseatsChairCar = $_POST['seatsChairCar'];
		$pseatsChairCarAC = $_POST['priceChairCarAC'];
		$pprice1AC = $_POST['price1AC'];
		$pprice2AC = $_POST['price2AC'];
		$pprice3AC = $_POST['price3AC'];
		$ppriceSL = $_POST['priceSL'];
		$ppriceChairCar = $_POST['priceChairCar'];
		$ppriceChairCarAC = $_POST['priceChairCarAC'];
		$prunsOn = $_POST['runsOn'];

		try {
			$sql = "UPDATE trains SET region=:region, returnTrainNo=:returnTrainNo, trainName=:trainName, origin=:origin, destination=:destination, originCode=:originCode, destinationCode=:destinationCode, originTime=:originTime, destinationTime=:destinationTime, originPlatform=:originPlatform, destinationPlatform=:destinationPlatform, duration=:duration, classes=:classes, seats1AC=:seats1AC, seats2AC=:seats2AC, seats3AC=:seats3AC, seatsSL=:seatsSL, seatsChairCar=:seatsChairCar, seatsChairCarAC=:seatsChairCarAC, price1AC=:price1AC, price2AC=:price2AC, price3AC=:price3AC, priceSL=:priceSL, priceChairCar=:priceChairCar, priceChairCarAC=:priceChairCarAC, runsOn=:runsOn WHERE trainNo=:trainNo";

			$query = $dbh->prepare($sql);
			$query->bindParam(':trainNo', $ptrainNo, PDO::PARAM_STR);
			$query->bindParam(':region', $pregion, PDO::PARAM_STR);
			$query->bindParam(':returnTrainNo', $preturnTrainNo, PDO::PARAM_STR);
			$query->bindParam(':trainName', $ptrainName, PDO::PARAM_STR);
			$query->bindParam(':origin', $porigin, PDO::PARAM_STR);
			$query->bindParam(':destination', $pdestination, PDO::PARAM_STR);
			$query->bindParam(':originCode', $poriginCode, PDO::PARAM_STR);
			$query->bindParam(':destinationCode', $pdestinationCode, PDO::PARAM_STR);
			$query->bindParam(':originTime', $poriginTime, PDO::PARAM_STR);
			$query->bindParam(':destinationTime', $pdestinationTime, PDO::PARAM_STR);
			$query->bindParam(':originPlatform', $poriginPlatform, PDO::PARAM_STR);
			$query->bindParam(':destinationPlatform', $pdestinationPlatform, PDO::PARAM_STR);
			$query->bindParam(':duration', $pduration, PDO::PARAM_STR);
			$query->bindParam(':classes', $pclasses, PDO::PARAM_STR);
			$query->bindParam(':seats1AC', $pseats1AC, PDO::PARAM_STR);
			$query->bindParam(':seats2AC', $pseats2AC, PDO::PARAM_STR);
			$query->bindParam(':seats3AC', $pseats3AC, PDO::PARAM_STR);
			$query->bindParam(':seatsSL', $pseatsSL, PDO::PARAM_STR);
			$query->bindParam(':seatsChairCar', $pseatsChairCar, PDO::PARAM_STR);
			$query->bindParam(':seatsChairCarAC', $pseatsChairCarAC, PDO::PARAM_STR);
			$query->bindParam(':price1AC', $pprice1AC, PDO::PARAM_STR);
			$query->bindParam(':price2AC', $pprice2AC, PDO::PARAM_STR);
			$query->bindParam(':price3AC', $pprice3AC, PDO::PARAM_STR);
			$query->bindParam(':priceSL', $ppriceSL, PDO::PARAM_STR);
			$query->bindParam(':priceChairCar', $ppriceChairCar, PDO::PARAM_STR);
			$query->bindParam(':priceChairCarAC', $ppriceChairCarAC, PDO::PARAM_STR);
			$query->bindParam(':runsOn', $prunsOn, PDO::PARAM_STR);

			$success = $query->execute();
			if ($success) {
				$msg = "Train Updated Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Train Updated Successfully');$('#succWrap').show();</script>";
			} else {
				$error = "Something went wrong. Please try again";
				echo "<script>showToastr('$error', 'error');</script>"; // Assuming showToastr is a JavaScript function to show a notification
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
} ?>