<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options() {
    // Teaser-Boxen Container
    Container::make('post_meta', 'Teaser-Einstellungen')
        ->where('post_template', '=', 'page-teaser.php')
        ->add_fields([
            Field::make('complex', 'crb_teaser_boxes', 'Teaser-Boxen')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('select', 'crb_box_type', 'Box-Typ')
                        ->add_options([
                            'image'    => 'Bild',
                            'video'    => 'Video',
                            'gradient' => 'Verlauf',
                            'counter'  => 'Counter'
                        ])
                        ->set_default_value('image'),
                    
                    // Gemeinsame Felder
                    Field::make('text', 'crb_title', 'Titel'),
                    Field::make('association', 'crb_link', 'Verlinkung')
                        ->set_max(1)
                        ->set_types([['type' => 'post', 'post_type' => 'page']]),
                    
                    // Bild-spezifisch
                    Field::make('image', 'crb_image', 'Bild')
                        ->set_value_type('url')
                        ->conditional('crb_box_type', '=', 'image'),
                    Field::make('select', 'crb_behavior', 'Effekt')
                        ->add_options([
                            'static'   => 'Statisch',
                            'parallax' => 'Parallax',
                            'zoom'     => 'Zoom'
                        ])
                        ->conditional('crb_box_type', '=', 'image'),
                    
                    // Video-spezifisch
                    Field::make('file', 'crb_video', 'Video')
                        ->set_type('video')
                        ->conditional('crb_box_type', '=', 'video'),
                    
                    // Gradient-spezifisch
                    Field::make('color', 'crb_gradient_start', 'Startfarbe')
                        ->conditional('crb_box_type', '=', 'gradient'),
                    Field::make('color', 'crb_gradient_end', 'Endfarbe')
                        ->conditional('crb_box_type', '=', 'gradient'),
                    
                    // Counter-spezifisch
                    Field::make('text', 'crb_counter_start', 'Startwert')
                        ->set_attribute('type', 'number')
                        ->conditional('crb_box_type', '=', 'counter')
                ])
        ]);
}