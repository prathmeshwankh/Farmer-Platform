<?php
include 'db.php';
$name = $_POST['name'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$product = $_POST['product'];

$sql = "INSERT INTO farmers (name, phone, location, product)
        VALUES ('$name', '$phone', '$location', '$product')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Registration Successful');
        window.location.href='index.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
