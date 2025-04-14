/**
 * Parallax Controller (Modern Implementation)
 */
document.addEventListener('DOMContentLoaded', () => {
  class ParallaxSystem {
    constructor() {
      this.parallaxItems = [];
      this.rafId = null;
      this.init();
    }

    init() {
      document.querySelectorAll('[data-parallax="true"]').forEach(container => {
        const bg = container.querySelector('.parallax-bg');
        if (!bg) return;

        this.parallaxItems.push({
          container,
          bg,
          speed: parseFloat(container.dataset.speed) || 0.3
        });
      });

      if (this.parallaxItems.length) {
        window.addEventListener('scroll', this.handleScroll.bind(this), { passive: true });
        window.addEventListener('resize', this.handleScroll.bind(this), { passive: true });
        this.handleScroll();
      }
    }

    handleScroll() {
      if (this.rafId) cancelAnimationFrame(this.rafId);
      
      this.rafId = requestAnimationFrame(() => {
        const scrollY = window.scrollY;
        
        this.parallaxItems.forEach(item => {
          const { top } = item.container.getBoundingClientRect();
          const offset = (scrollY + top) * item.speed * -1;
          item.bg.style.transform = `translate3d(0, ${offset}px, 0)`;
        });
      });
    }
  }

  // Initialisierung
  new ParallaxSystem();
});