<?php
include 'db.php';

$order_id = $_GET['id'];

$result = mysqli_query($conn, "SELECT status FROM orders WHERE id=$order_id");
$row = mysqli_fetch_assoc($result);

if($row['status'] == "Delivered"){
    echo "<script>alert('❌ No return/refund allowed after delivery'); window.history.back();</script>";
    exit();
}

// Allow cancel if not delivered
mysqli_query($conn, "DELETE FROM orders WHERE id=$order_id");

echo "<script>alert('Order Cancelled'); window.location='index.php';</script>";
?>