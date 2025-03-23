<?php

$host = 'localhost';       
$dbname = 'RESTful_API';  
$username = 'root';       
$password = '';          
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "Database connection successful!"; 
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
