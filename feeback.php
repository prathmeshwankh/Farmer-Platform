<?php
include 'db.php';

$name = $_POST['name'];
$msg = $_POST['message'];

mysqli_query($conn, "INSERT INTO feedback (name, message) VALUES ('$name','$msg')");

echo "<script>alert('Thanks for feedback!'); window.location='index.php';</script>";
?>
