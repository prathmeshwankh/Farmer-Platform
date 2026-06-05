<?php
header("Content-Type: application/json");

// 1. Get raw JSON data
$content = file_get_contents("php://input");

// 2. Decode JSON safely
$decoded = json_decode($content, true);

// 3. Get message
$message = isset($decoded['message']) ? strtolower(trim($decoded['message'])) : "";

// 4. Default response
if (empty($message)) {
    echo json_encode([
        "reply" => "I'm listening! Ask me about crops, waste, or prices. 🌾"
    ]);
    exit;
}

$response = "❌ Sorry, I didn't understand. Try: crop, waste, price, market 🌱";

// 5. Knowledge base (FAQ system)
$faq = [
    "waste"  => "🌿 Agricultural waste can be used for compost, biogas, and organic fertilizer.",
    "crop"   => "🌾 Use quality seeds, proper irrigation, and soil testing for better crop yield.",
    "price"  => "📊 You can check latest crop prices in our marketplace section.",
    "market" => "🛒 Sell directly on FarmConnect to avoid middlemen and earn more profit."
];

// 6. Match keywords
foreach ($faq as $keyword => $answer) {
    if (strpos($message, $keyword) !== false) {
        $response = $answer;
        break;
    }
}

// 7. Return JSON response
echo json_encode(["reply" => $response]);
?>