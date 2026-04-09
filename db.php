<?php
$conn = mysqli_connect("localhost", "root", "", "farmerplatform");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
