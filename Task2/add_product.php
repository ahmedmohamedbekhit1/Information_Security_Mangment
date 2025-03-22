<?php
header('Content-Type: application/json'); // ✅ Fix for content-type mismatch

require 'jwt_middleware.php';
require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$pname = $data['pname'];
$description = $data['description'];
$price = $data['price'];
$stock = $data['stock'];

$stmt = $conn->prepare("INSERT INTO Products (pname, description, price, stock) VALUES (?, ?, ?, ?)");
$stmt->bindParam(1, $pname);
$stmt->bindParam(2, $description);
$stmt->bindParam(3, $price);
$stmt->bindParam(4, $stock);

if ($stmt->execute()) {
    echo json_encode(["message" => "Product added successfully"]);
} else {
    echo json_encode(["message" => "Failed to add product"]);
}
?>
