<?php
include 'db.php';

// Get & sanitize input
$product = mysqli_real_escape_string($conn, $_POST['product_name']);
$price = floatval($_POST['price']);

// Check if product already exists
$check = mysqli_query($conn, "SELECT * FROM cart WHERE product_name='$product'");

if(mysqli_num_rows($check) > 0){

    // Increase quantity
    mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity + 1 
        WHERE product_name='$product'
    ");

} else {

    // Insert new item with quantity = 1
    mysqli_query($conn, "
        INSERT INTO cart (product_name, price, quantity) 
        VALUES ('$product', '$price', 1)
    ");
}

// Redirect
header("Location: cart.php");
exit();
?>