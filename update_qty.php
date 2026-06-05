<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: cart.php");
    exit();
}

$id = intval($_GET['id']);
$action = $_GET['action'];
$userPhone = $_SESSION['phone'];

if ($action === "increase") {
    $stmt = $conn->prepare("
        UPDATE cart
        SET quantity = quantity + 1
        WHERE id = ? AND user_phone = ?
    ");
    $stmt->bind_param("is", $id, $userPhone);
    $stmt->execute();
} elseif ($action === "decrease") {
    $stmt = $conn->prepare("
        UPDATE cart
        SET quantity = quantity - 1
        WHERE id = ? AND user_phone = ? AND quantity > 1
    ");
    $stmt->bind_param("is", $id, $userPhone);
    $stmt->execute();
}

header("Location: cart.php");
exit();
?>
