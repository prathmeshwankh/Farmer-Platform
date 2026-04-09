<?php
include 'db.php';
session_start();

$phone = $_POST['phone'];

// Check if farmer exists
$result = mysqli_query($conn, "SELECT * FROM farmers WHERE phone='$phone'");

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

    // Save session
    $_SESSION['farmer_name'] = $row['name'];
    $_SESSION['phone'] = $row['phone'];

    echo "<script>
        alert('Login Successful');
        window.location='add_product.php';
    </script>";
} else {
    echo "<script>
        alert('❌ Farmer not registered. Please register first.');
        window.location='farmer_register.php';
    </script>";
}
?>
