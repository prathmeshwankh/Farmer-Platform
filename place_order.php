<?php
include 'db.php';

// Get cart items
$result = mysqli_query($conn, "SELECT * FROM cart");

if(mysqli_num_rows($result) == 0){
    echo "<script>
        alert('Cart is empty!');
        window.location.href='cart.php';
    </script>";
    exit();
}

$success = true;

// Loop through cart
while($row = mysqli_fetch_assoc($result)){

    $product = mysqli_real_escape_string($conn, $row['product_name']);
    $price = floatval($row['price']);
    $qty = intval($row['quantity']);
    $total = $price * $qty;
    $address = $_POST['address'];
$payment = $_POST['payment_mode'];
$req = $_POST['requirements'];

    $sql = "INSERT INTO orders (product_name, price, quantity, total)
            VALUES ('$product', '$price', '$qty', '$total')";

    if(!mysqli_query($conn, $sql)){
        $success = false;
        break;
    }
}

// Only clear cart if everything is successful
if($success){
    mysqli_query($conn, "DELETE FROM cart");

    echo "<script>
        alert('✅ Order Placed Successfully!');
        window.location.href='index.php';
    </script>";
} else {
    echo "<script>
        alert('❌ Order failed. Please try again.');
        window.location.href='cart.php';
    </script>";
}
?>