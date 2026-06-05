<?php
session_start();
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // 🔹 Get & clean data
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);

    // 🔹 Validation
    if(empty($name) || empty($phone) || empty($location)){
        echo "<script>alert('All fields are required'); window.history.back();</script>";
        exit();
    }

    if(!preg_match('/^[0-9]{10}$/', $phone)){
        echo "<script>alert('Enter valid 10-digit mobile number'); window.history.back();</script>";
        exit();
    }

    // 🔍 Check duplicate phone
    $stmt = $conn->prepare("SELECT id FROM farmers WHERE phone=?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        echo "<script>
            alert('⚠️ Farmer already registered! Please login.');
            window.location='farmer_login.php';
        </script>";
        exit();

    } else {

        // ✅ Insert farmer
        $stmt = $conn->prepare("INSERT INTO farmers (name, phone, location) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $phone, $location);

        if($stmt->execute()){

            // 🔐 AUTO LOGIN SESSION
            $_SESSION['phone'] = $phone;
            $_SESSION['farmer_name'] = $name;

            echo "<script>
                alert('✅ Registration Successful');
                window.location='add_product.php';
            </script>";
            exit();

        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>