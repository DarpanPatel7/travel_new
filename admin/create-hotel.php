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
				$('#addhotel').submit(function(event) {
					// Your form submission logic here
					var isError = false;
					if (!ValidateControl($('#hotelID'))) {
						showToastr("Enter HotelID!", "error");
						isError = true;
					} else if (!ValidateControl($('#hotelName'))) {
						showToastr("Enter Hotel Name!", "error");
						isError = true;
					} else if (!ValidateControl($('#city'))) {
						showToastr("Enter City!", "error");
						isError = true;
					} else if (!ValidateControl($('#locality'))) {
						showToastr("Enter Locality!", "error");
						isError = true;
					} else if (!ValidateControl($('#stars'))) {
						showToastr("Enter Stars!", "error");
						isError = true;
					} else if (!ValidateControl($('#rating'))) {
						showToastr("Enter Rating!", "error");
						isError = true;
					} else if (!ValidateControl($('#hotelDesc'))) {
						showToastr("Enter Hotel Descritption!", "error");
						isError = true;
					} else if (!ValidateControl($('#checkIn'))) {
						showToastr("Enter Check In!", "error");
						isError = true;
					} else if (!ValidateControl($('#checkOut'))) {
						showToastr("Enter Check Out!", "error");
						isError = true;
					} else if (!ValidateControl($('#price'))) {
						showToastr("Enter Price!", "error");
						isError = true;
					} else if (!ValidateControl($('#wifi'))) {
						showToastr("Enter Wifi!", "error");
						isError = true;
					} else if (!ValidateControl($('#swimmingPool'))) {
						showToastr("Enter Swimming Pool!", "error");
						isError = true;
					} else if (!ValidateControl($('#parking'))) {
						showToastr("Enter Parking!", "error");
						isError = true;
					} else if (!ValidateControl($('#restaurant'))) {
						showToastr("Enter Restaurant!", "error");
						isError = true;
					} else if (!ValidateControl($('#laundry'))) {
						showToastr("Enter Laundry!", "error");
						isError = true;
					} else if (!ValidateControl($('#cafe'))) {
						showToastr("Enter Cafe!", "error");
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
					<li class="breadcrumb-item"><a href="manage-hotels.php">Home</a><i class="fa fa-angle-right"></i>Create Hotel </li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Create Hotel</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="succWrap" id="succWrap" style="display: none;"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">
								<form class="form-horizontal" name="addhotel" method="post" enctype="multipart/form-data" id="addhotel">
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">HotelID</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="hotelID" id="hotelID" placeholder="HotelID">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Hotel Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="hotelName" placeholder="Hotel Name" id="hotelName">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">City</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="city" id="city" placeholder="City">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Locality</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="locality" id="locality" placeholder="Locality">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Stars</label>
										<div class="col-sm-8">
											<input type="number" class="form-control1" name="stars" id="stars" placeholder="Stars">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Rating</label>
										<div class="col-sm-8">
											<input type="number" class="form-control1" name="rating" id="rating" placeholder="Rating">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Hotel Description</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="hotelDesc" id="hotelDesc" placeholder="Hotel Description">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Check In</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="checkIn" id="checkIn" placeholder="Check In">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Check Out</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="checkOut" id="checkOut" placeholder="Check Out">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Price</label>
										<div class="col-sm-8">
											<input type="number" class="form-control1" name="price" id="price" placeholder="Price">
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Wifi</label>
										<div class="col-sm-8">
											<select class="form-control1" name="wifi" id="wifi">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Swimming Pool</label>
										<div class="col-sm-8">
											<select class="form-control1" name="swimmingPool" id="swimmingPool">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Parking</label>
										<div class="col-sm-8">
											<select class="form-control1" name="parking" id="parking">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Restaurant</label>
										<div class="col-sm-8">
											<select class="form-control1" name="restaurant" id="restaurant">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Laundry</label>
										<div class="col-sm-8">
											<select class="form-control1" name="laundry" id="laundry">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Cafe</label>
										<div class="col-sm-8">
											<select class="form-control1" name="cafe" id="cafe">
												<option value="">Select</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Main Image</label>
										<div class="col-sm-8">
											<input type="file" name="mainImage" id="mainImage">
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
		$photelID = $_POST['hotelID'];
		$photelName = $_POST['hotelName'];
		$pcity = $_POST['city'];
		$plocality = $_POST['locality'];
		$pstars = $_POST['stars'];
		$prating = $_POST['rating'];
		$photelDesc = $_POST['hotelDesc'];
		$pcheckIn = $_POST['checkIn'];
		$pcheckOut = $_POST['checkOut'];
		$pprice = $_POST['price'];
		$pwifi = $_POST['wifi'];
		$pswimmingPool = $_POST['swimmingPool'];
		$pparking = $_POST['parking'];
		$prestaurant = $_POST['restaurant'];
		$plaundry = $_POST['laundry'];
		$pcafe = $_POST['cafe'];
		$pmainImage = rand(1000000000,9999999999).$_FILES['mainImage']["name"];

		if( $_FILES['mainImage']['name'] != "" ) {
			move_uploaded_file($_FILES["mainImage"]["tmp_name"], "images/hotel/" . $pmainImage);
		}

		try {
			$sql = "INSERT INTO hotels(hotelID, hotelName, city, locality, stars, rating, hotelDesc, checkIn, checkOut, price, wifi, swimmingPool, parking, restaurant, laundry, cafe, mainImage) VALUES(:hotelID, :hotelName, :city, :locality, :stars, :rating, :hotelDesc, :checkIn, :checkOut, :price, :wifi, :swimmingPool, :parking, :restaurant, :laundry, :cafe, :mainImage)";

			$query = $dbh->prepare($sql);
			$query->bindParam(':hotelID', $photelID, PDO::PARAM_STR);
			$query->bindParam(':hotelName', $photelName, PDO::PARAM_STR);
			$query->bindParam(':city', $pcity, PDO::PARAM_STR);
			$query->bindParam(':locality', $plocality, PDO::PARAM_STR);
			$query->bindParam(':stars', $pstars, PDO::PARAM_STR);
			$query->bindParam(':rating', $prating, PDO::PARAM_STR);
			$query->bindParam(':hotelDesc', $photelDesc, PDO::PARAM_STR);
			$query->bindParam(':checkIn', $pcheckIn, PDO::PARAM_STR);
			$query->bindParam(':checkOut', $pcheckOut, PDO::PARAM_STR);
			$query->bindParam(':price', $pprice, PDO::PARAM_STR);
			$query->bindParam(':wifi', $pwifi, PDO::PARAM_STR);
			$query->bindParam(':swimmingPool', $pswimmingPool, PDO::PARAM_STR);
			$query->bindParam(':parking', $pparking, PDO::PARAM_STR);
			$query->bindParam(':restaurant', $prestaurant, PDO::PARAM_STR);
			$query->bindParam(':laundry', $plaundry, PDO::PARAM_STR);
			$query->bindParam(':cafe', $pcafe, PDO::PARAM_STR);
			$query->bindParam(':mainImage', $pmainImage, PDO::PARAM_STR);

			$success = $query->execute();
			if ($success) {
				$msg = "Hotel Created Successfully";
				echo "<script>showToastr('$msg', 'success');</script>"; // Assuming showToastr is a JavaScript function to show a notification
				echo "<script>$('#succWrap').append('<strong>SUCCESS</strong>:Hotel Created Successfully');$('#succWrap').show();</script>";
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