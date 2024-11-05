<?php
$dsn = "mysql:host=localhost;dbname=my1stdatabase";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO($dsn, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}