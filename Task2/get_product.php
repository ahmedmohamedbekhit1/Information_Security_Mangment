<?php
require 'jwt_middleware.php';
require 'db_connection.php';
header('Content-Type: application/json');
$pid = $_GET['pid'];
try {
    $stmt = $conn->prepare("SELECT * FROM Products WHERE pid = ?");
    $stmt->bindParam(1, $pid);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        http_response_code(404); 
        echo json_encode(["message" => "Product not found"]);
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
}
?>
