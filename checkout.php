<form action="place_order.php" method="POST">

<h3>Checkout Details</h3>

<input type="text" name="address" placeholder="Delivery Address" required class="form-control mb-2">

<textarea name="requirements" placeholder="Special Requirements" class="form-control mb-2"></textarea>

<select name="payment_mode" class="form-control mb-2" required>
    <option value="COD">Cash on Delivery</option>
    <option value="UPI">UPI</option>
    <option value="Card">Card Payment</option>
</select>

<button class="btn btn-success w-100">Place Order</button>

</form>