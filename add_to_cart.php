<?php
include 'db.php';

$product = $_POST['product_name'];
$price = $_POST['price'];

// Check if product already in cart
$check = mysqli_query($conn, "SELECT * FROM cart WHERE product_name='$product'");

if(mysqli_num_rows($check) > 0){
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE product_name='$product'");
} else {
    mysqli_query($conn, "INSERT INTO cart (product_name, price) VALUES ('$product', '$price')");
}

// Redirect to basket page
header("Location: cart.php");
exit();
?>
