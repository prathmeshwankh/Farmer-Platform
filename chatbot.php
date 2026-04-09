<?php
$data = json_decode(file_get_contents("php://input"), true);
$message = strtolower($data['message']);

$response = "I didn't understand.";

if(strpos($message, "waste") !== false){
    $response = "Agricultural waste can be used for compost, biogas, or fertilizer.";
}
elseif(strpos($message, "crop") !== false){
    $response = "Use good seeds and irrigation for better crop yield.";
}
elseif(strpos($message, "price") !== false){
    $response = "Check marketplace for latest prices.";
}

echo json_encode(["reply" => $response]);
?>
