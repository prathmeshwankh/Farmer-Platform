<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);
$userPhone = $_SESSION['phone'];

$stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_phone = ?");
$stmt->bind_param("is", $id, $userPhone);
$stmt->execute();

header("Location: cart.php");
exit();
?>
