<?php
session_start();
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $phone = trim($_POST['phone']);

    // 🔹 Validation
    if(empty($phone)){
        echo "<script>alert('Enter mobile number'); window.history.back();</script>";
        exit();
    }

    if(strlen($phone) != 10 || !is_numeric($phone)){
        echo "<script>alert('Enter valid 10-digit mobile number'); window.history.back();</script>";
        exit();
    }

    // 🔍 Secure query (Prepared Statement)
    $stmt = $conn->prepare("SELECT * FROM farmers WHERE phone=?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        // 🔐 Session
        $_SESSION['farmer_name'] = $row['name'];
        $_SESSION['phone'] = $row['phone'];

        echo "<script>
            alert('✅ Login Successful');
            window.location='add_product.php';
        </script>";

    } else {

        echo "<script>
            alert('❌ Farmer not registered. Please register first.');
            window.location='farmer_register.php';
        </script>";
    }
}
?>
