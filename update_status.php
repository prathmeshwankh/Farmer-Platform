<?php
session_start();
include 'db.php';

if (!isset($_SESSION['agent'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit("Unauthorized");
}

$status = trim($_GET['status'] ?? '');
$orderId = intval($_GET['order_id'] ?? 0);
$phone = $_SESSION['agent'];
$allowedStatuses = ['Out for Delivery', 'Delivered'];

if (!in_array($status, $allowedStatuses, true) || $orderId <= 0) {
    header("HTTP/1.1 422 Unprocessable Entity");
    exit("Invalid request");
}

$agentStmt = $conn->prepare("SELECT id FROM delivery_agents WHERE phone = ?");
$agentStmt->bind_param("s", $phone);
$agentStmt->execute();
$agent = $agentStmt->get_result()->fetch_assoc();

if (!$agent) {
    header("HTTP/1.1 403 Forbidden");
    exit("Invalid agent");
}

$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ? AND agent_id = ?");
$stmt->bind_param("sii", $status, $orderId, $agent['id']);
$stmt->execute();

header("Location: agent_panel.php");
exit();
?>
