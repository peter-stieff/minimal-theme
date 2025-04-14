<?php
/**
 * Header Template
 * 
 * Enthält:
 * - Eigenes SVG-Logo
 * - Mobile Navigation
 * - Performance-Optimierungen
 * - ARIA-Labels für Barrierefreiheit
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Performance-Critical Resources -->
    <link rel="preload" href="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/fonts/MatterSQ/MatterSQ-Regular.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/css/custom.css'); ?>" as="style">

    <?php wp_head(); ?>

    <!-- Above-the-Fold Styles -->
    <style id="critical-css">
        /* Critical CSS für Header */
        .site-header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 55px;
            background: #fff;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .logo-svg {
            width: 50px;
            height: 50px;
            transform: translateX(-9px);
        }
        .menu-btn {
            display: none; /* Standardmäßig versteckt */
        }
        @media (max-width: 768px) {
            .nav-chip { display: none; }
            .menu-btn { display: flex; }
        }
    </style>
</head>

<body <?php body_class('fonts-loading'); ?>>
    <?php wp_body_open(); ?>
    
    <header class="site-header" role="banner">
        <div class="header-inner">
            <div class="header-content">
                
                <!-- Logo Section -->
                <div class="header-left">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
                        <!-- Original SVG -->
                        <svg class="logo-svg" aria-hidden="true" focusable="false">
                            <use xlink:href="#logo-symbol"></use>
                        </svg>
                        <svg style="display:none">
                            <symbol id="logo-symbol" viewBox="0 0 403.78 377.76">
                                <!-- Original SVG Paths -->
                                <path d="M200.99,283.98c-4.32,0-8.64-1.11-12.5-3.34l-101.33-58.5c-7.71-4.45-12.5-12.75-12.5-21.65v-117c0-8.9,4.79-17.2,12.5-21.65L188.49,3.34c7.71-4.45,17.29-4.45,25,0l101.32,58.5c7.71,4.45,12.5,12.75,12.5,21.65v117c0,8.9-4.79,17.2-12.5,21.65l-101.32,58.5c-3.86,2.23-8.18,3.34-12.5,3.34ZM114.66,198.76l80.33,46.38c3.71,2.14,8.29,2.14,12,0l80.32-46.38c3.71-2.14,6-6.11,6-10.39v-92.75c0-4.29-2.29-8.25-6-10.39l-80.32-46.38c-3.71-2.14-8.29-2.14-12,0l-80.32,46.38c-3.71,2.14-6,6.11-6,10.39v92.75c0,4.29,2.29,8.25,6,10.39ZM196.49,32.78s.01,0,.02.01h-.02Z"/>
                                <path d="M200.99,236.33c-3.12,0-6.23-.8-9.01-2.41l-66.64-38.48c-5.57-3.22-9-9.16-9-15.59v-76.96c0-6.42,3.46-12.4,9.02-15.6l66.63-38.47c5.54-3.2,12.44-3.21,18,0l67.15,38.77c8.13,4.69,10.92,15.09,6.22,23.22-4.69,8.13-15.09,10.92-23.22,6.22l-55.15-31.84c-2.48-1.43-5.52-1.43-8,0l-42.65,24.62c-2.48,1.43-4,4.07-4,6.93v49.25c0,2.86,1.52,5.5,4,6.93l42.65,24.63c2.48,1.43,5.52,1.43,8,0l55.15-31.84c8.04-4.64,18.29-1.97,23.06,5.94s1.81,18.96-6.44,23.72l-66.77,38.55c-2.78,1.6-5.89,2.4-9,2.4ZM208.97,204.47h.02s-.01,0-.02,0ZM142.37,116.73l-.03.02s.02-.01.03-.02ZM209,78.26h-.02s.01,0,.02,0Z"/>
                                <circle cx="189.64" cy="141.99" r="18"/>
                            </symbol>
                        </svg>
                        <span class="logo-text"><?php bloginfo('name'); ?></span>
                    </a>
                </div>

                <!-- Main Navigation -->
                <nav class="nav-chip" role="navigation" aria-label="Hauptmenü">
                    <?php wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'nav-menu',
                        'depth'          => 1
                    ]); ?>
                </nav>

                <!-- Mobile Toggle -->
                <button class="menu-btn" id="menu-btn" aria-label="Mobile Navigation öffnen" aria-expanded="false">
                    <span class="hamburger-box">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </span>
                </button>

                <!-- Social Links -->
<?php /*
<div class="header-social">
    <a href="https://instagram.com" class="social-link" target="_blank" rel="noopener" aria-label="Instagram">
        <svg class="social-icon" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12 0C8.74..."/>
        </svg>
    </a>
</div>
*/ ?>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-nav-overlay" id="mobile-nav-overlay" aria-hidden="true">
        <nav class="mobile-nav" role="navigation" aria-label="Mobile Navigation">
            <?php wp_nav_menu([
                'theme_location' => 'mobile',
                'container'      => false,
                'menu_class'     => 'mobile-nav-menu',
                'depth'         => 1
            ]); ?>
        </nav>
    </div>

    <!-- Main Content -->
    <main id="main-content" class="site-content" role="main">