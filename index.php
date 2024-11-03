<?php
session_start();
include 'db.php'; // Include the database connection

// Initialize error messages
$errorMessage = "";

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
        // Set session variables
        $_SESSION['username'] = $username;

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            // Optional: set a cookie that lasts for 30 days
            setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/"); // 30 days
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

// Heading text
$headingText = "Meet our Group :)"; 
include 'header.php';
?>

<div class="team">
    <div class="profiles">
        <?php
        // Define profiles array
        $profiles = [
            [
                'role' => 'Leader',
                'name' => 'Llander, Sherwin B.',
                'age' => 23,
                'gender' => 'Male',
                'education' => '3rd Year College in PLMun',
                'skills' => 'HTML, CSS (Beginner)',
                'objectives' => 'To enhance my skills and improve my programming skills. To learn something new that can be useful someday.',
                'image' => 'images/leader.jpg',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/sherwin-llander-aa7042323?trk=contact-info',
                    'github' => 'https://github.com/Shrwnllndr',
                    'email' => 'mailto:sherwinllander@gmail.com'
                ]
            ],
            [
                'role' => 'Member',
                'name' => 'Bustillo, John Rafael A.',
                'age' => 20,
                'gender' => 'Male',
                'education' => '3rd Year College in PLMun studying B.S. Information Technology.',
                'skills' => 'HTML, CSS and JavaScript (Beginner)',
                'objectives' => 'To learn the basics of IT, including programming, networking, and managing databases, and apply these skills in real-world scenarios. My goal is continuous learning and skill-building.',
                'image' => 'images/member1.jpg',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/john-rafael-bustillo-3a6037323/',
                    'github' => 'https://github.com/See0ut',
                    'email' => 'mailto:member1@example.com'
                ]
            ],
            [
                'role' => 'Member',
                'name' => 'Reyes, Mj Denroe',
                'age' => 20,
                'gender' => 'Male',
                'education' => '3rd Year College in PLMun',
                'skills' => 'HTML, CSS and JavaScript (Beginner)',
                'objectives' => 'To learn the basics of programming and to expand my knowledge in programming.',
                'image' => 'images/member2.jpg',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/mj-denroe-reyes-898038323',
                    'github' => 'https://github.com/arnoldbitler',
                    'email' => 'mailto:member2@example.com'
                ]
            ],
            [
                'role' => 'Member',
                'name' => 'Francisco, Kim Cedric',
                'age' => 21,
                'gender' => 'Male',
                'education' => '3rd Year College in PLMun',
                'skills' => 'HTML, CSS (Beginner)',
                'objectives' => 'To learn the basics of programming and to expand my learnings about programming, to use in the future.',
                'image' => 'images/member3.jpg',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/kim-cedric-a93342323',
                    'github' => 'https://github.com/Kzhi03',
                    'email' => 'mailto:kimcedricversoza@gmail.com'
                ]
            ],
            [
                'role' => 'Member',
                'name' => 'Ponce, Alyssa Mae S.',
                'age' => 24,
                'gender' => 'Female',
                'education' => '3rd Year College in PLMun',
                'skills' => 'HTML, CSS, PHP, JavaScript',
                'objectives' => 'By learning the fundamentals of IT and applying them to real-world situations, Alyssa aims to improve her programming abilities. She focuses on mastering programming fundamentals and broadening her knowledge for future applications through continuous learning and skill development.',
                'image' => 'images/member4.jpg',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/thisisalyssaponce/',
                    'github' => 'https://github.com/ThisIsAlyssaPonce',
                    'email' => 'mailto:ThisIsAlyssaMaePonce@gmail.com'
                ]
            ]
        ];

        // Loop through profiles array and generate HTML content
        foreach ($profiles as $profile) {
            echo '<div class="profile ' . strtolower($profile['role']) . '">';
            echo '<img src="' . $profile['image'] . '" alt="' . $profile['name'] . '">';
            echo '<div class="profile-content">';
            echo '<h1>' . $profile['name'] . '</h1>';
            echo '<p><strong>Age:</strong> ' . $profile['age'] . '</p>';
            echo '<p><strong>Gender:</strong> ' . $profile['gender'] . '</p>';
            echo '<p><strong>Education:</strong> ' . $profile['education'] . '</p>';
            echo '<p><strong>Skills:</strong> ' . $profile['skills'] . '</p>';
            echo '<p><strong>Objectives:</strong> ' . $profile['objectives'] . '</p>';
            echo '<div class="social-links">';
            echo '<a href="' . $profile['social_links']['linkedin'] . '" class="icon-link"><i class="fab fa-linkedin"></i></a>';
            echo '<a href="' . $profile['social_links']['github'] . '" class="icon-link"><i class="fab fa-github"></i></a>';
            echo '<a href="' . $profile['social_links']['email'] . '" class="icon-link"><i class="fas fa-envelope"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="additional-info">
        <div class="about-section">
            <h2>About</h2>
            <p>We are a dedicated team of 3rd-year college students from PLMun, each passionate about technology and eager to expand our knowledge and skills. Our project involves creating an engaging and user-friendly website to showcase our capabilities and work.</p>
            <p>Our team is committed to continuous learning and development in the field of IT. Through this project, we aim to enhance our programming skills, collaborate effectively, and contribute valuable insights to our academic and professional growth.</p>
        </div>
        
        <div class="contacts-section">
            <h2>Contacts</h2>
            <p>For inquiries or further information, please visit our <a href="https://www.facebook.com/" target="_blank">Facebook page</a> or reach out to us via email. We look forward to connecting with you!</p>
        </div>
    </div>
</div>

<?php 

// Display error message if it exists
if (!empty($errorMessage)) {
    echo "<div class='error-message'>$errorMessage</div>";
}

include 'footer.php'; 

?>

