<?php

define('PLANT3_VERSION', '3.4.3');

add_action('init', 'plant_text_domain');
function plant_text_domain()
{
    load_theme_textdomain('plant', get_template_directory() . '/languages');
}

// THEME SUPPORT
if (!function_exists('plant_support')) :
    function plant_support()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('align-wide');
        add_theme_support('title-tag');
        add_theme_support('editor-color-palette', plant_colors());
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('editor-styles');
        add_editor_style('assets/css/wp-editor.css');
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'plant'),
            'mobile' => esc_html__('Mobile Menu', 'plant'),
            'left' => esc_html__('Left Menu (For Centered Logo)', 'plant'),
            'right' => esc_html__('Right Menu (For Centered Logo)', 'plant'),
        ]);
        if (!get_theme_mod('show_admin_bar', false)) {
            add_filter('show_admin_bar', '__return_false');
        }
        $GLOBALS['content_width'] = 750;
    }
endif;
add_action('after_setup_theme', 'plant_support');



// WIDGETS
if (!function_exists('plant_widgets_init')) :
    function plant_widgets_init()
    {
        register_sidebar(
            [
            'name'          => esc_html__('Header', 'plant'),
            'id'            => 'header',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="header_widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<!--',
            'after_title'   => '-->',
            ]
        );
        register_sidebar(
            [
            'name'          => esc_html__('Before Navigation', 'plant'),
            'id'            => 'before_nav',
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<!--',
            'after_title'   => '-->',
            ]
        );
        register_sidebar(
            [
            'name'          => esc_html__('After Navigation', 'plant'),
            'id'            => 'after_nav',
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<!--',
            'after_title'   => '-->',
            ]
        );
        if (class_exists('woocommerce')) {
            register_sidebar(
                [
                'name'          => esc_html__('Shop Sidebar', 'plant'),
                'id'            => 'shopbar',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
                ]
            );
        }
        if (get_option('show_on_front') == 'posts') {
            register_sidebar(
                [
                'name'          => esc_html__('Blog Introduction', 'plant'),
                'id'            => 'intro',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="blog-intro widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<!--',
                'after_title'   => '-->',
                ]
            );
        }
        register_sidebar(
            [
            'name'          => esc_html__('Right Sidebar', 'plant'),
            'id'            => 'rightbar',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
            ]
        );
        register_sidebar(
            [
            'name'          => esc_html__('Left Sidebar', 'plant'),
            'id'            => 'leftbar',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
            ]
        );

        register_sidebar(
            [
            'name'          => esc_html__('Footer', 'plant'),
            'id'            => 'footer',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="footer_widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<!--',
            'after_title'   => '-->',
            ]
        );
    }
endif;
add_action('widgets_init', 'plant_widgets_init');

// ENQUEUE CSS_JS
if (!function_exists('plant_css_js')) :
    function plant_css_js()
    {
        $ver = wp_get_theme()->get('Version');
        $url = get_template_directory_uri() . '/assets/';

        // REMOVE classic-theme-styles.css FROM WP
        wp_dequeue_style('classic-theme-styles');

        wp_enqueue_style('p-m', $url . 'css/style-m.css', [], $ver);
        wp_enqueue_style('p-d', $url . 'css/style-d.css', [], $ver, '(min-width: 1024px)');
        wp_enqueue_script('p-reframe', $url . 'js/reframe.min.js', [], $ver, true);

        if (get_theme_mod('lightgallery_enable')) {
            wp_enqueue_style('p-lg', $url . 'css/ext-lightgallery.css', [], $ver);
            wp_enqueue_script('p-lg', $url . 'js/extension/lightgallery.min.js', [], $ver, true);
        }
        if (get_theme_mod('rellax_enable')) {
            wp_enqueue_script('p-rellax', $url . 'js/extension/rellax.min.js', [], $ver, true);
        }
        if (get_theme_mod('consent_enable')) {
            wp_enqueue_style('p-consent', $url . 'css/ext-glow-cookies.css', [], $ver);
            wp_enqueue_script('p-consent', $url . 'js/extension/glow-cookies.min.js', [], $ver, true);
        }
        // SALE PAGE
        if (is_page_template('templates/salespage.php')) {
            wp_enqueue_style('p-spage', $url . 'css/ext-salespage.css', [], $ver);
            wp_enqueue_script('p-spage', $url . 'js/extension/salespage.min.js', [], $ver, true);
        }
        wp_enqueue_script('main', $url . 'js/main.js', [], $ver, true);
    }
endif;
add_action('wp_enqueue_scripts', 'plant_css_js');

// ADMIN CSS_JS
if (!function_exists('plant_admin_css_js')) :
    function plant_admin_css_js($hook)
    {
        $ver = wp_get_theme()->get('Version');
        $url = get_template_directory_uri() . '/assets/';
        wp_enqueue_style('p-admin', $url . 'css/wp-admin.css', [], $ver);
        wp_enqueue_script('p-admin', $url . 'js/wp-admin.js', [], $ver, true);
        if (!get_theme_mod('ss3_license', false)) {
            wp_enqueue_style('p-ss3', $url . 'css/wp-admin-ss3.css', [], $ver);
        }
    }
endif;
add_action('admin_enqueue_scripts', 'plant_admin_css_js');


// REMOVE "CATEGORY: ", "TAG: ", "TAXONOMY: " FROM ARCHIVE TITLE
function plant_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    return $title;
}
add_filter('get_the_archive_title', 'plant_archive_title');

// ALLOW WOFF2 UPLOAD
add_filter('wp_check_filetype_and_ext', 'plant_allow_fonts', 10, 4);
function plant_allow_fonts($types, $file, $filename, $mimes)
{
    if (false !== strpos($filename, '.woff2')) {
        $types['ext']  = 'woff2';
        $types['type'] = 'font/woff2|application/octet-stream|font/x-woff2';
    }
    return $types;
}
function plant_mime_types($mimes)
{
    $mimes['woff2'] = 'font/woff2|application/octet-stream|font/x-woff2';
    return $mimes;
}
add_filter('upload_mimes', 'plant_mime_types');


// REMOVE SVG FILTER FROM WP
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

// INCLUDE FILES
require get_template_directory() . '/inc/inc.php';

// INCLUDE API
if (!class_exists('WC_AM_Client_2_9_3')) {
    require get_template_directory() . '/api.php';
}

if (class_exists('WC_AM_Client_2_9_3')) {
    if (!function_exists('wc_am_api_key_field_display')) {
        function wc_am_api_key_field_display($key, $data_key, $data)
        {
            return substr($key, 0, 4) . "••••••••••••••••••" . substr($key, -4, 4);
        }
    }
    add_filter('wc_am_api_key_field_value', 'wc_am_api_key_field_display', 10, 3);
    $plant_license = new WC_AM_Client_2_9_3(__FILE__, '', PLANT3_VERSION, 'theme', 'https://th.seedwebs.com', 'License: Plant 3');
}
