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
  if (!empty($teaser_boxes)) :
  ?>
    <div class="teaser-box-container">
      <?php foreach ($teaser_boxes as $box) : ?>
        <div class="teaser-box teaser-box-<?php echo esc_attr($box['crb_box_type']); ?>" title="<?php echo esc_attr($box['crb_tooltip']); ?>">
          <?php
          // Link vorbereiten
          $link_url = '';
          $link_title = '';
          if (!empty($box['crb_link'])) {
              $page_id = $box['crb_link'][0]['id'];
              $link_url = get_permalink($page_id);
              $link_title = get_the_title($page_id);
          }
          // Box-Höhe (Standard: 200px)
          $box_height = !empty($box['crb_box_height']) ? esc_attr($box['crb_box_height']) : '200';
          // Behavior (static, zoom, parallax)
          $behavior = !empty($box['crb_behavior']) && in_array($box['crb_behavior'], ['static', 'zoom', 'parallax']) ? esc_attr($box['crb_behavior']) : 'static';
          ?>

          <?php if ($box['crb_box_type'] === 'image') : ?>
            <div class="content-box behavior-<?php echo $behavior; ?>" style="height: <?php echo $box_height; ?>px;">
              <?php 
              $image_url = !empty($box['crb_source']) ? $box['crb_source'] : '';
              ?>
              <?php if ($image_url) : ?>
                <?php if ($behavior === 'parallax') : ?>
                  <?php if (!empty($link_url)) : ?>
                    <a href="<?php echo esc_url($link_url); ?>" aria-label="Link zu <?php echo esc_attr($link_title); ?>">
                  <?php endif; ?>
                    <div class="parallax-bg" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                  <?php if (!empty($link_url)) : ?>
                    </a>
                  <?php endif; ?>
                <?php else : ?>
                  <?php if (!empty($link_url)) : ?>
                    <a href="<?php echo esc_url($link_url); ?>" aria-label="Link zu <?php echo esc_attr($link_title); ?>">
                  <?php endif; ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($box['crb_title']); ?>" class="content-image">
                  <?php if (!empty($link_url)) : ?>
                    </a>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>

          <?php elseif ($box['crb_box_type'] === 'video') : ?>
            <div class="content-box" style="height: <?php echo $box_height; ?>px;">
              <?php 
              $video_url = !empty($box['crb_source']) ? $box['crb_source'] : '';
              ?>
              <?php if (!empty($link_url)) : ?>
                <a href="<?php echo esc_url($link_url); ?>" aria-label="Link zu <?php echo esc_attr($link_title); ?>">
              <?php endif; ?>
                <?php if ($video_url) : ?>
                  <video src="<?php echo esc_url($video_url); ?>" autoplay muted loop playsinline>
                    Ihr Browser unterstützt dieses Video nicht.
                  </video>
                  <div class="box-title"><?php echo esc_html($box['crb_title']); ?></div>
                <?php endif; ?>
              <?php if (!empty($link_url)) : ?>
                </a>
              <?php endif; ?>
            </div>

          <?php elseif ($box['crb_box_type'] === 'gradient') : ?>
            <div class="content-box gradient-box" style="height: <?php echo $box_height; ?>px;">
              <?php
              $background_image = !empty($box['crb_source']) ? "background-image: url('" . esc_url($box['crb_source']) . "');" : '';
              $gradient_style = !empty($box['crb_gradient_css']) ? $box['crb_gradient_css'] : '';
              $opacity = !empty($box['crb_gradient_opacity']) ? $box['crb_gradient_opacity'] / 100 : 1;
              ?>
              <?php if (!empty($link_url)) : ?>
                <a href="<?php echo esc_url($link_url); ?>" aria-label="Link zu <?php echo esc_attr($link_title); ?>">
              <?php endif; ?>
                <div class="gradient-background" style="<?php echo $background_image; ?>"></div>
                <div class="gradient-overlay <?php echo esc_attr($box['crb_gradient_predefined']); ?>" style="<?php echo esc_attr($gradient_style); ?> opacity: <?php echo esc_attr($opacity); ?>;"></div>
                <?php if (!empty($box['crb_centered_text'])) : ?>
                  <div class="centered-text" style="color: <?php echo esc_attr($box['crb_font_color']); ?>;">
                    <?php echo esc_html($box['crb_centered_text']); ?>
                  </div>
                <?php endif; ?>
                <?php if (!empty($box['crb_title'])) : ?>
                  <div class="box-title" style="color: <?php echo esc_attr($box['crb_font_color']); ?>;">
                    <?php echo esc_html($box['crb_title']); ?>
                  </div>
                <?php endif; ?>
              <?php if (!empty($link_url)) : ?>
                </a>
              <?php endif; ?>
            </div>

          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <p>Keine Teaser-Boxen gefunden.</p>
  <?php endif; ?>
</div>
<?php get_footer(); ?>