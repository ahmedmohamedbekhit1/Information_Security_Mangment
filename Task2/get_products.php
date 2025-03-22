<?php
require 'jwt_middleware.php'; // Include the JWT middleware
require 'db_connection.php';

$stmt = $conn->query("SELECT * FROM Products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>