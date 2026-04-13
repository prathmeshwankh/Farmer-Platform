<?php
include 'db.php';

// Get inputs safely
$id = intval($_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['product_name']);
$price = floatval($_POST['price']);
$unit = mysqli_real_escape_string($conn, $_POST['unit']);

// Validation
if(empty($id) || empty($name) || empty($unit)){
    echo "<script>
        alert('Please fill all required fields');
        window.history.back();
    </script>";
    exit();
}

// Update query
mysqli_query($conn, "
UPDATE products 
SET product_name='$name', price='$price'
WHERE id=$id AND farmer_phone='$phone'
");

if(mysqli_query($conn, $sql)){
    echo "<script>
        alert('Product Updated Successfully 🌾');
        window.location='add_product.php';
    </script>";
} else {
    echo "<script>
        alert('Error updating product');
        window.history.back();
    </script>";
}
?>