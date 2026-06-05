<?php
session_start();
include 'db.php';

// 🔐 Check login
if(!isset($_SESSION['phone'])){
    header("Location: farmer_login.php");
    exit();
}

// Get values safely
$id = intval($_GET['id']);
$phone = $_SESSION['phone'];

// 🔒 Delete only own product
$stmt = $conn->prepare("DELETE FROM products WHERE id=? AND farmer_phone=?");
$stmt->bind_param("is", $id, $phone);
$stmt->execute();

header("Location: add_product.php");
exit();
?>