<?php

$host = "localhost";
$dbname = "myproject";
$username = "root";
$password = "";


$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    
    $conn = new PDO($dsn, $username, $password);
    
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
