<?php
// Include database connection file
require_once 'config.php';

function getDbConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Connect to the database
$pdo = getDbConnection();

try {
    // Query to retrieve data from the info table
    $stmt = $pdo->prepare("SELECT username, password, Email FROM info");
    $stmt->execute();
    
    // Fetch data as associative array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
