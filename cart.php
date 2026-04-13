<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>My Basket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<div class="container">

<h2 class="text-center">🛒 My Basket</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM cart");

if(mysqli_num_rows($result) == 0){
    echo "<p class='text-center mt-4'>Your cart is empty 🛒</p>";
} else {
?>

<table class="table table-bordered text-center mt-4">
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php
$totalAmount = 0;

while($row = mysqli_fetch_assoc($result)){
    $total = $row['price'] * $row['quantity'];
    $totalAmount += $total;
?>

<tr>
    <td><?php echo $row['product_name']; ?></td>

    <td>₹<?php echo $row['price']; ?></td>

    <td>
        <a href='update_qty.php?id=<?php echo $row['id']; ?>&action=decrease' class='btn btn-danger btn-sm'>-</a>
        <?php echo $row['quantity']; ?>
        <a href='update_qty.php?id=<?php echo $row['id']; ?>&action=increase' class='btn btn-success btn-sm'>+</a>
    </td>

    <td>₹<?php echo $total; ?></td>

    <td>
        <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>" 
           class="btn btn-warning btn-sm"
           onclick="return confirm('Remove this item?')">
           Remove
        </a>
    </td>
</tr>

<?php } ?>

<tr>
    <td colspan="3"><strong>Total Amount</strong></td>
    <td colspan="2"><strong>₹<?php echo $totalAmount; ?></strong></td>
</tr>

</table>

<!-- Buttons -->
<a href="index.php" class="btn btn-outline-secondary">Continue Shopping</a>

<form action="place_order.php" method="POST" style="display:inline;">
    <button class="btn btn-success">Place Order</button>
</form>

<?php } ?>

</div>

</body>
</html>