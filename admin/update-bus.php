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
				$('#updatebus').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#operator'))) {
						showToastr("Enter Operator!", "error");
						isError = true;
					} else if (!ValidateControl($('#type'))) {
						showToastr("Enter Type!", "error");
						isError = true;
					} else if (!ValidateControl($('#origin'))) {
						showToastr("Enter Origin!", "error");
						isError = true;
					} else if (!ValidateControl($('#destination'))) {
						showToastr("Enter Destination!", "error");
						isError = true;
					} else if (!ValidateControl($('#originArea'))) {
						showToastr("Enter Origin Area!", "error");
						isError = true;
					} else if (!ValidateControl($('#destinationArea'))) {
						showToastr("Enter Destination Area!", "error");
						isError = true;
					} else if (!ValidateControl($('#departure'))) {
						showToastr("Enter Departure!", "error");
						isError = true;
					} else if (!ValidateControl($('#arrival'))) {
						showToastr("Enter Arrival!", "error");
						isError = true;
					} else if (!ValidateControl($('#seats'))) {
						showToastr("Enter Seats!", "error");
						isError = true;
					} else if (!ValidateControl($('#windows'))) {
						showToastr("Enter Windows!", "error");
						isError = true;
					} else if (!ValidateControl($('#fare'))) {
						showToastr("Enter Fare!", "error");
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
					<li class="breadcrumb-item"><a href="manage-buses.php">Home</a><i class="fa fa-angle-right"></i>Update Bus</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Update Bus</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">

								<?php
								try {
									$pid = $_GET['pid'] ?? '';
									$sql = "SELECT * from bus where busID=:pid";
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

										<form class="form-horizontal" name="updatebus" method="post" id="updatebus">
											<input type="hidden" name="busID" value="<?php echo $pid ?>">
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Operator</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="operator" placeholder="Operator" id="operator" value="<?php echo $result['operator'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Type</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="type" id="type" placeholder=" Type" id="type" value="<?php echo $result['type'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="origin" id="origin" placeholder="Origin" id="origin" value="<?php echo $result['origin'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destination" id="destination" placeholder=" Destination" id="destination" value="<?php echo $result['destination'] ?? ''; ?>"> 
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Origin Area</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="originArea" id="originArea" placeholder="Origin Area" id="originArea" value="<?php echo $result['originArea'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Destination Area</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="destinationArea" id="destinationArea" placeholder="Destination Area" id="destinationArea" value="<?php echo $result['destinationArea'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Departure</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="departure" id="departure" placeholder=" Departure" id="departure" value="<?php echo $result['departure'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Arrival</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="arrival" id="arrival" placeholder="Arrival" id="arrival" value="<?php echo $result['arrival'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Seats</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="seats" id="seats" placeholder="Seats" id="seats" value="<?php echo $result['seats'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Windows</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="windows" id="windows" placeholder="Windows" id="windows" value="<?php echo $result['windows'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Fare</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="fare" id="fare" placeholder="Windows" id="fare" value="<?php echo $result['fare'] ?? ''; ?>">
												</div>
											</div>
									<?php }
								} ?>

									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Update</button>
											<a href="manage-buses.php" class="btn-primary btn">Back</a>
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
		$pbusID = $_POST['busID'];
		$poperator = $_POST['operator'];
		$ptype = $_POST['type'];
		$porigin = $_POST['origin'];
		$pdestination = $_POST['destination'];
		$poriginArea = $_POST['originArea'];
		$pdestinationArea = $_POST['destinationArea'];
		$pdeparture = $_POST['departure'];
		$parrival = $_POST['arrival'];
		$pseats = $_POST['seats'];
		$pwindows = $_POST['windows'];
		$pfare = $_POST['fare'];
		try {
			$sql = "update bus set operator=:operator, type=:type, origin=:origin, destination=:destination, originArea=:originArea, destinationArea=:destinationArea, departure=:departure, arrival=:arrival, seats=:seats, windows=:windows, fare=:fare where busID=:busID";
			$query = $dbh->prepare($sql);
			$query->bindParam(':busID', $pbusID, PDO::PARAM_STR);
			$query->bindParam(':operator', $poperator, PDO::PARAM_STR);
			$query->bindParam(':type', $ptype, PDO::PARAM_STR);
			$query->bindParam(':origin', $porigin, PDO::PARAM_STR);
			$query->bindParam(':destination', $pdestination, PDO::PARAM_STR);
			$query->bindParam(':originArea', $poriginArea, PDO::PARAM_STR);
			$query->bindParam(':destinationArea', $pdestinationArea, PDO::PARAM_STR);
			$query->bindParam(':departure', $pdeparture, PDO::PARAM_STR);
			$query->bindParam(':arrival', $parrival, PDO::PARAM_STR);
			$query->bindParam(':seats', $pseats, PDO::PARAM_STR);
			$query->bindParam(':windows', $pwindows, PDO::PARAM_STR);
			$query->bindParam(':fare', $pfare, PDO::PARAM_STR);

			$success = $query->execute();
			if ($success) {
				$msg = "Bus Updated Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Bus Updated Successfully');$('#succWrap').show();</script>";
			} else {
				$error = "Something went wrong. Please try again";
				echo "<script>showToastr('$error', 'error');</script>"; // Assuming showToastr is a JavaScript function to show a notification
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
} ?>