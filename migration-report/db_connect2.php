<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "d8_migration_new";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo "Fine";
}

?>
