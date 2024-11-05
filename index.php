<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "Hello, " . htmlspecialchars($_SESSION['username']);
    echo "<style>body {color: white;}</style>";
}
?>

<?php
if (isset($_COOKIE['username'])) {
     htmlspecialchars($_COOKIE['username']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise #4</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

	<?php   

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$_SESSION['username'] = htmlspecialchars($_POST['username']);
					$_SESSION['email'] = htmlspecialchars($_POST['email']);
			}


		$welcomeUsername = '';

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['username'])) {
					$welcomeUsername = htmlspecialchars($_POST['username']);
				}
			}
	?>

    <div class="navbar">
        <h5>Meet our Group :)</h5>
        <div class="quote">
		
		<?php
    
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
				$welcomeUsername = htmlspecialchars($_POST['username']);
					echo "<h2>Welcome, $welcomeUsername!</h2>";
			}
		?>
		
            <blockquote>"Great things are not done by impulse, but by a series of small things brought together." </blockquote>
        </div>

    </div>



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
                <p>For inquiries or further information, please visit our <a href="https://www.facebook.com/watch/?ref=search&v=423228357383259&external_log_id=3587e3d0-91c2-4233-8fee-d23f792c175f&q=%2Caupiton%20bossing%20compilation" target="_blank">Facebook page</a> or reach out to us via email. We look forward to connecting with you!</p>
            </div>
        </div>
    </div>
	
	
	<div class="submitted-info">
            <h2>Submitted Information</h2>
            <?php if (isset($_SESSION['username']) && isset($_SESSION['email'])): ?>
                <p><strong>Name:</strong> <?php echo $_SESSION['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
            <?php else: ?>
                <p>No information submitted yet.</p>
            <?php endif; ?>
    </div>
	
	
	
    
    <footer>
        <div class="button-section">
        <button id="back-to-top">Back to Top</button>
        <!-- New button to go back to form.php -->
        <a href="form.php"><button id="go-to-form">Back to Form</button></a>
    </div>
    </footer>
    
    <script>
        document.getElementById('back-to-top').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });


        function animateOnScroll() {
            const profileElements = document.querySelectorAll('.profile');
            const additionalInfoElements = document.querySelectorAll('.about-section, .contacts-section');

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.2
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                        if (entry.target.classList.contains('profile')) {
                            if (entry.target.classList.contains('member:nth-child(1)') || entry.target.classList.contains('member:nth-child(3)')) {
                                entry.target.classList.add('animate-left');
                            } else {
                                entry.target.classList.add('animate-right');
                            }
                        }
                    } else {
                        entry.target.classList.remove('animate-fade-in', 'animate-left', 'animate-right');
                    }
                });
            }, observerOptions);

            profileElements.forEach(element => observer.observe(element));
            additionalInfoElements.forEach(element => observer.observe(element));
        }

        document.addEventListener('DOMContentLoaded', animateOnScroll);
    </script>
</body>

</html>
