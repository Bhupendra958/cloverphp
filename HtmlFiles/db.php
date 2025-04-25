<?php
$host = "localhost";
$username = "root"; // Change if different
$password = "";     // Change if different
$dbname = "ca";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>