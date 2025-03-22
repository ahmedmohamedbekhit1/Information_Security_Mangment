<?php
require 'db_connection.php';

// Debug: Check if JSON input is received
$raw_input = file_get_contents("php://input");
if (empty($raw_input)) {
    die(json_encode(["message" => "No input data received"]));
}

// Debug: Print the raw input for inspection
echo "Raw Input: " . $raw_input . "\n";

// Decode the JSON input
$data = json_decode($raw_input, true);

// Debug: Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(["message" => "Invalid JSON input"]));
}

// Debug: Print the decoded data for inspection
echo "Decoded Data: ";
print_r($data);

// Extract data from the decoded JSON
$name = $data['name'];
$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO Users (name, username, password) VALUES (?, ?, ?)");
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $username);
$stmt->bindParam(3, $password);

if ($stmt->execute()) {
    echo json_encode(["message" => "User registered successfully"]);
} else {
    echo json_encode(["message" => "Registration failed"]);
}
?>