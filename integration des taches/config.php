<?php

try {
    $dsn = 'mysql:host=localhost;dbname=shop_db;charset=utf8';
    $username = 'root';
    $password = '';

    // Create a PDO instance (connect to the database)
    $conn = new PDO($dsn, $username, $password);

    // Set PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection successful";
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}

?>
