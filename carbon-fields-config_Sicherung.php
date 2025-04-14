<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/*
 * Diese Datei registriert eine Feldgruppe für deine Teaser-Boxen.
 * Es wird ein komplexes (repeaterartiges) Feld erstellt, in dem
 * du verschiedene Boxen anlegen kannst – z. B. Image- oder Video-Boxen.
 */

// Registriere die Feldgruppe, wenn Carbon Fields seine Felder laden will
add_action('carbon_fields_register_fields', 'crb_attach_teaser_fields');

function crb_attach_teaser_fields() {
    Container::make('post_meta', 'Teaser-Boxen')
        ->add_fields(array(
            Field::make('complex', 'crb_teaser_boxes', 'Teaser-Boxen')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    // Auswahl des Box-Typs
                    Field::make('select', 'crb_box_type', 'Box-Typ')
                        ->add_options(array(
                            'image' => 'Image Box',
                            'video' => 'Video Box',
                        )),
                    // Datei-Feld: Hier wird die Quelle (Bild oder Video) ausgewählt.
                    // Mit set_value_type('url') wird direkt die URL zurückgegeben.
                    Field::make('file', 'crb_source', 'Quelle (Bild oder Video)')
                        ->set_value_type('url'),
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
                    // Feld für einen optionalen Link
                    Field::make('text', 'crb_link', 'Link'),
                    // Feld für einen optionalen Tooltip
                    Field::make('text', 'crb_tooltip', 'Tooltip')
                ))
        ));
}