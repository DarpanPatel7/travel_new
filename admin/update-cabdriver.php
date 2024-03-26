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
				$('#updatecabdriver').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#carType'))) {
						showToastr("Enter Car Type!", "error");
						isError = true;
					} else if (!ValidateControl($('#carModel'))) {
						showToastr("Enter Car Model!", "error");
						isError = true;
					} else if (!ValidateControl($('#carNo'))) {
						showToastr("Enter Car No!", "error");
						isError = true;
					} else if (!ValidateControl($('#driverName'))) {
						showToastr("Enter Driver Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#driverPhone'))) {
						showToastr("Enter Driver Phone !", "error");
						isError = true;
					} else if (!ValidateControl($('#driverRating'))) {
						showToastr("Enter Driver Rating!", "error");
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
					<li class="breadcrumb-item"><a href="manage-cabdrivers.php">Home</a><i class="fa fa-angle-right"></i>Update Cab Driver</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Update Cab Driver</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">

								<?php
								try {
									$pid = $_GET['pid'] ?? '';
									$sql = "SELECT * from cabdrivers where carID=:pid";
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

										<form class="form-horizontal" name="updatecabdriver" method="post" enctype="multipart/form-data" id="updatecabdriver">
											<input type="hidden" name="id" value="<?php echo $pid ?>">
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Car Type</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="carType" placeholder="Car Type" id="carType" value="<?php echo $result['carType'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Car Model</label>
												<div class="col-sm-8">
													<input type="test" class="form-control1" name="carModel" id="carModel" placeholder="Car Model" value="<?php echo $result['carModel'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">carNo</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="carNo" id="carNo" placeholder="Car No" value="<?php echo $result['carNo'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">driverName</label>
												<div class="col-sm-8">
													<input type="text" class="form-control1" name="driverName" id="driverName" placeholder="Driver Name" value="<?php echo $result['driverName'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">driverPhone</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="driverPhone" id="driverPhone" placeholder="Driver Phone" value="<?php echo $result['driverPhone'] ?? ''; ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">driverRating</label>
												<div class="col-sm-8">
													<input type="number" class="form-control1" name="driverRating" id="driverRating" placeholder="Driver Rating" value="<?php echo $result['driverRating'] ?? ''; ?>">
												</div>
											</div>

									<?php }
								} ?>

									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Update</button>
											<a href="manage-cabdrivers.php" class="btn-primary btn">Back</a>
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
		$pid = $_POST['id'];
		$pcarType = $_POST['carType'];
		$pcarModel = $_POST['carModel'];
		$pcarNo = $_POST['carNo'];
		$pdriverName = $_POST['driverName'];
		$pdriverPhone = $_POST['driverPhone'];
		$pdriverRating = $_POST['driverRating'];

		try {
			$sql = "UPDATE cabdrivers SET carType=:carType,carModel=:carModel,carNo=:carNo,driverName=:driverName,driverPhone=:driverPhone,driverRating=:driverRating WHERE carID=:pid";

			$query = $dbh->prepare($sql);
			$query->bindParam(':pid', $pid, PDO::PARAM_STR);
			$query->bindParam(':carType', $pcarType, PDO::PARAM_STR);
			$query->bindParam(':carModel', $pcarModel, PDO::PARAM_STR);
			$query->bindParam(':carNo', $pcarNo, PDO::PARAM_STR);
			$query->bindParam(':driverName', $pdriverName, PDO::PARAM_STR);
			$query->bindParam(':driverPhone', $pdriverPhone, PDO::PARAM_STR);
			$query->bindParam(':driverRating', $pdriverRating, PDO::PARAM_STR);

			$success = $query->execute();
			if ($success) {
				$msg = "Cab Driver Updated Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Cab Driver Updated Successfully');$('#succWrap').show();</script>";
			} else {
				$error = "Something went wrong. Please try again";
				echo "<script>showToastr('$error', 'error');</script>"; // Assuming showToastr is a JavaScript function to show a notification
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
} ?>