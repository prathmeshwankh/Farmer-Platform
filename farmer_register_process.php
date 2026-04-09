<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $product = $_POST['product'];

    // 🔍 CHECK IF PHONE ALREADY EXISTS
    $check = mysqli_query($conn, "SELECT * FROM farmers WHERE phone='$phone'");

    if(mysqli_num_rows($check) > 0){
        // ❌ Already registered
        echo "<script>
            alert('⚠️ Farmer already registered with this mobile number!');
            window.location='farmer_register.php';
        </script>";
    } else {
        // ✅ Insert new farmer
        $sql = "INSERT INTO farmers (name, phone, location, product)
                VALUES ('$name', '$phone', '$location', '$product')";

        if(mysqli_query($conn, $sql)){
            echo "<script>
                alert('✅ Registration Successful');
                window.location='add_product.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
