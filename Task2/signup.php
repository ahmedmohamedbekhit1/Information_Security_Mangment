<?php
require 'db_connection.php';
$raw_input = file_get_contents("php://input");
if (empty($raw_input)) {
    die(json_encode(["message" => "No input data received"]));
}

echo "Raw Input: " . $raw_input . "\n";

$data = json_decode($raw_input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(["message" => "Invalid JSON input"]));
}
echo "Decoded Data: ";
print_r($data);
$name = $data['name'];
$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);
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
