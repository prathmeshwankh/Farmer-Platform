<?php
include 'db.php';

// Get and sanitize inputs
$name = mysqli_real_escape_string($conn, $_POST['farmer_name']);
$product = mysqli_real_escape_string($conn, $_POST['product_name']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$desc = mysqli_real_escape_string($conn, $_POST['description']);
$unit = mysqli_real_escape_string($conn, $_POST['unit']);
$price = floatval($_POST['price']);

// Validation
if(empty($name) || empty($product) || empty($type) || empty($unit)){
    echo "<script>alert('Please fill all required fields'); window.history.back();</script>";
    exit();
}

// Insert query
$sql = "INSERT INTO products 
(farmer_name, product_name, type, price, unit, description) 
VALUES 
('$name', '$product', '$type', '$price', '$unit', '$desc')";

if(mysqli_query($conn, $sql)){
    echo "<script>alert('Product Added Successfully 🌾'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Error adding product'); window.history.back();</script>";
}
?>