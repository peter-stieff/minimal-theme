document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded ausgelöst – Script läuft.');

  // ===== Burger-Button und Overlay =====
  var menuBtn = document.getElementById('menu-btn');
  var mobileNavOverlay = document.querySelector('.mobile-nav-overlay');

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

// ===== Parallax-Effekt für .parallax-container Boxen =====
(() => {
  const parallaxElements = document.querySelectorAll('.parallax-container');
  const strength = 0.3;

  let requestId = null;

  function updateParallaxContainers() {
    const scrollY = window.scrollY || window.pageYOffset;

    parallaxElements.forEach(el => {
      el.style.transform = `translate3d(0, ${scrollY * strength}px, 0)`;
    });

    requestId = null;
  }

  function onScrollParallax() {
    if (!requestId) {
      requestId = requestAnimationFrame(updateParallaxContainers);
    }
  }

  window.addEventListener('scroll', onScrollParallax, { passive: true });
})();
