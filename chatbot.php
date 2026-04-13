<?php
header("Content-Type: application/json");

// 1. Get the raw POST data
$content = file_get_contents("php://input");

// 2. Decode the JSON into a PHP array
$decoded = json_decode($content, true);

// 3. Extract the message safely
$message = isset($decoded['message']) ? strtolower(trim($decoded['message'])) : "";

if (empty($message)) {
    echo json_encode(["reply" => "I'm listening! Ask me about crops, waste, or prices. 🌾"]);
    exit;
}

$response = "Sorry, I didn't understand that. Try asking about crops, waste, or prices! 🌱";

// 4. Knowledge Base logic
$faq = [
    "waste" => "Agricultural waste can be used for compost, biogas, and organic fertilizer 🌿",
    "crop"  => "Use quality seeds, proper irrigation, and soil testing for better crop yield 🌾",
    "price" => "You can check latest crop prices in our market section! 📊",
    "market" => "Sell directly on FarmConnect to skip the middlemen. 🛒"
];

foreach ($faq as $keyword => $answer) {
    if (strpos($message, $keyword) !== false) {
        $response = $answer;
        break;
    }
}

// 5. Always return a JSON object
echo json_encode(["reply" => $response]);
?>