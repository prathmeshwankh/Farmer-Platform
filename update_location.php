<?php
session_start();
include 'db.php';

header("Content-Type: application/json");

if (!isset($_SESSION['agent'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$lat = isset($data['lat']) ? floatval($data['lat']) : null;
$lng = isset($data['lng']) ? floatval($data['lng']) : null;
$phone = $_SESSION['agent'];

if ($lat === null || $lng === null) {
    http_response_code(422);
    echo json_encode(["error" => "Invalid coordinates"]);
    exit();
}

$stmt = $conn->prepare("UPDATE delivery_agents SET lat = ?, lng = ? WHERE phone = ?");
$stmt->bind_param("dds", $lat, $lng, $phone);
$stmt->execute();

echo json_encode(["success" => true]);
?>
