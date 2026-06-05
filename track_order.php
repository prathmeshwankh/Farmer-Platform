<?php
session_start();
include 'db.php';

$order_id = intval($_GET['id'] ?? 0);

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

$userPhone = $_SESSION['phone'];

$orderStmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_phone = ?");
$orderStmt->bind_param("is", $order_id, $userPhone);
$orderStmt->execute();
$orderData = $orderStmt->get_result()->fetch_assoc();

if (!$orderData) {
    echo "<script>alert('Order not found'); window.location='index.php';</script>";
    exit();
}

$itemStmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$itemStmt->bind_param("i", $order_id);
$itemStmt->execute();
$items = $itemStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Track Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f5f7fa;
    font-family: 'Poppins', sans-serif;
}

.card-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    margin-bottom: 20px;
}

.step {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.circle {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #ccc;
    margin-right: 10px;
}

.active {
    background: #28a745;
}

#map {
    height: 350px;
    border-radius: 15px;
}

.live {
    color: red;
    font-weight: bold;
    animation: blink 1s infinite;
}

@keyframes blink {
    50% { opacity: 0.5; }
}
</style>

</head>

<body class="p-3">

<div class="container">

<h3 class="text-center mb-3">Order Tracking</h3>

<div class="card-box">
    <h5>Order ID: <?php echo $order_id; ?></h5>
    <p>Address: <?php echo htmlspecialchars($orderData['address']); ?></p>
    <p>Payment: <?php echo htmlspecialchars($orderData['payment_method']); ?></p>
    <p>Status: <b class="text-success"><?php echo htmlspecialchars($orderData['status']); ?></b></p>
</div>

<div class="card-box">
    <h5>Items</h5>

    <?php while($row = mysqli_fetch_assoc($items)){ ?>
        <p>
            <b><?php echo htmlspecialchars($row['product_name']); ?></b>
            - Rs <?php echo htmlspecialchars($row['price']); ?> x <?php echo htmlspecialchars($row['quantity']); ?>
        </p>
    <?php } ?>
</div>

<div class="card-box">
    <h5>Delivery Status</h5>

    <div class="step">
        <div class="circle active"></div> Order Placed
    </div>

    <div class="step">
        <div class="circle <?php if($orderData['status'] !== 'Pending') echo 'active'; ?>"></div> Packed
    </div>

    <div class="step">
        <div class="circle <?php if($orderData['status'] === 'Out for Delivery' || $orderData['status'] === 'Delivered') echo 'active'; ?>"></div> Out for Delivery
    </div>

    <div class="step">
        <div class="circle <?php if($orderData['status'] === 'Delivered') echo 'active'; ?>"></div> Delivered
    </div>
</div>

<div class="card-box">
    <h5>Live Tracking <span class="live">LIVE</span></h5>
    <div id="map"></div>
</div>

</div>

<script>
let map;
let marker;

function initMap() {
    let defaultLocation = { lat: 21.1458, lng: 79.0882 };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: defaultLocation
    });

    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map
    });
}

function updateLocation(lat, lng){
    let pos = { lat: lat, lng: lng };
    marker.setPosition(pos);
    map.setCenter(pos);
}

setInterval(() => {
    fetch("get_location.php?order_id=<?php echo $order_id; ?>")
    .then(res => res.json())
    .then(data => {
        if(data.lat && data.lng){
            updateLocation(parseFloat(data.lat), parseFloat(data.lng));
        }
    })
    .catch(() => {});
}, 5000);
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyXXXXXXX&callback=initMap"></script>

</body>
</html>
