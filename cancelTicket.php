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
	$id = $_POST["bookingID"];


	$cancelFlightBookingsSQL = "UPDATE `flightbookings` SET cancelled='yes' WHERE bookingID='$id'";
	$cancelFlightBookingsQuery = $conn->query($cancelFlightBookingsSQL);

	/*-------------------------------------------------------------------------------
	
	
				Add SQL statements to delete train, bus, cabs booking too
	
	
	-------------------------------------------------------------------------------*/


?>