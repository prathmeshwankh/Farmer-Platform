<?php
include 'db.php';
session_start();

$id = intval($_GET['id']);
$phone = $_SESSION['phone'];

mysqli_query($conn, "
DELETE FROM products 
WHERE id=$id AND farmer_phone='$phone'
");

header("Location: add_product.php");
exit();
?>