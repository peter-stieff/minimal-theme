<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/*
 * Diese Datei registriert eine Feldgruppe für deine Teaser-Boxen.
 * Es wird ein komplexes (repeaterartiges) Feld erstellt, in dem
 * du verschiedene Boxen anlegen kannst – z. B. Image-, Video- oder Gradient-Boxen.
 */

// Registriere die Feldgruppe, wenn Carbon Fields seine Felder laden will
add_action('carbon_fields_register_fields', 'crb_attach_teaser_fields');

function crb_attach_teaser_fields() {
    Container::make('post_meta', 'Inhalte')
        ->add_fields(array(
            Field::make('complex', 'crb_teaser_boxes', 'Teaser hinzufügen')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    // Auswahl des Box-Typs
                    Field::make('select', 'crb_box_type', 'Typ wählen')
                        ->add_options(array(
                            'image' => 'Bild',
                            'video' => 'Video',
                            'gradient' => 'Verlauf'
                        ))
                        ->set_default_value('image'),
                    // Falls der Box-Typ Gradient gewählt wurde, sollen diese Felder erscheinen:
                    Field::make('select', 'crb_gradient_predefined', 'Vordefinierter Gradient')
                        ->add_options(array(
                            'gradient-1' => 'Radial Gradient 1',
                            'gradient-2' => 'Radial Gradient 2',
                            'gradient-3' => 'Radial Gradient 3',
                            'gradient-4' => 'Radial Gradient 4',
                            'gradient-5' => 'Radial Gradient 5',
                            'gradient-6' => 'Radial Gradient 6',
                            'gradient-7' => 'Radial Gradient 7',
                            'gradient-8' => 'Radial Gradient 8',
                            'gradient-9' => 'Radial Gradient 9',
                            'gradient-10' => 'Radial Gradient 10',
                            'gradient-11' => 'Radial Gradient 11',
                            'gradient-12' => 'Radial Gradient 12',
                            'gradient-13' => 'Radial Gradient 13',
                            'gradient-14' => 'Radial Gradient 14',
                            'gradient-15' => 'Radial Gradient 15',
                            'gradient-16' => 'Radial Gradient 16',
                            'gradient-17' => 'Radial Gradient 17',
                            'gradient-18' => 'Radial Gradient 18',
                            'gradient-19' => 'Radial Gradient 19',
                            'gradient-20' => 'Radial Gradient 20',
                        ))
                        ->set_help_text('Wähle einen der vorgefertigten Gradients aus.')
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'gradient'
                            )
                        )),
                    Field::make('text', 'crb_gradient_css', 'Eigener Gradient CSS')
                        ->set_help_text('Optional: Gib hier eine eigene Gradient CSS Definition ein, z. B.: background-image: radial-gradient(circle farthest-corner at 11.4% 50%, rgba(255,37,174,1) 0%, rgba(250,237,56,1) 90%);')
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'gradient'
                            )
                        )),
                    Field::make('text', 'crb_gradient_opacity', 'Gradient Opacity (%)')
                        ->set_help_text('Gib einen Wert zwischen 0 und 100 ein.')
                        ->set_default_value('100')
                        ->set_width(25)
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'gradient'
                            )
                        )),                        
                    Field::make('text', 'crb_centered_text', 'Zentrierter Text')
                        ->set_help_text('Der Text, der über dem Overlay angezeigt wird.')
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'gradient'
                            )
                        )),
                    Field::make('color', 'crb_font_color', 'Font Farbe')
                        ->set_default_value('#000000')
                        ->set_width(25)
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'gradient'
                            )
                        )),
                
                    // Datei-Feld: Hier wird die Quelle (Bild oder Video) ausgewählt.
                    // Mit set_value_type('url') wird direkt die URL zurückgegeben.
                    // Jetzt auch für Gradient-Boxen verfügbar (als Hintergrundbild).
                    Field::make('file', 'crb_source', 'Medien-Datei')
                        ->set_value_type('url')
                        ->set_help_text('Wähle ein Bild oder Video aus. Für Gradient-Boxen wird das Bild als Hintergrund verwendet.'),
                    // Textfeld für den Titel
                    Field::make('text', 'crb_title', 'Titel'),
                    // Auswahlfeld für das Verhalten (nur für Image-Boxen sichtbar)
                    Field::make('select', 'crb_behavior', 'Verhalten')
                        ->add_options(array(
                            'static'   => 'Static',
                            'parallax' => 'Parallax',
                            'zoom'     => 'Zoom'
                        ))
                        ->set_conditional_logic(array(
                            array(
                                'field' => 'crb_box_type',
                                'value' => 'image'
                            )
                        )),
                    // Feld für einen optionalen Link (Seitenauswahl)
                    Field::make('association', 'crb_link', 'Link')
                        ->set_types(array(
                            array(
                                'type' => 'post',
                                'post_type' => 'page',
                            ),
                        ))
                        ->set_max(1) // Nur eine Seite auswählbar
                        ->set_help_text('Wähle eine Seite aus, zu der verlinkt werden soll.'),
                    // Feld für einen optionalen Tooltip
                    Field::make('text', 'crb_tooltip', 'Tooltip'),
                    // Neues Feld für die Box-Höhe
                    Field::make('text', 'crb_box_height', 'Box-Höhe (px)')
                        ->set_help_text('Gib die Höhe der Box in Pixeln ein (z. B. 200). Standard: 200px.')
                        ->set_default_value('200')
                        ->set_attribute('type', 'number')
                        ->set_attribute('min', '100')
                        ->set_attribute('max', '2000')
                ))
        ));
}