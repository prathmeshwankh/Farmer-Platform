<?php
session_start();
include 'db.php';

// 🔐 Check login
if(!isset($_SESSION['phone'])){
    header("Location: farmer_login.php");
    exit();
}

$phone = $_SESSION['phone'];

// 🔒 Delete only current user's cart
$stmt = $conn->prepare("DELETE FROM cart WHERE phone=?");
$stmt->bind_param("s", $phone);
$stmt->execute();

header("Location: cart.php");
?>