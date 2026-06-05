<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);
$phone = $_SESSION['phone'];

$stmt = $conn->prepare("SELECT id, product_name, price, unit, description FROM products WHERE id = ? AND farmer_phone = ?");
$stmt->bind_param("is", $id, $phone);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "<script>alert('Product not found'); window.location='add_product.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container" style="max-width: 720px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Edit Product</h2>

            <form action="update_product.php" method="POST">
                <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">

                <input type="text" name="product_name" class="form-control mb-3" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

                <input type="number" step="0.01" name="price" class="form-control mb-3" value="<?php echo htmlspecialchars($product['price']); ?>" required>

                <input type="text" name="unit" class="form-control mb-3" value="<?php echo htmlspecialchars($product['unit']); ?>" required>

                <textarea name="description" class="form-control mb-3" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>

                <button class="btn btn-success">Save Changes</button>
                <a href="add_product.php" class="btn btn-outline-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
