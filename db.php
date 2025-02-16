<?php
$host = "localhost";
$user = "root"; 
$pass = "";
$dbname = "bincomphptest"; 

$conn = new mysqli("localhost", "root", "", "bincomphptest");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    echo "✅ Database connected successfully!";
}

?>
