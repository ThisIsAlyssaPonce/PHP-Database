document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('back-to-top').addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });


    function animateOnScroll() {
        const elements = document.querySelectorAll('.profile, .additional-info');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.2
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                } else {
                    entry.target.classList.remove('animate-fade-in');
                }
            });
        }, observerOptions);

        elements.forEach(element => {
            observer.observe(element);
        });
    }

    animateOnScroll();
});