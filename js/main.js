function handleNavbarClass() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 30) {
        navbar.classList.add('bg-header-gradient'); // Add class if scroll position > 30px
    } else {
        navbar.classList.remove('bg-header-gradient'); // Remove class if scroll position <= 30px
    }
}

// Run on page load
document.addEventListener('DOMContentLoaded', handleNavbarClass);

// Run on scroll
document.addEventListener('scroll', handleNavbarClass);

document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 1200, // Animation duration
        once: true,     // Whether animation should happen only once
    });
});
