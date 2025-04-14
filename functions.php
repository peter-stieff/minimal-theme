<?php
// Lade den Composer-Autoloader
require_once get_stylesheet_directory() . '/vendor/autoload.php';

// Initialisiere Carbon Fields
\Carbon_Fields\Carbon_Fields::boot();

// Binde die Carbon Fields Konfiguration ein
require_once get_stylesheet_directory() . '/carbon-fields-config.php';

// Weitere Funktionen, z.B. zum Einbinden eigener Styles und Skripte:
function minimal_theme_enqueue_assets() {
    wp_enqueue_style('minimal-theme-style', get_stylesheet_uri());
    wp_enqueue_style('minimal-theme-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), '1.0');
    wp_enqueue_script('minimal-theme-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'minimal_theme_enqueue_assets');
add_filter('show_admin_bar', '__return_false');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
?>