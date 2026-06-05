<?php
session_start();
include 'db.php';

$phone = $_POST['phone'];

$result = mysqli_query($conn, "SELECT * FROM delivery_agents WHERE phone='$phone'");

if(mysqli_num_rows($result) > 0){
    $_SESSION['agent'] = $phone;
    header("Location: agent_panel.php");
} else {
    echo "Invalid login";
}
?>