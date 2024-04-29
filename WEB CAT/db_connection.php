 <?php
// Connection details
$servername = "localhost";
$username = "Diane";
$password = "222010381";
$dbname = "urhuye";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>