<?php
/**
 * Template Name: Teaser Page (Parallax Optimized)
 */
get_header();
?>

<div class="page-container" data-scroll-container>
  <?php 
  $teaser_boxes = carbon_get_the_post_meta('crb_teaser_boxes');
  if (!empty($teaser_boxes)) :
    foreach ($teaser_boxes as $index => $box) : 
      $is_parallax = ($box['crb_box_type'] === 'image' && $box['crb_behavior'] === 'parallax');
      $box_class = $is_parallax ? 'parallax-container' : 'content-box';
      $height = $box['crb_box_height'] ?: 400;
      ?>
      
      <div class="<?php echo esc_attr($box_class); ?>" 
           style="--box-height: <?php echo (int)$height; ?>px;"
           data-parallax-strength="<?php echo $is_parallax ? '0.3' : '0'; ?>"
           <?php if ($is_parallax) echo ' data-aos="fade-up" data-aos-delay="' . ($index * 50) . '"'; ?>>
           
        <?php if ($box['crb_box_type'] === 'image' && !empty($box['crb_source'])) : ?>
          <div class="<?php echo $is_parallax ? 'parallax-bg' : 'static-bg'; ?>" 
               style="background-image: url('<?php echo esc_url($box['crb_source']); ?>')"
               <?php if ($is_parallax) echo ' data-parallax-element'; ?>>
          </div>
        <?php endif; ?>

        <!-- Titel & Content -->
        <?php if (!empty($box['crb_title'])) : ?>
          <div class="parallax-content">
            <h3><?php echo esc_html($box['crb_title']); ?></h3>
          </div>
        <?php endif; ?>
      </div>
      
    <?php endforeach;
  endif; ?>
</div>

<?php get_footer(); ?>
