<?php
require 'jwt_auth.php'; // Include the JWT authentication script

$headers = getallheaders();
if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $user_id = validate_jwt($token); // Validate the token
    if ($user_id) {
        // Token is valid, proceed with the request
        $GLOBALS['user_id'] = $user_id;
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Unauthorized"]);
        exit;
    }
} else {
    http_response_code(401);
    echo json_encode(["message" => "No token provided"]);
    exit;
}
?>