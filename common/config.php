<?php 
/* $servername = "localhost";
$username = "root";
$password = "pwd";
$dbname = "projectmeteor";

// Creating a connection to projectmeteor MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking if we've successfully connected to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */
?>
<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','pwd');
define('DB_NAME','projectmeteor');
// Establish database connection.
try
{
$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>