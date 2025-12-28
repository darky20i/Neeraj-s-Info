<?php
header("Content-Type: application/json");

// ===== API CONFIG =====
$API_KEY  = "peasa";
$API_BASE = "https://mafia-api.site/api/api.php";
// ======================

// Read input
$data = json_decode(file_get_contents("php://input"), true);
$type  = $data['type'] ?? '';
$value = $data['value'] ?? '';

if (!$value) {
    echo json_encode([
        "status" => "error",
        "message" => "No input provided"
    ]);
    exit;
}

// Build API URL
$api_url = $API_BASE . "?key=" . urlencode($API_KEY) . "&num=" . urlencode($value);

// cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode([
        "status" => "error",
        "message" => "API request failed"
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Try decode JSON
$apiData = json_decode($response, true);

// If API returns plain text
if ($apiData === null) {
    echo json_encode([
        "status" => "success",
        "type" => $type,
        "input" => $value,
        "api_response" => [
            "response" => $response
        ]
    ]);
    exit;
}

// Final response
echo json_encode([
    "status" => "success",
    "type" => $type,
    "input" => $value,
    "api_response" => $apiData
]);
