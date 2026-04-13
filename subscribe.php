<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['phone'])) {
    $consumer_phone = $_SESSION['phone'];
    $farmer_phone = $_POST['farmer_phone']; 
    $plan = $_POST['plan']; 
    $pay_method = $_POST['pay_method']; // Get the selected payment method
    
    $start_date = date('Y-m-d');
    $end_date = ($plan == 'Weekly') ? date('Y-m-d', strtotime('+7 days')) : date('Y-m-d', strtotime('+30 days'));

    $query = "INSERT INTO subscriptions (farmer_phone, consumer_phone, plan, start_date, end_date, status, payment_method) 
              VALUES ('$farmer_phone', '$consumer_phone', '$plan', '$start_date', '$end_date', 'Active', '$pay_method')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Payment Successful via $pay_method! Subscription Active.'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>