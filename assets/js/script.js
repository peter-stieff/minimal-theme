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
    let current = 299;
    const counter = setInterval(() => {
      counterEl.textContent = current;
      current--;
      if (current < 0) {
        clearInterval(counter);
        const nextArrow = document.getElementById('nextArrow');
        if (nextArrow) nextArrow.click();
      }
    }, 30);
  }

  // ===== PARALLAX SYSTEM =====
  const parallaxContainers = document.querySelectorAll('.parallax-container');
  if (parallaxContainers.length > 0) {
    let ticking = false;

    function updateParallax() {
      const scrollY = window.scrollY;
      
      parallaxContainers.forEach(container => {
        const bg = container.querySelector('.parallax-bg');
        if (!bg) return;
        
        const speed = parseFloat(container.dataset.speed) || 0.3;
        const offset = scrollY * speed;
        bg.style.transform = `translate3d(0, ${offset}px, 0)`;
      });
      
      ticking = false;
    }

    window.addEventListener('scroll', function() {
      if (!ticking) {
        requestAnimationFrame(updateParallax);
        ticking = true;
      }
    }, { passive: true });

    updateParallax();
  }
});