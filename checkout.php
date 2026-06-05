<?php
session_start();

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container" style="max-width: 640px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-3">Checkout Details</h3>

            <form action="place_order.php" method="POST">
                <input type="text" name="address" placeholder="Delivery Address" required class="form-control mb-3">

                <textarea name="requirements" placeholder="Special Requirements" class="form-control mb-3"></textarea>

                <select name="payment" class="form-control mb-3" required>
                    <option value="COD">Cash on Delivery</option>
                    <option value="UPI">UPI</option>
                    <option value="Card">Card Payment</option>
                </select>

                <button class="btn btn-success w-100">Place Order</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
