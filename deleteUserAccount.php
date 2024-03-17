<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
?>
<?php include("common/config.php"); ?>
<?php
	$user = $_SESSION["username"];
	
	$deleteUserSQL = "DELETE FROM `users` WHERE Username='$user'";
	$deleteUserQuery = $conn->query($deleteUserSQL);

	$deleteFlightBookingsSQL = "DELETE FROM `flightbookings` WHERE Username='$user'";
	$deleteFlightBookingsQuery = $conn->query($deleteFlightBookingsSQL);

	/*-------------------------------------------------------------------------------
	
	
				Add SQL statements to delete train, bus, cabs booking too
	
	
	-------------------------------------------------------------------------------*/


?>