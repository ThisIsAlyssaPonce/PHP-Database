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
