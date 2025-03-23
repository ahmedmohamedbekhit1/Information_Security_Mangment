<?php
require 'db_connection.php';
require 'jwt_auth.php'; 
$raw_input = file_get_contents("php://input");

if (empty($raw_input)) {
    http_response_code(400);
    die(json_encode(["message" => "No input data received"]));
}

$data = json_decode($raw_input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); 
    die(json_encode(["message" => "Invalid JSON input"]));
}

if (!isset($data['username']) || !isset($data['password'])) {
    http_response_code(400); 
    die(json_encode(["message" => "Missing required fields"]));
}

$username = $data['username'];
$password = $data['password'];

try {
    $stmt = $conn->prepare("SELECT id, password FROM Users WHERE username = ?");
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $token = generate_jwt($user['id']);
        echo json_encode(["token" => $token]);
    } else {
        http_response_code(401); 
        echo json_encode(["message" => "Invalid credentials"]);
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
}
?>
