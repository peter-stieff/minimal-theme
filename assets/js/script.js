document.addEventListener('DOMContentLoaded', function() {
  console.log('DOMContentLoaded ausgelöst – Script läuft.');

  // ===== Burger-Button und Overlay =====
  var menuBtn = document.getElementById('menu-btn');
  var mobileNavOverlay = document.querySelector('.mobile-nav-overlay');

  // ===== Burger-Button toggelt das Overlay =====
  if (menuBtn && mobileNavOverlay) {
    menuBtn.addEventListener('click', function() {
      if (mobileNavOverlay.style.display === 'block') {
        mobileNavOverlay.style.display = 'none';
      } else {
        mobileNavOverlay.style.display = 'block';
      }
      console.log('Burger-Button geklickt – Overlay toggled.');
    });
  } else {
    console.log('Burger-Button oder Overlay nicht gefunden:', { menuBtn, mobileNavOverlay });
  }
  
  // ===== Schließen-Link im Overlay =====
  if (mobileNavOverlay) {
    var closeLink = mobileNavOverlay.querySelector('.close-link');
    if (closeLink) {
      closeLink.addEventListener('click', function(e) {
        e.preventDefault();
        mobileNavOverlay.style.display = 'none';
        console.log('Schließen-Link geklickt – Overlay geschlossen.');
      });
    } else {
      console.log('Close-Link nicht gefunden.');
    }
  }
    
  // ===== 299-Counter Animation =====
  var counterEl = document.getElementById('specialCounter');
  if (counterEl) {
    let currentValue = parseInt(counterEl.textContent, 10);
    function step() {
      if (currentValue > 0) {
        currentValue--;
        counterEl.textContent = currentValue;
        const delay = 12.5 + ((299 - currentValue) / 299) * 37.5;
        setTimeout(step, delay);
      } else {
        counterEl.textContent = 0;
        console.log('299-Counter abgeschlossen.');
        setTimeout(function() {
          var nextArrow = document.getElementById('nextArrow');
          if (nextArrow) {
            nextArrow.click();
            console.log('nextArrow geklickt.');
          } else {
            console.log('nextArrow nicht gefunden.');
          }
        }, 250);
      }
    }
    console.log('Counter initialisiert, Startwert:', currentValue);
    step();
  } else {
    console.log('Counter-Element (#specialCounter) nicht gefunden.');
  }

  // ===== Parallax-Effekt für Image-Boxen =====
  const parallaxBoxes = document.querySelectorAll('.behavior-parallax');
  console.log('Parallax-Boxen gefunden:', parallaxBoxes.length, parallaxBoxes);

  let ticking = false;

  function updateParallax() {
    console.log('updateParallax aufgerufen.');
    
    if (parallaxBoxes.length === 0) {
      console.log('Keine Parallax-Boxen vorhanden, überspringe.');
      ticking = false;
      return;
    }

    parallaxBoxes.forEach((box, index) => {
      const img = box.querySelector('.parallax-image');
      if (!img) {
        console.log(`Parallax-Box ${index}: Kein .parallax-image gefunden.`, box);
        return;
      }

      console.log(`Parallax-Box ${index}: Bild gefunden.`, img.src);

      // Position der Box relativ zum Viewport
      const rect = box.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      console.log(`Parallax-Box ${index}: rect.top=${rect.top}, rect.bottom=${rect.bottom}, windowHeight=${windowHeight}`);

      // Nur berechnen, wenn die Box im sichtbaren Bereich ist
      if (rect.top < windowHeight && rect.bottom > 0) {
        const scrollPosition = window.scrollY;
        const boxTop = rect.top + scrollPosition;
        const boxHeight = rect.height;

        const parallaxSpeed = 0.3;
        const offset = (scrollPosition - boxTop) * parallaxSpeed;
        const maxOffset = (img.offsetHeight - boxHeight) / 2;
        const clampedOffset = Math.max(-maxOffset, Math.min(maxOffset, offset));

        console.log(`Parallax-Box ${index}: scrollPosition=${scrollPosition}, boxTop=${boxTop}, boxHeight=${boxHeight}, offset=${offset}, clampedOffset=${clampedOffset}`);

        // Wende die Verschiebung an
        img.style.transform = `translateY(${clampedOffset}px)`;
        console.log(`Parallax-Box ${index}: transform=translateY(${clampedOffset}px) gesetzt.`);
      } else {
        console.log(`Parallax-Box ${index}: Außerhalb des sichtbaren Bereichs.`);
      }
    });
    ticking = false;
  }

  // Event-Listener für Scroll mit requestAnimationFrame
  window.addEventListener('scroll', () => {
    console.log('Scroll-Event ausgelöst.');
    if (!ticking) {
      requestAnimationFrame(updateParallax);
      ticking = true;
    }
  });

  // Event-Listener für Resize
  window.addEventListener('resize', () => {
    console.log('Resize-Event ausgelöst.');
    if (!ticking) {
      requestAnimationFrame(updateParallax);
      ticking = true;
    }
  });

  // Initialer Aufruf
  console.log('Initialer Aufruf von updateParallax.');
  updateParallax();

// Parallax-Effekt
document.addEventListener('DOMContentLoaded', () => {
  const parallaxElements = document.querySelectorAll('[data-parallax-element]');
  
  if (!parallaxElements.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateParallax(entry.target);
      }
    });
  }, { threshold: 0.1 });

  const animateParallax = (element) => {
    const container = element.closest('[data-parallax-strength]');
    const strength = parseFloat(container.dataset.parallaxStrength) || 0.3;
    
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY;
      const containerTop = container.getBoundingClientRect().top + scrollY;
      const offset = (scrollY - containerTop) * strength;
      
      element.style.transform = `translate3d(0, ${offset}px, 0)`;
    }, { passive: true });
  };

  parallaxElements.forEach(el => observer.observe(el));
});