<?php
/**
 * Template Name: Teaser Page
 */
get_header();
?>

<div class="page-container">
  <?php 
  $teaser_boxes = carbon_get_the_post_meta('crb_teaser_boxes');
  if (!empty($teaser_boxes)) :
    foreach ($teaser_boxes as $box) : 
      $is_parallax = ($box['crb_box_type'] === 'image' && $box['crb_behavior'] === 'parallax');
      $box_class = $is_parallax ? 'parallax-container' : 'content-box';
      ?>
      
      <div class="<?php echo esc_attr($box_class); ?>" 
           style="--box-height: <?php echo (int)($box['crb_box_height'] ?? 400); ?>px;"
           <?php if ($is_parallax) echo ' data-parallax="true" data-speed="0.3"'; ?>>
           
        <?php if ($box['crb_box_type'] === 'image' && !empty($box['crb_source'])) : ?>
          <div class="<?php echo $is_parallax ? 'parallax-bg' : 'static-bg'; ?>" 
               style="background-image: url('<?php echo esc_url($box['crb_source']); ?>')">
          </div>
        <?php endif; ?>

        <div class="box-content">
          <?php if (!empty($box['crb_title'])) : ?>
            <h3><?php echo esc_html($box['crb_title']); ?></h3>
          <?php endif; ?>
        </div>
      </div>
      
    <?php endforeach;
  endif; ?>
</div>

<?php get_footer(); ?>
