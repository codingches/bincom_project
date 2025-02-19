<?php
// this will connect my code to the database.
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bincomphptest";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
