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

    const scrolled = window.pageYOffset;
    console.log('Scroll-Position:', scrolled);

    parallaxBoxes.forEach((box, index) => {
      const wrapper = box.querySelector('.parallax-wrapper');
      if (!wrapper) {
        console.log(`Parallax-Box ${index}: Kein .parallax-wrapper gefunden.`, box);
        return;
      }

      console.log(`Parallax-Box ${index}: Wrapper gefunden.`);

      // Parallax-Berechnung (wie Rohversion)
      const parallaxSpeed = 0.5; // Genau wie HTML-Testdatei
      const offset = -(scrolled * parallaxSpeed);

      // Wende die Verschiebung an
      wrapper.style.backgroundPositionY = `${offset}px`;
      console.log(`Parallax-Box ${index}: backgroundPositionY=${offset}px gesetzt.`);
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
});