<?php
session_start();
include 'db.php';

if (!isset($_SESSION['agent'])) {
    header("Location: agent_login.php");
    exit();
}

$phone = $_SESSION['agent'];
$stmt = $conn->prepare("
    SELECT o.id, o.address, o.status
    FROM orders o
    INNER JOIN delivery_agents d ON d.id = o.agent_id
    WHERE d.phone = ?
    ORDER BY o.id DESC
");
$stmt->bind_param("s", $phone);
$stmt->execute();
$orders = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Delivery Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Delivery Panel</h3>
        <button class="btn btn-success" onclick="startTracking()">Start Live Tracking</button>
    </div>

    <?php if ($orders->num_rows === 0) { ?>
        <div class="alert alert-info">No orders assigned right now.</div>
    <?php } else { ?>
        <div class="row g-3">
            <?php while ($order = $orders->fetch_assoc()) { ?>
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Order #<?php echo (int) $order['id']; ?></h5>
                            <p class="card-text mb-2"><?php echo htmlspecialchars($order['address']); ?></p>
                            <p class="text-muted">Status: <?php echo htmlspecialchars($order['status']); ?></p>
                            <a class="btn btn-primary btn-sm" href="update_status.php?order_id=<?php echo (int) $order['id']; ?>&status=Out%20for%20Delivery">Start Delivery</a>
                            <a class="btn btn-success btn-sm" href="update_status.php?order_id=<?php echo (int) $order['id']; ?>&status=Delivered">Mark Delivered</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<script>
function startTracking() {
    if (!navigator.geolocation) {
        alert("Geolocation is not supported on this device.");
        return;
    }

    navigator.geolocation.watchPosition(position => {
        fetch("update_location.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            })
        });
    });
}
</script>
</body>
</html>
