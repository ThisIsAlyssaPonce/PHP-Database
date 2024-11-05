<?php
session_start();
require_once 'db_connection.php'; // Include the database connection file

// Disable error reporting
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password']; // Get password from the form (consider hashing it)

    if ($email === false) {
        echo "Invalid email format.";
    } else {
        // Insert data into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO info (username, password, Email) VALUES (?, ?, ?)");
            $stmt->execute([$username, $password, $email]); // Execute with parameters

            // Set session and cookies
            $_SESSION['username'] = $username; // Store username in session
            setcookie("username", $username, time() + 3600, "/"); // Cookie for username
            setcookie("email", $email, time() + 3600, "/"); // Cookie for email

            echo "Information submitted successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <h5>Meet our Group :)</h5>
        <div class="quote">
            <blockquote>"Great things are not done by impulse, but by a series of small things brought together."</blockquote>
        </div>
    </div>
    
    <div class="forms-section">
        <h2>Submit Your Information</h2>
        <form action="index.php" method="POST"> <!-- Change action to form.php -->
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Submit">
        </form>
    </div>

    <footer>
        <button id="back-to-top">Back to Top</button>
    </footer>

    <script>
        document.getElementById('back-to-top').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
