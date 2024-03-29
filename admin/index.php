<?php
session_start();
include('includes/config.php');


?>

<!DOCTYPE HTML>
<html>

<head>
	<title>TMS | Admin Sign in</title>
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
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/morris.css" type="text/css" />
	<link rel="stylesheet" href="public/libs/toastr/toastr.css" type="text/css" />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<!-- jQuery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/main.js"></script>
	<script src="public/libs/toastr/toastr.js"></script>
	<script>
		$(document).ready(function() {
			$('#loginAction').submit(function(event) {
				// Your form submission logic here
				var isError = false;
				if (!ValidateControl($('#username'))) {
					showToastr("Enter User Name!", "error");
					isError = true;
				} else if (!ValidateControl($('#password'))) {
					showToastr("Enter Password!", "error");
					isError = true;
				}
				if (isError) {
					return false;
				}
			});
		});
	</script>
	<!-- //jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
</head>

<body>
	<div class="main-wthree" style="text-overflow: ellipsis; background-image: url(../images/login/login_bg.jpg); background-attachment: fixed; height: auto; min-height: 100vh !important; background-size: cover;">
		<div class="container">
			<div class="sin-w3-agile">
				<h2>Sign In</h2>
				<form method="post" id="loginAction">
					<div class="username">
						<span class="username">Username:</span>
						<input type="text" name="username" class="name" placeholder="" id="username">
						<div class="clearfix"></div>
					</div>
					<!-- <div>
						<a href="forgot-password.php" style="color: red;">Forgot Password</a>
					</div> -->
					<br>
					<div class="password-agileits">
						<span class="username">Password:</span>
						<input type="password" name="password" class="password" placeholder="" id="password">
						<div class="clearfix"></div>
					</div>

					<div class="login-w3">
						<input type="submit" class="login" name="login" value="Sign In">
					</div>
					<div class="clearfix"></div>
				</form>
				<div class="back">
					<a href="../index.php" style="color: red;">Back to home</a>
				</div>

			</div>
		</div>
	</div>
</body>

</html>
<?php
if (isset($_POST['login'])) {
	$uname = $_POST['username'];
	$password = md5($_POST['password']);
	$sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uname', $uname, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		$_SESSION['alogin'] = $_POST['username'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else {

		//echo "<script>alert('Invalid Details');</script>";
		echo "<script>showToastr('Invalid Details!', 'error')</script>";
	}
}
?>