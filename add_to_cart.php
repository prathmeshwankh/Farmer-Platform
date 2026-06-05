<?php
session_start();
include 'db.php';

if(!isset($_SESSION['phone'])){
    header("Location: farmer_login.php");
    exit();
}

$user_phone = $_SESSION['phone'];

$product = $_POST['product_name'];
$price = $_POST['price'];

// Check if already exists
$check = mysqli_query($conn, "SELECT * FROM cart WHERE product_name='$product' AND user_phone='$user_phone'");

if(mysqli_num_rows($check) > 0){
    mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity + 1 
        WHERE product_name='$product' AND user_phone='$user_phone'
    ");
} else {
    mysqli_query($conn, "
        INSERT INTO cart (product_name, price, quantity, user_phone) 
        VALUES ('$product', '$price', 1, '$user_phone')
    ");
}

header("Location: cart.php");
exit();
?>