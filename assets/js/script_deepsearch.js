/**
 * Minimal Theme - Haupt-JavaScript
 * 
 * Enthält:
 * - Font Loading System
 * - Burger-Menü
 * - 299-Counter
 * - Parallax-System
 * - Zoom-Effekt
 * - Performance-Optimierungen
 */

document.addEventListener('DOMContentLoaded', function() {
  console.log('🚀 DOM geladen - Initialisiere Skripte');

  // =================================================================
  // 1. Font Loading System
  // =================================================================
  const initFontLoader = async () => {
    try {
      console.log('🔠 Starte Font Loading');
      document.documentElement.classList.add('fonts-loading');

      // Warte auf das Laden der Basis-Schrift
      await document.fonts.load('1em MatterHQ');
      
      console.log('✅ Schrift erfolgreich geladen');
      document.documentElement.classList.remove('fonts-loading');
      document.documentElement.classList.add('fonts-loaded');
    } catch (error) {
      console.error('❌ Schrift konnte nicht geladen:', error);
      document.documentElement.classList.remove('fonts-loading');
      document.documentElement.classList.add('fonts-failed');
    }
  };

  // =================================================================
  // 2. Burger-Menü und Mobile Navigation
  // =================================================================
  const initMobileMenu = () => {
    const menuBtn = document.getElementById('menu-btn');
    const mobileNav = document.querySelector('.mobile-nav-overlay');
    const closeBtn = mobileNav?.querySelector('.close-link');

    if (!menuBtn || !mobileNav) {
      console.warn('Mobile-Menü Elemente nicht gefunden');
      return;
    }

    const toggleMenu = (state) => {
      mobileNav.style.display = state ? 'block' : 'none';
      document.body.style.overflow = state ? 'hidden' : '';
    };

    menuBtn.addEventListener('click', () => toggleMenu(true));
    closeBtn.addEventListener('click', (e) => {
      e.preventDefault();
      toggleMenu(false);
    });

    console.log('🍔 Mobile-Menü initialisiert');
  };

  // =================================================================
  // 3. 299-Counter mit Progressiver Geschwindigkeit
  // =================================================================
  const initCounter = () => {
    const counterEl = document.getElementById('specialCounter');
    const nextArrow = document.getElementById('nextArrow');

    if (!counterEl) {
      console.warn('Counter-Element nicht gefunden');
      return;
    }

    const animateCounter = (current) => {
      if (current < 0) {
        counterEl.textContent = '0';
        if (nextArrow) {
          setTimeout(() => nextArrow.click(), 250);
        }
        return;
      }

      counterEl.textContent = current;
      const delay = 10 + (299 - current) * 0.25;
      
      requestAnimationFrame(() => {
        setTimeout(() => animateCounter(current - 1), delay);
      });
    };

    animateCounter(299);
    console.log('⏱️ Counter-Animation gestartet');
  };

  // =================================================================
  // 4. Parallax-System mit Performance-Optimierungen
  // =================================================================
  const initParallax = () => {
    const parallaxItems = document.querySelectorAll('.behavior-parallax');
    if (!parallaxItems.length) return;

    let isTicking = false;
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        entry.target._isParallaxActive = entry.isIntersecting;
      });
    }, { threshold: 0.1 });

    const updateParallax = () => {
      const scrollY = window.pageYOffset;
      
      parallaxItems.forEach(item => {
        if (!item._isParallaxActive) return;

        const strength = parseFloat(item.dataset.parallaxStrength) || 0.3;
        const offset = scrollY * strength;
        item.querySelector('.parallax-bg').style.transform = 
          `translate3d(0, ${offset}px, 0) scale(1.001)`;
      });
      
      isTicking = false;
    };

    const onScroll = () => {
      if (!isTicking) {
        requestAnimationFrame(updateParallax);
        isTicking = true;
      }
    };

    parallaxItems.forEach(item => {
      item._isParallaxActive = false;
      observer.observe(item);
      item.style.willChange = 'transform';
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    console.log('🎢 Parallax-System aktiviert');
  };

  // =================================================================
  // 5. Universeller Zoom-Effekt
  // =================================================================
  const initZoomEffect = () => {
    const zoomItems = document.querySelectorAll('.has-zoom');
    if (!zoomItems.length) return;

    const handleHover = (element, enter) => {
      const scale = enter 
        ? element.dataset.zoomScale || '1.03'
        : '1';

      element.style.transform = `scale(${scale})`;
    };

    zoomItems.forEach(item => {
      item.style.transition = 'transform 0.8s cubic-bezier(0.23, 1, 0.32, 1)';
      
      item.addEventListener('mouseenter', () => 
        handleHover(item.querySelector('.image-wrapper'), true);
      
      item.addEventListener('mouseleave', () => 
        handleHover(item.querySelector('.image-wrapper'), false);
    });

    console.log('🔍 Zoom-Effekt initialisiert');
  };

  // =================================================================
  // Hauptinitialisierung
  // =================================================================
  const init = async () => {
    await initFontLoader();
    initMobileMenu();
    initCounter();
    initParallax();
    initZoomEffect();

    // Global Event Listeners
    window.addEventListener('resize', () => {
      requestAnimationFrame(initParallax);
    }, { passive: true });
  };

  // Starte die Initialisierung
  init();
});
});

// Service Worker Registrierung (Optional)
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .then(reg => console.log('Service Worker registriert:', reg))
      .catch(err => console.warn('SW Registrierung fehlgeschlagen:', err));
  });
}