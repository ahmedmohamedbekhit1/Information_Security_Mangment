<?php
// Include all required JWT library files
require_once 'JWT/JWTExceptionWithPayloadInterface.php';
require_once 'JWT/BeforeValidException.php';
require_once 'JWT/ExpiredException.php';
require_once 'JWT/SignatureInvalidException.php';
require_once 'JWT/Key.php';
require_once 'JWT/JWT.php';





// Retrieve the secret key from environment variables
$secret_key = getenv('JWT_SECRET_KEY');
if (!$secret_key) {
    die("JWT secret key is not set in the environment variables.");
}

/**
 * Generate a JWT token for a user
 */
function generate_jwt($user_id) {
    global $secret_key;
    $payload = [
        "iss" => "your_issuer",       // Issuer
        "aud" => "your_audience",     // Audience
        "iat" => time(),              // Issued at
        "exp" => time() + 600,        // Expiration time (10 minutes)
        "user_id" => $user_id         // Custom claim
    ];
    return JWT::encode($payload, $secret_key, 'HS256');
}

/**
 * Validate a JWT token
 */
function validate_jwt($token) {
    global $secret_key;
    try {
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $decoded->user_id; // Return the user ID from the token
    } catch (Exception $e) {
        return false; // Token is invalid
    }
}
?>