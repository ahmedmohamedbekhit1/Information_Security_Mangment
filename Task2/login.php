<?php
require 'db_connection.php';
require 'jwt_auth.php'; // Include the JWT authentication script

// Get the raw input
$raw_input = file_get_contents("php://input");

// Debug: Check if JSON input is received
if (empty($raw_input)) {
    http_response_code(400); // Bad Request
    die(json_encode(["message" => "No input data received"]));
}

// Decode the JSON input
$data = json_decode($raw_input, true);

// Debug: Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    die(json_encode(["message" => "Invalid JSON input"]));
}

// Debug: Check if required fields are present
if (!isset($data['username']) || !isset($data['password'])) {
    http_response_code(400); // Bad Request
    die(json_encode(["message" => "Missing required fields"]));
}

// Extract data from the decoded JSON
$username = $data['username'];
$password = $data['password'];

// Prepare and execute the SQL statement
try {
    $stmt = $conn->prepare("SELECT id, password FROM Users WHERE username = ?");
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debug: Check if user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        $token = generate_jwt($user['id']); // Generate a JWT token
        echo json_encode(["token" => $token]);
    } else {
        http_response_code(401); // Unauthorized
        echo json_encode(["message" => "Invalid credentials"]);
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
}
?>