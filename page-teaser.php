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
        foreach ($teaser_boxes as $index => $box) : 
            $type = $box['crb_box_type'];
            $is_parallax = ($type === 'image' && $box['crb_behavior'] === 'parallax');
            $height = !empty($box['crb_box_height']) ? $box['crb_box_height'] . 'px' : '400px';
            ?>
            
            <div class="<?php echo $is_parallax ? 'parallax-container' : 'content-box'; ?>" 
                 style="height: <?php echo esc_attr($height); ?>;">
                
                <?php if ($type === 'image' && !empty($box['crb_image'])) : ?>
                    <div class="<?php echo $is_parallax ? 'parallax-bg' : 'static-bg'; ?>" 
                         style="background-image: url('<?php echo esc_url($box['crb_image']); ?>')">
                        <?php if (!empty($box['crb_title'])) : ?>
                            <div class="box-title"><?php echo esc_html($box['crb_title']); ?></div>
                        <?php endif; ?>
                    </div>

                <?php elseif ($type === 'video' && !empty($box['crb_video'])) : ?>
                    <video class="video-element" autoplay muted loop>
                        <source src="<?php echo esc_url($box['crb_video']); ?>" type="video/mp4">
                    </video>

                <?php elseif ($type === 'gradient') : ?>
                    <div class="gradient-box" 
                         style="background: linear-gradient(45deg, 
                             <?php echo esc_attr($box['crb_gradient_start']); ?>, 
                             <?php echo esc_attr($box['crb_gradient_end']); ?>);">
                        <div class="box-content"><?php echo esc_html($box['crb_title']); ?></div>
                    </div>

                <?php elseif ($type === 'counter') : ?>
                    <div id="specialCounter"><?php echo esc_html($box['crb_counter_start'] ?? 299); ?></div>
                <?php endif; ?>

                <?php if (!empty($box['crb_link'])) : 
                    $link = get_permalink($box['crb_link'][0]['id']); ?>
                    <a href="<?php echo esc_url($link); ?>" class="box-link"></a>
                <?php endif; ?>
            </div>
        <?php endforeach; 
    endif; ?>
</div>

<?php get_footer(); ?>
