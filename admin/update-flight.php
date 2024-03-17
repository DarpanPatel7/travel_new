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
				$('#updateflight').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#origin'))) {
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
					<li class="breadcrumb-item"><a href="manage-flights.php">Home</a><i class="fa fa-angle-right"></i>Update Flight</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Update Flight</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">

								<?php
								try {
									$pid = $_GET['pid'] ?? '';
									$sql = "SELECT * from flights where flight_no=:pid";
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

										<form class="form-horizontal" name="updateflight" method="post" id="updateflight">
											<input type="hidden" name="flight_no" value="<?php echo $pid ?>">
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="origin" placeholder="Origin" id="origin" value="<?php echo $result['origin'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destination" id="destination" placeholder=" Destination" value="<?php echo $result['destination'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Distance</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="distance" id="distance" placeholder="Distance" value="<?php echo $result['distance'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Fare</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="fare" id="fare" placeholder="Fare" value="<?php echo $result['fare'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Class</label>
												<div class="col-sm-8">
													<select class="form-control1" name="class" id="class">
														<option value="">Select Class</option>
														<option <?php echo !empty($result['class']) && $result['class'] == 'Business' ? 'selected' : '' ?> value="Business">Business</option>
														<option <?php echo !empty($result['class']) && $result['class'] == 'Economy' ? 'selected' : '' ?> value="Economy">Economy</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Departs</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="departs" id="departs" placeholder="Departs" value="<?php echo $result['departs'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">arrives</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="arrives" id="arrives" placeholder="Arrives" value="<?php echo $result['arrives'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">operator</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="operator" id="operator" placeholder="Operator" value="<?php echo $result['operator'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin Code</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="origin_code" id="origin_code" placeholder="Origin Code" value="<?php echo $result['origin_code'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination Code</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destination_code" id="destination_code" placeholder="Destination Code" value="<?php echo $result['destination_code'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Refundable</label>
												<div class="col-sm-8">
													<select class="form-control1" name="refundable" id="refundable">
														<option value="">Select</option>
														<option <?php echo !empty($result['refundable']) && $result['refundable'] == 'Refundable' ? 'selected' : '' ?>  value="Refundable">Yes</option>
														<option <?php echo !empty($result['refundable']) && $result['refundable'] == 'Non-Refundable' ? 'selected' : '' ?> value="Non-Refundable">No</option>
													</select>
												</div>
											</div>
									<?php }
								} ?>

									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Update</button>
											<a href="manage-flights.php" class="btn-primary btn">Back</a>
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
			$sql = "update flights set origin=:origin, destination=:destination, distance=:distance, fare=:fare, class=:class, departs=:departs, arrives=:arrives, operator=:operator, origin_code=:origin_code, destination_code=:destination_code, refundable=:refundable where flight_no=:flight_no";
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
				$msg = "Flight Updated Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Flight Updated Successfully');$('#succWrap').show();</script>";
			} else {
				$error = "Something went wrong. Please try again";
				echo "<script>showToastr('$error', 'error');</script>"; // Assuming showToastr is a JavaScript function to show a notification
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
} ?>