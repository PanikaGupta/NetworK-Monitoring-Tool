<?php
// Database configuration
$servername = "localhost";
$username = "panika";
$password = "p";
$db_name = "project_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

