<?php
require 'jwt_middleware.php';
require 'db_connection.php';
header('Content-Type: application/json');
$pid = $_GET['pid'];

$raw_input = file_get_contents("php://input");
$data = json_decode($raw_input, true);

if (!isset($data['pname']) || !isset($data['description']) || !isset($data['price']) || !isset($data['stock'])) {
    http_response_code(400);
    die(json_encode(["message" => "Missing required fields"]));
}

$pname = $data['pname'];
$description = $data['description'];
$price = $data['price'];
$stock = $data['stock'];

try {
    $stmt = $conn->prepare("UPDATE Products SET pname = ?, description = ?, price = ?, stock = ? WHERE pid = ?");
    $stmt->bindParam(1, $pname);
    $stmt->bindParam(2, $description);
    $stmt->bindParam(3, $price);
    $stmt->bindParam(4, $stock);
    $stmt->bindParam(5, $pid);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Product updated successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to update product"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Database error: " . $e->getMessage()]);
}
?>
