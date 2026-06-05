<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

$id = intval($_POST['id'] ?? 0);
$name = trim($_POST['product_name'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$unit = trim($_POST['unit'] ?? '');
$description = trim($_POST['description'] ?? '');
$phone = $_SESSION['phone'];

if ($id <= 0 || $name === '' || $unit === '' || $price <= 0) {
    echo "<script>
        alert('Please fill all required fields');
        window.history.back();
    </script>";
    exit();
}

$stmt = $conn->prepare("
    UPDATE products
    SET product_name = ?, price = ?, unit = ?, description = ?
    WHERE id = ? AND farmer_phone = ?
");
$stmt->bind_param("sdssis", $name, $price, $unit, $description, $id, $phone);

if ($stmt->execute()) {
    echo "<script>
        alert('Product updated successfully');
        window.location='add_product.php';
    </script>";
} else {
    echo "<script>
        alert('Error updating product');
        window.history.back();
    </script>";
}
?>
