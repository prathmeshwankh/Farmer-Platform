<?php
include 'db.php';

$name = $_POST['farmer_name'];
$product = $_POST['product_name'];
$type = $_POST['type'];
$price = $_POST['price'];
$desc = $_POST['description'];
$unit = $_POST['unit'];

mysqli_query($conn, "INSERT INTO products (farmer_name, product_name, type, price, unit, description)
VALUES ('$name', '$product', '$type', '$price', '$unit', '$desc')");

echo "<script>alert('Product Added'); window.location='index.php';</script>";
?>
