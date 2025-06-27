<?php

// ENQUEUE CSS_JS
function fruit_scripts()
{
    $ver = wp_get_theme()->get('Version');
    $url = get_stylesheet_directory_uri() . '/assets/';
    wp_enqueue_style('f-m', $url . 'css/style-m.css', [], $ver);
    wp_enqueue_style('f-d', $url . 'css/style-d.css', [], $ver, '(min-width: 1024px)');
    wp_enqueue_script('f', $url . 'js/main.js', [], $ver, true);
}
add_action('wp_enqueue_scripts', 'fruit_scripts', 20);

// OPTIONS PAGE
// define('PLANT_ENABLE_OPTIONS_PAGE', true);

// DISABLE ACF IN PLANT
// define('PLANT_DISABLE_ACF', true);
