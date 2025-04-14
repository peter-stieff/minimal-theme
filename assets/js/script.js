document.addEventListener('DOMContentLoaded', function() {
    // ===== MOBILE MENU =====
    const menuBtn = document.getElementById('menu-btn');
    const mobileNav = document.querySelector('.mobile-nav-overlay');
    
    if (menuBtn && mobileNav) {
        menuBtn.addEventListener('click', function() {
            mobileNav.style.display = mobileNav.style.display === 'block' ? 'none' : 'block';
        });
    }

    // ===== 299 COUNTER =====
    const counterEl = document.getElementById('specialCounter');
    if (counterEl) {
        let current = parseInt(counterEl.textContent);
        const interval = setInterval(() => {
            counterEl.textContent = current--;
            if (current < 0) {
                clearInterval(interval);
                const nextArrow = document.getElementById('nextArrow');
                if (nextArrow) nextArrow.click();
            }
        }, 50);
    }

    // ===== PARALLAX SYSTEM =====
    const parallaxElements = document.querySelectorAll('.parallax-bg');
    let ticking = false;

    function updateParallax() {
        const scrollY = window.scrollY;
        
        parallaxElements.forEach(element => {
            const container = element.closest('.parallax-container');
            const containerTop = container.offsetTop;
            const speed = 0.3;
            
            const offset = (scrollY - containerTop) * speed;
            element.style.transform = `translate3d(0, ${offset}px, 0)`;
        });
        
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }, { passive: true });

    // Initiale Positionierung
    updateParallax();
});