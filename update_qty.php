<?php
include 'db.php';

// Validate inputs
if(!isset($_GET['id']) || !isset($_GET['action'])){
    header("Location: cart.php");
    exit();
}

$id = intval($_GET['id']);
$action = $_GET['action'];

if($action == "increase"){

    mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity + 1 
        WHERE id=$id
    ");

}

elseif($action == "decrease"){

    mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity - 1 
        WHERE id=$id AND quantity > 1
    ");

}

// Redirect back
header("Location: cart.php");
exit();
?>