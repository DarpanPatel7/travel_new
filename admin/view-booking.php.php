<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	// code for cancel
	if (isset($_REQUEST['bkid'])) {
		$bid = intval($_GET['bkid']);
		$status = 2;
		$cancelby = 'a';
		$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE  BookingId=:bid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
		$query->bindParam(':bid', $bid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Booking Cancelled successfully";
	}


	if (isset($_REQUEST['bckid'])) {
		$bcid = intval($_GET['bckid']);
		$status = 1;
		$cancelby = 'a';
		$sql = "UPDATE tblbooking SET status=:status WHERE BookingId=:bcid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':bcid', $bcid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Booking Confirm successfully";
	}
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>TMS | Admin manage Bookings</title>
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
		<link href="css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />
		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').basictable();

				$('#table-breakpoint').basictable({
					breakpoint: 768
				});

				$('#table-swap-axis').basictable({
					swapAxis: true
				});

				$('#table-force-off').basictable({
					forceResponsive: false
				});

				$('#table-no-resize').basictable({
					noResize: true
				});

				$('#table-two-axis').basictable();

				$('#table-max-height').basictable({
					tableWrapper: true
				});

				// Function to update URL parameters
				function updateUrlParam(key, value) {
					const url = new URL(window.location.href);
					url.searchParams.set(key, value);
					window.history.replaceState({}, '', url);
					window.location.reload(); // Reload the page
				}

				// Event listener for select element
				document.getElementById('type').addEventListener('change', function() {
					const selectedValue = this.value;
					updateUrlParam('Pbookingtype', selectedValue);
				});
			});
		</script>
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
					<li class="breadcrumb-item"><a href="view-booking.php">Home</a><i class="fa fa-angle-right"></i>Manage Bookings</li>
				</ol>
				<div class="agile-grids">

					<!-- tables -->
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
					<div class="agile-tables">
						<?php $Pbookingtype = $_GET['Pbookingtype'] ?? 'bus'; ?>
						<div class="w3l-table-info">
							<div class="row">
								<div class="col-md-3">
									<label for="type">Select Booking Type</label>
									<select class="form-control1" name="type" id="type">
										<option <?php echo !empty($Pbookingtype) && $Pbookingtype == 'bus' ? 'selected' : ''; ?> value="bus">Bus</option>
										<option <?php echo !empty($Pbookingtype) && $Pbookingtype == 'hotel' ? 'selected' : ''; ?> value="hotel">Hotel</option>
										<option <?php echo !empty($Pbookingtype) && $Pbookingtype == 'flight' ? 'selected' : ''; ?> value="flight">Flight</option>
										<option <?php echo !empty($Pbookingtype) && $Pbookingtype == 'train' ? 'selected' : ''; ?> value="train">Train</option>
										<option <?php echo !empty($Pbookingtype) && $Pbookingtype == 'cab' ? 'selected' : ''; ?> value="cab">Cab</option>
									</select>
								</div>
							</div>
							<h2>Manage <?php echo $_GET['Pusername']; ?>'s Bookings</h2>
							<table id="table">
								<thead>
									<tr>
										<th>Booikn id</th>
										<th>Name</th>
										<th>Mobile No.</th>
										<th>Email Id</th>
										<?php
										if (!empty($Pbookingtype) && $Pbookingtype == 'bus') { ?>
											<th>Date</th>
											<th>From/To</th>
											<th>Passangers</th>
											<th>Cancelled</th>
										<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'hotel') { ?>
											<th>Date</th>
											<th>Hotel Name</th>
											<th>Cancelled</th>
										<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'flight') { ?>
											<th>Date</th>
											<th>type</th>
											<th>From/To</th>
											<th>Passangers</th>
											<th>Cancelled</th>
										<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'train') { ?>
											<th>Date</th>
											<th>From/To</th>
											<th>Passangers</th>
											<th>Cancelled</th>
										<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'cab') { ?>
											<th>Date</th>
											<th>From/To</th>
											<th>Cancelled</th>
											<th>carType</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									
									<?php
									$Puid = $_GET['Puid'] ?? '';
									if(!empty($Pbookingtype) && $Pbookingtype == 'bus'){
										$sql = "SELECT users.EMail,users.Phone,users.FullName,busbookings.* from  users
										inner join busbookings on busbookings.username=users.Username";
									}else if(!empty($Pbookingtype) && $Pbookingtype == 'hotel'){
										$sql = "SELECT users.EMail,users.Phone,users.FullName,hotelbookings.* from  users
										inner join hotelbookings on hotelbookings.username=users.Username";
									}else if(!empty($Pbookingtype) && $Pbookingtype == 'flight'){
										$sql = "SELECT users.EMail,users.Phone,users.FullName,flightbookings.* from  users
										inner join flightbookings on flightbookings.username=users.Username";
									}else if(!empty($Pbookingtype) && $Pbookingtype == 'train'){
										$sql = "SELECT users.EMail,users.Phone,users.FullName,trainbookings.* from  users
										inner join trainbookings on trainbookings.username=users.Username";
									}else if(!empty($Pbookingtype) && $Pbookingtype == 'cab'){
										$sql = "SELECT users.EMail,users.Phone,users.FullName,cabbookings.*,cabdrivers.carType from  users
										inner join cabbookings on cabbookings.username=users.Username
										left join cabdrivers on cabdrivers.carID=cabbookings.carID";
									}

									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									// echo "<pre>";
									// print_r($sql);
									// exit;
									
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td>#BK-<?php echo htmlentities($result->bookingID); ?></td>
												<td><?php echo htmlentities($result->FullName); ?></td>
												<td><?php echo htmlentities($result->Phone); ?></td>
												<td><?php echo htmlentities($result->EMail); ?></td>
												<?php
												if (!empty($Pbookingtype) && $Pbookingtype == 'bus') { ?>
													<td><?php echo htmlentities($result->date) ?></td>
													<td><?php echo htmlentities($result->origin) .' / '. htmlentities($result->destination) ?></td>
													<td><?php echo htmlentities($result->passengers) ?></td>
													<td><?php echo htmlentities($result->cancelled) ?></td>
												<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'hotel') { ?>
													<td><?php echo htmlentities($result->date) ?></td>
													<td><?php echo htmlentities($result->hotelName) ?></td>
													<td><?php echo htmlentities($result->cancelled) ?></td>
												<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'flight') { ?>
													<td><?php echo htmlentities($result->date) ?></td>
													<td><?php echo htmlentities($result->type) ?></td>
													<td><?php echo htmlentities($result->origin) .' / '. htmlentities($result->destination) ?></td>
													<td><?php echo htmlentities($result->passengers) ?></td>
													<td><?php echo htmlentities($result->cancelled) ?></td>
												<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'train') { ?>
													<td><?php echo htmlentities($result->date) ?></td>
													<td><?php echo htmlentities($result->origin) .' / '. htmlentities($result->destination) ?></td>
													<td><?php echo htmlentities($result->passengers) ?></td>
													<td><?php echo htmlentities($result->cancelled) ?></td>
												<?php } else if (!empty($Pbookingtype) && $Pbookingtype == 'cab') { ?>
													<td><?php echo htmlentities($result->date) ?></td>
													<td><?php echo htmlentities($result->origin) .' / '. htmlentities($result->destination) ?></td>
													<td><?php echo htmlentities($result->cancelled) ?></td>
													<td><?php echo htmlentities($result->carType) ?></td>
												<?php } ?>
											</tr>
									<?php $cnt = $cnt + 1;
										}
									} ?>
								</tbody>
							</table>
						</div>
						</table>


					</div>
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
<?php } ?>