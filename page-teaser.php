<?php
/**
 * Template Name: Teaser Page
 */
get_header();
?>
<div class="page-container">
  
  <?php 
  // Hole die Teaser-Boxen aus Carbon Fields
  $teaser_boxes = carbon_get_the_post_meta('crb_teaser_boxes');
  if( ! empty($teaser_boxes) ) :
  ?>
    <div class="teaser-box-container">
      <?php foreach($teaser_boxes as $box): ?>
        <div class="teaser-box teaser-box-<?php echo esc_attr($box['crb_box_type']); ?>" title="<?php echo esc_attr($box['crb_tooltip']); ?>">
          <a href="<?php echo esc_url($box['crb_link']); ?>">
            <?php if($box['crb_box_type'] === 'image'): ?>
              <div class="content-box">
                <?php 
                    // Hole die Image-URL – prüfe, ob der Wert ein Array ist oder direkt als String kommt.
                    if (is_array($box['crb_source']) && isset($box['crb_source']['url'])) {
                        $image_url = $box['crb_source']['url'];
                    } elseif (is_string($box['crb_source'])) {
                        $image_url = $box['crb_source'];
                    }
                ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($box['crb_title']); ?>">
              </div>
            <?php elseif($box['crb_box_type'] === 'video'): ?>
  <div class="content-box" style="height:600px">
    <?php 
      // Hole die Video-URL – prüfe, ob der Wert ein Array ist oder direkt als String kommt.
      if (is_array($box['crb_source']) && isset($box['crb_source']['url'])) {
          $video_url = $box['crb_source']['url'];
      } elseif (is_string($box['crb_source'])) {
          $video_url = $box['crb_source'];
      }
    ?>
    <video src="<?php echo esc_url($video_url); ?>" autoplay muted loop playsinline style="object-fit: cover; width:100%; height:100%;">
      Ihr Browser unterstützt dieses Video nicht.
    </video>
    <div class="box-title"><?php echo esc_html($box['crb_title']); ?></div>
  </div>
<?php endif; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Keine Teaser-Boxen gefunden.</p>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
