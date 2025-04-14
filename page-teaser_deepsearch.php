<?php
/**
 * Template Name: Teaser Page
 * 
 * Features:
 * - Dynamische Höheneinstellung (vh oder px)
 * - Parallax/ Zoom-Effekte
 * - Responsive Gradienten
 * - Performance-Optimiertes Markup
 */

get_header();
?>

<div class="page-container">
  <?php 
  $teaser_boxes = carbon_get_the_post_meta('crb_teaser_boxes');
  if (!empty($teaser_boxes)) : 
  ?>
    <div class="teaser-grid" data-scroll-container>
      <?php foreach ($teaser_boxes as $index => $box) : 
        // Allgemeine Einstellungen
        $box_type = $box['crb_box_type'];
        $height_unit = strpos($box['crb_box_height'], 'vh') !== false ? '' : 'px';
        $box_height = $height_unit ? $box['crb_box_height'] . 'px' : $box['crb_box_height'];
        
        // Effektparameter
        $parallax_strength = $box_type === 'image' ? $box['crb_parallax_strength'] : 0;
        $zoom_scale = $box['crb_has_zoom'] ? $box['crb_image_scale'] : '1';
        
        // Textformatierung
        $text_styles = [
          'color' => $box['crb_text_color'] ?? '#fff',
          'text-shadow' => $box['crb_text_shadow'] ?? 'none',
          'font-size' => 'var(--font-size)'
        ];
        ?>
        
        <div class="teaser-box 
                  teaser-<?php echo esc_attr($box_type); ?> 
                  <?php echo esc_attr($box['crb_font_size']); ?>
                  text-align-<?php echo esc_attr($box['crb_text_align']); ?>"
             style="height: <?php echo esc_attr($box_height); ?>;"
             data-parallax-strength="<?php echo esc_attr($parallax_strength); ?>"
             data-aos="fade-up"
             data-aos-delay="<?php echo $index * 50; ?>">
          
          <?php if ($box_type === 'image') : ?>
            <div class="image-container 
                      <?php echo $box['crb_behavior'] === 'parallax' ? 'parallax-parent' : ''; ?>
                      <?php echo $box['crb_has_zoom'] ? 'has-zoom' : ''; ?>"
                 style="--zoom-scale: <?php echo esc_attr($zoom_scale); ?>;">
              
              <?php if (!empty($box['crb_source'])) : ?>
                <div class="image-wrapper 
                          <?php echo $box['crb_behavior'] === 'parallax' ? 'parallax-bg' : 'static-bg'; ?>"
                     style="background-image: url('<?php echo esc_url($box['crb_source']); ?>');">
                </div>
              <?php endif; ?>

              <?php if (!empty($box['crb_title'])) : ?>
                <div class="box-title" style="<?php echo implode('; ', array_map(
                  fn($k, $v) => "$k:$v", array_keys($text_styles), $text_styles)); ?>">
                  <?php echo esc_html($box['crb_title'])); ?>
                </div>
              <?php endif; ?>
            </div>

          <?php elseif ($box_type === 'video') : ?>
            <div class="video-container">
              <?php if (!empty($box['crb_source'])) : ?>
                <video class="video-element" 
                       autoplay muted loop playsinline
                       poster="<?php echo esc_url($box['crb_poster'] ?? ''); ?>">
                  <source src="<?php echo esc_url($box['crb_source']); ?>" type="video/mp4">
                </video>
              <?php endif; ?>
            </div>

          <?php elseif ($box_type === 'gradient') : ?>
            <div class="gradient-container 
                      blend-<?php echo esc_attr($box['crb_blend_mode']); ?>"
                 style="background: <?php echo esc_attr($box['crb_gradient_css']); ?>;
                        opacity: <?php echo ($box['crb_gradient_opacity'] ?? 100) / 100; ?>;">
              <?php if (!empty($box['crb_centered_text'])) : ?>
                <div class="centered-text 
                          <?php echo $box['crb_text_transparent'] ? 'text-transparent' : ''; ?>"
                     style="<?php echo implode('; ', array_map(
                       fn($k, $v) => "$k:$v", array_keys($text_styles), $text_styles)); ?>">
                  <?php echo esc_html($box['crb_centered_text'])); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php // Universal Link ?>
          <?php if (!empty($box['crb_link'])) : 
            $link = $box['crb_link'][0]; ?>
            <a href="<?php echo esc_url(get_permalink($link['id'])); ?>" 
               class="teaser-link"
               aria-label="<?php echo esc_attr($link['title'] ?? 'Mehr erfahren'); ?>"
               data-cursor-hover>
            </a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <p class="no-content">Keine Teaser-Boxen konfiguriert</p>
  <?php endif; ?>
</div>

<?php 
// Performance-Optimiertes Lazy Loading
add_filter('wp_get_attachment_image_attributes', function($attr) {
  $attr['loading'] = 'lazy';
  $attr['decoding'] = 'async';
  return $attr;
});

get_footer();