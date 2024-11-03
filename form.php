<?php
session_start();
include 'db.php'; // Include the database connection

// Initialize error messages
$errorMessage = "";
$successMessage = ""; // To show a success message after registration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filter and validate input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT); // Hash the password for security
    
    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, prepare an error message
        $errorMessage = "Username or email already exists. Please try again.";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            // Set session variables
            $_SESSION['username'] = $username;

            // Optional: set a cookie that lasts for 30 days
            setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            
            // Success message
            $successMessage = "Registration successful! Welcome, " . htmlspecialchars($username) . "!";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        .forms-container {
            display: flex;
            justify-content: space-around; /* Space out the forms */
            align-items: flex-start; /* Align items to the start of the container */
            flex-wrap: wrap; /* Allow wrapping for small screens */
            margin: 20px; /* Add some margin around the container */
        }

        .form-section {
            width: 45%; /* Each form takes up 45% of the width */
            min-width: 300px; /* Minimum width for responsiveness */
            padding: 20px; /* Padding for each form */
            border: 1px solid #ccc; /* Optional border for visual separation */
            border-radius: 8px; /* Rounded corners */
            background-color: #f9f9f9; /* Light background for forms */
        }

        .form-section h2 {
            margin-top: 0; /* Remove top margin for the heading */
        }

        .error-message, .success-message {
            margin: 10px 0; /* Margin for messages */
            font-weight: bold; /* Bold font */
        }

        .error-message {
            color: red; /* Red for error messages */
        }

        .success-message {
            color: green; /* Green for success messages */
        }
    </style>
</head>
<body>
    <h1>Register</h1>

    <div class="forms-container">
        <div class="form-section">
            <h2>Submit Your Information</h2>

            <!-- Display error message if it exists -->
            <?php if (!empty($errorMessage)): ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <!-- Display success message if it exists -->
            <?php if (!empty($successMessage)): ?>
                <div class="success-message"><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>
                
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                
                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="form-section">
            <h2>Register</h2>
            <form method="POST" action="">
                <label for="register-username">Username:</label><br>
                <input type="text" id="register-username" name="username" required><br><br>
                
                <label for="register-email">Email:</label><br>
                <input type="email" id="register-email" name="email" required><br><br>
                
                <label for="register-password">Password:</label><br>
                <input type="password" id="register-password" name="password" required><br><br>
                
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
