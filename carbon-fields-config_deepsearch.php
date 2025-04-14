<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_teaser_fields');

function crb_attach_teaser_fields() {
    Container::make('post_meta', 'Advanced Box Settings')
        ->add_fields(array(
            Field::make('complex', 'crb_teaser_boxes', 'Teaser Boxen')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    // Allgemeine Felder für alle Box-Typen
                    Field::make('select', 'crb_box_type', 'Box Typ')
                        ->add_options([
                            'image' => 'Bild',
                            'video' => 'Video',
                            'gradient' => 'Verlauf'
                        ])
                        ->set_default_value('image'),
                    
                    // ==== Allgemeine Einstellungen ====
                    Field::make('separator', 'crb_general_sep', 'Allgemeine Einstellungen'),
                    Field::make('text', 'crb_box_height', 'Box-Höhe (vh)')
                        ->set_attribute('type', 'number')
                        ->set_default_value('30')
                        ->set_help_text('Höhe in Viewport-Höhen (1-100)'),
                    
                    Field::make('checkbox', 'crb_has_zoom', 'Zoom-Effekt')
                        ->set_option_value('yes')
                        ->set_conditional_logic([[
                            'field' => 'crb_box_type',
                            'value' => 'image'
                        ]]),
                    
                    // ==== Image-spezifische Einstellungen ====
                    Field::make('separator', 'crb_image_sep', 'Bild-Einstellungen')
                        ->set_conditional_logic([[
                            'field' => 'crb_box_type',
                            'value' => 'image'
                        ]]),
                    
                    Field::make('number', 'crb_parallax_strength', 'Parallax-Stärke')
                        ->set_default_value(0.3)
                        ->set_step(0.1)
                        ->set_min(0.1)
                        ->set_max(1.0),
                    
                    Field::make('select', 'crb_image_scale', 'Zoom-Stärke')
                        ->add_options([
                            '1.03' => '5%',
                            '1.1' => '10%',
                            '1.2' => '20%'
                        ])
                        ->set_default_value('1.03')
                        ->set_conditional_logic([[
                            'field' => 'crb_has_zoom',
                            'value' => true
                        ]]),
                    
                    // ==== Gradient-Erweiterungen ====
                    Field::make('separator', 'crb_gradient_sep', 'Verlauf-Einstellungen')
                        ->set_conditional_logic([[
                            'field' => 'crb_box_type',
                            'value' => 'gradient'
                        ]]),
                    
                    Field::make('select', 'crb_blend_mode', 'Blend Mode')
                        ->add_options([
                            'normal' => 'Normal',
                            'multiply' => 'Multiply',
                            'overlay' => 'Overlay',
                            'darken' => 'Darken'
                        ])
                        ->set_default_value('overlay'),
                    
                    Field::make('select', 'crb_gradient_type', 'Verlaufs-Typ')
                        ->add_options([
                            'linear' => 'Linear',
                            'radial' => 'Radial',
                            'conic' => 'Conic'
                        ])
                        ->set_default_value('radial'),
                    
                    Field::make('text', 'crb_text_shadow', 'Textschatten')
                        ->set_default_value('2px 2px 4px rgba(0,0,0,0.3)'),
                    
                    // ==== Textformatierung ====
                    Field::make('separator', 'crb_text_sep', 'Textformatierung')
                        ->set_conditional_logic([[
                            'field' => 'crb_box_type',
                            'value' => ['image', 'gradient']
                        ]]),
                    
                    Field::make('select', 'crb_font_size', 'Schriftgröße')
                        ->add_options([
                            'text-xs' => 'Klein',
                            'text-md' => 'Mittel',
                            'text-xl' => 'Groß'
                        ])
                        ->set_default_value('text-md'),
                    
                    Field::make('color', 'crb_text_color', 'Textfarbe')
                        ->set_default_value('#ffffff'),
                    
                    Field::make('select', 'crb_text_align', 'Textausrichtung')
                        ->add_options([
                            'left' => 'Links',
                            'center' => 'Mitte',
                            'right' => 'Rechts'
                        ])
                        ->set_default_value('center'),
                    
                    // ... Restliche bestehende Felder ...
                ))
        ));
}