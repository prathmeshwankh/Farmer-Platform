<?php
session_start();
include 'db.php';

if (!isset($_SESSION['phone'])) {
    header("Location: farmer_login.php");
    exit();
}

$user = $_SESSION['phone'];
$address = trim($_POST['address'] ?? '');
$payment = trim($_POST['payment'] ?? '');

if ($address === '' || $payment === '') {
    echo "<script>alert('Please enter delivery details'); window.history.back();</script>";
    exit();
}

$cartStmt = $conn->prepare("SELECT product_name, price, quantity FROM cart WHERE user_phone = ?");
$cartStmt->bind_param("s", $user);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();

if ($cartResult->num_rows === 0) {
    echo "<script>alert('Your cart is empty'); window.location='cart.php';</script>";
    exit();
}

$agentResult = mysqli_query($conn, "SELECT id FROM delivery_agents ORDER BY id ASC LIMIT 1");
$agentData = $agentResult ? mysqli_fetch_assoc($agentResult) : null;
$agentId = $agentData['id'] ?? null;
$status = 'Pending';

mysqli_begin_transaction($conn);

try {
    if ($agentId === null) {
        $orderStmt = $conn->prepare("
            INSERT INTO orders (user_phone, address, payment_method, status)
            VALUES (?, ?, ?, ?)
        ");
        $orderStmt->bind_param("ssss", $user, $address, $payment, $status);
    } else {
        $orderStmt = $conn->prepare("
            INSERT INTO orders (user_phone, address, payment_method, status, agent_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $orderStmt->bind_param("ssssi", $user, $address, $payment, $status, $agentId);
    }
    $orderStmt->execute();

    $orderId = mysqli_insert_id($conn);

    $itemStmt = $conn->prepare("
        INSERT INTO order_items (order_id, product_name, price, quantity)
        VALUES (?, ?, ?, ?)
    ");

    while ($row = mysqli_fetch_assoc($cartResult)) {
        $itemStmt->bind_param("isdi", $orderId, $row['product_name'], $row['price'], $row['quantity']);
        $itemStmt->execute();
    }

    $clearStmt = $conn->prepare("DELETE FROM cart WHERE user_phone = ?");
    $clearStmt->bind_param("s", $user);
    $clearStmt->execute();

    mysqli_commit($conn);
} catch (Throwable $e) {
    mysqli_rollback($conn);
    echo "<script>alert('Unable to place order right now'); window.location='cart.php';</script>";
    exit();
}

echo "<script>
alert('Order placed successfully');
window.location='track_order.php?id=$orderId';
</script>";
?>
