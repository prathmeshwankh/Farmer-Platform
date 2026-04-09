<?php
include 'db.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<form action="update_product.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" class="form-control mb-2">

<input type="number" name="price" value="<?php echo $row['price']; ?>" class="form-control mb-2">

<input type="text" name="unit" value="<?php echo $row['unit']; ?>" class="form-control mb-2">

<button class="btn btn-success">Update</button>
</form>
