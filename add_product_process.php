<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'], $_SESSION['farmer_name'])) {
    header("Location: farmer_login.php");
    exit();
}

$name = trim($_SESSION['farmer_name']);
$farmerPhone = trim($_SESSION['phone']);
$product = trim($_POST['product_name'] ?? '');
$type = trim($_POST['type'] ?? '');
$desc = trim($_POST['description'] ?? '');
$unit = trim($_POST['unit'] ?? '');
$price = floatval($_POST['price'] ?? 0);

if ($name === '' || $farmerPhone === '' || $product === '' || $type === '' || $unit === '' || $price <= 0) {
    echo "<script>alert('Please fill all required fields correctly'); window.history.back();</script>";
    exit();
}

$stmt = $conn->prepare("
    INSERT INTO products (farmer_name, farmer_phone, product_name, type, price, unit, description)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("ssssdss", $name, $farmerPhone, $product, $type, $price, $unit, $desc);

if ($stmt->execute()) {
    echo "<script>alert('Product added successfully'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Error adding product'); window.history.back();</script>";
}
?>
