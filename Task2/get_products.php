<?php
require 'jwt_middleware.php'; 
require 'db_connection.php';
header('Content-Type: application/json');
try {
    $stmt = $conn->query("SELECT * FROM Products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
}
?>
