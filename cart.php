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

<table class="table table-bordered text-center mt-4">
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>

<?php
$totalAmount = 0;
$result = mysqli_query($conn, "SELECT * FROM cart");

while($row = mysqli_fetch_assoc($result)){
    $total = $row['price'] * $row['quantity'];
    $totalAmount += $total;

    echo "<tr>
        <td>{$row['product_name']}</td>
        <td>₹{$row['price']}</td>
        <td>
            <a href='update_qty.php?id={$row['id']}&action=decrease' class='btn btn-danger btn-sm'>-</a>
            {$row['quantity']}
            <a href='update_qty.php?id={$row['id']}&action=increase' class='btn btn-success btn-sm'>+</a>
        </td>
        <td>₹{$total}</td>
    </tr>";
}
?>

<tr>
    <td colspan="3"><strong>Total Amount</strong></td>
    <td><strong>₹<?php echo $totalAmount; ?></strong></td>
</tr>

</table>
<a href="index.php" class="btn btn-outline-secondary">Continue Shopping</a>

<form action="place_order.php" method="POST" style="display:inline;">
    <button class="btn btn-success">Place Order</button>
</form>

</div>

</body>
<form action="place_order.php" method="POST">
    <button class="btn btn-success mt-3">Place Order</button>
</form>
</html>
