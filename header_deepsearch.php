<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/MatterHQ/MatterSQ-Regular.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/custom.css" as="style">

    <?php wp_head(); ?>

    <!-- Critical Inline CSS -->
    <style>
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 55px;
            background: #fff;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .logo-svg {
            height: 50px;
            width: auto;
            transition: fill 0.3s ease;
        }
    </style>
</head>

<body <?php body_class('fonts-loading'); ?>>
    <header class="site-header">
        <div class="header-inner">
            <div class="header-content">
                <!-- Left Header Section -->
                <div class="header-left">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="Startseite">
                        <!-- Original SVG Logo -->
                        <svg class="logo-svg" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 403.78 377.76">
                            <path d="M200.99,283.98c-4.32,0-8.64-1.11-12.5-3.34l-101.33-58.5c-7.71-4.45-12.5-12.75-12.5-21.65v-117c0-8.9,4.79-17.2,12.5-21.65L188.49,3.34c7.71-4.45,17.29-4.45,25,0l101.32,58.5c7.71,4.45,12.5,12.75,12.5,21.65v117c0,8.9-4.79,17.2-12.5,21.65l-101.32,58.5c-3.86,2.23-8.18,3.34-12.5,3.34ZM114.66,198.76l80.33,46.38c3.71,2.14,8.29,2.14,12,0l80.32-46.38c3.71-2.14,6-6.11,6-10.39v-92.75c0-4.29-2.29-8.25-6-10.39l-80.32-46.38c-3.71-2.14-8.29-2.14-12,0l-80.32,46.38c-3.71,2.14-6,6.11-6,10.39v92.75c0,4.29,2.29,8.25,6,10.39ZM196.49,32.78s.01,0,.02.01h-.02Z" fill="#000000"/>
                            <path d="M200.99,236.33c-3.12,0-6.23-.8-9.01-2.41l-66.64-38.48c-5.57-3.22-9-9.16-9-15.59v-76.96c0-6.42,3.46-12.4,9.02-15.6l66.63-38.47c5.54-3.2,12.44-3.21,18,0l67.15,38.77c8.13,4.69,10.92,15.09,6.22,23.22-4.69,8.13-15.09,10.92-23.22,6.22l-55.15-31.84c-2.48-1.43-5.52-1.43-8,0l-42.65,24.62c-2.48,1.43-4,4.07-4,6.93v49.25c0,2.86,1.52,5.5,4,6.93l42.65,24.63c2.48,1.43,5.52,1.43,8,0l55.15-31.84c8.04-4.64,18.29-1.97,23.06,5.94s1.81,18.96-6.44,23.72l-66.77,38.55c-2.78,1.6-5.89,2.4-9,2.4ZM208.97,204.47h.02s-.01,0-.02,0ZM142.37,116.73l-.03.02s.02-.01.03-.02ZM209,78.26h-.02s.01,0,.02,0Z" fill="#000000"/>
                            <circle cx="189.64" cy="141.99" r="18" fill="#000000"/>
                        </svg>
                        <span class="logo-text">Creovate</span>
                    </a>
                </div>

                <!-- Middle Header Section -->
                <div class="header-middle">
                    <nav class="nav-chip" aria-label="Hauptnavigation">
                        <a href="#" class="nav-link">Home</a>
                        <a href="#" class="nav-link">Über</a>
                        <a href="#" class="nav-link">Leistungen</a>
                        <a href="#" class="nav-link">Kontakt</a>
                    </nav>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="menu-btn" id="menu-btn" aria-label="Menü öffnen">
                        <svg class="hamburger-icon" viewBox="0 0 24 24">
                            <rect x="3" y="6" width="18" height="2"/>
                            <rect x="3" y="11" width="18" height="2"/>
                            <rect x="3" y="16" width="18" height="2"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Navigation Overlay -->
                <div class="mobile-nav-overlay" id="mobile-nav-overlay">
                    <div class="mobile-nav-content">
                        <a href="#" class="close-link" aria-label="Menü schließen">&times;</a>
                        <nav class="mobile-nav" aria-label="Mobile Navigation">
                            <a href="#" class="mobile-nav-link">Home</a>
                            <a href="#" class="mobile-nav-link">Über</a>
                            <a href="#" class="mobile-nav-link">Leistungen</a>
                            <a href="#" class="mobile-nav-link">Kontakt</a>
                        </nav>
                    </div>
                </div>

                <!-- Right Header Section -->
                <div class="header-right">
                    <div class="social-icons">
                        <a href="https://www.instagram.com/colabs.aus/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <svg class="social-icon" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0..."/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/colabs.australia" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <svg class="social-icon" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627..."/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main id="main-content" class="site-content">