<?php
session_start();
include 'db.php';

header("Content-Type: application/json");

if (!isset($_SESSION['phone'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$orderId = intval($_GET['order_id'] ?? 0);
$userPhone = $_SESSION['phone'];

$stmt = $conn->prepare("SELECT agent_id FROM orders WHERE id = ? AND user_phone = ?");
$stmt->bind_param("is", $orderId, $userPhone);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order || empty($order['agent_id'])) {
    http_response_code(404);
    echo json_encode(["error" => "Location unavailable"]);
    exit();
}

$stmt = $conn->prepare("SELECT lat, lng FROM delivery_agents WHERE id = ?");
$stmt->bind_param("i", $order['agent_id']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    http_response_code(404);
    echo json_encode(["error" => "Location unavailable"]);
    exit();
}

echo json_encode([
    "lat" => $row['lat'],
    "lng" => $row['lng']
]);
?>
