<?php get_header(); ?>
<div class="page-container">
  
  <!-- Beispiel: Boxen -->
  <div class="content-box">
    <!-- Box 1: 299-Counter-Box -->
    <!-- Diesen Teil kannst du mit deinem bisherigen HTML & JS umsetzen -->
    <div class="special-container">
      <svg viewBox="0 0 230 230" xmlns="http://www.w3.org/2000/svg">
        <circle cx="115" cy="115" r="115" fill="#9c2716"/>
        <text x="115" y="115" text-anchor="middle" dominant-baseline="middle" fill="white" font-family="Arial">
          <tspan x="115" dy="-50" font-size="20">Sonderaktion</tspan>
          <tspan x="115" dy="60" font-size="70">
            <tspan style="baseline-shift: super; font-size: 35px;">€</tspan>
            <tspan id="specialCounter">299</tspan>
          </tspan>
          <tspan x="115" dy="50" font-size="20">nur bis 31.08.2025!</tspan>
        </text>
      </svg>
      <!-- Neuer Pfeil usw. -->
      <div class="more-arrow">
        <div class="arrow-background"></div>
        <div class="arrow-container">
          <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 600">
            <path fill-rule="evenodd" d="M250 500 500 250 250 0h-125L325 200h-425v100h425l-200 200z"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Weitere Content-Boxen: Video-Box, Dummy-Boxen etc. -->
  <div class="content-box" style="height:600px">
    <video src="<?php echo get_stylesheet_directory_uri(); ?>/assets/videos/drohne.mp4" autoplay muted loop playsinline style="width:100%; height:100%; object-fit: cover;">
      Ihr Browser unterstützt dieses Video nicht.
    </video>
  </div>
  <div class="content-box">Box 3</div>
  <div class="content-box">Box 4</div>
  <div class="content-box">Box 5</div>
</div>
<?php get_footer(); ?>