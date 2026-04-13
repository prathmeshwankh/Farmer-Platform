<?php
session_start();
include 'db.php';

// 🔐 Protect page
if(!isset($_SESSION['phone'])){
    header("Location: farmer_login.php");
    exit();
}

// 🔹 Get ID safely
$id = $_GET['id'] ?? 0;

// 🔍 Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    echo "Product not found";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  background: #f5f7fa;
  font-family: 'Poppins', sans-serif;
}

.form-box {
  background: white;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}
</style>
</head>

<body class="p-4">

<div class="container" style="max-width:500px;">

  <h3 class="text-center mb-4">✏️ Edit Product</h3>

  <div class="form-box">

    <form action="update_product.php" method="POST">

      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <input type="text" name="product_name" 
             value="<?php echo $row['product_name']; ?>" 
             class="form-control mb-3" placeholder="Product Name" required>

      <input type="number" name="price" 
             value="<?php echo $row['price']; ?>" 
             class="form-control mb-3" placeholder="Price" required>

      <input type="text" name="unit" 
             value="<?php echo $row['unit']; ?>" 
             class="form-control mb-3" placeholder="Unit (kg, L, etc)" required>

      <button class="btn btn-success w-100">Update Product</button>

    </form>

    <a href="add_product.php" class="btn btn-secondary w-100 mt-2">← Back</a>

  </div>

</div>

</body>
</html>