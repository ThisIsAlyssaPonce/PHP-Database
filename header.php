<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise #8</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['username'] = htmlspecialchars($_POST['username']);
        $_SESSION['email'] = htmlspecialchars($_POST['email']);
    }

    $welcomeUsername = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
        $welcomeUsername = htmlspecialchars($_POST['username']);
    }
    ?>

    <div class="navbar">
        <h5><?php echo $headingText; ?></h5>
        <div class="quote">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
                $welcomeUsername = htmlspecialchars($_POST['username']);
                echo "<h2>Welcome, $welcomeUsername!</h2>";
            }
            ?>
            <blockquote>"Great things are not done by impulse, but by a series of small things brought together."</blockquote>
        </div>
    </div>
