<?php

// TEMPLATE TAGS
require_once 'template-tags.php';

// ICONS
require_once 'icons.php';

// KIRKI
require_once 'vendor/kirki/kirki.php';


// KIRKI PRO
if (!defined('KIRKI_PRO_VERSION')) {
    include_once 'vendor/kirki-pro/vendor/autoload.php';
    new \Kirki\Pro\Init();
}


// KIRKI INI
require_once 'kirki-ini/kirki-ini.php';

// LINE MASSAGING
require_once 'line-massaging.php';

// WEBHOOK
require_once 'webhook.php';

// ACF
if (!defined('PLANT_DISABLE_ACF')) {
    define('P_ACF_PATH', get_template_directory() . '/inc/vendor/acf/');
    define('P_ACF_URL', get_template_directory_uri() . '/inc/vendor/acf/');
    include_once P_ACF_PATH . 'acf.php';
    add_filter('acf/settings/url', 'plant_acf_settings_url');
    function plant_acf_settings_url($url)
    {
        return P_ACF_URL;
    }
}
// ACF - Options Page
if (!function_exists('plant_options_page')) :
    function plant_options_page()
    {
        if(function_exists('acf_add_options_page')) {
            acf_add_options_page();
        }
    }
endif;
if (defined('PLANT_ENABLE_OPTIONS_PAGE')) {
    plant_options_page();
}

// ACF - Disable Curly Quotes
function custom_acf_format_value($value, $post_id, $field)
{
    remove_filter('the_content', 'wptexturize');
    return $value;
}
add_filter('acf/format_value/name=wp_query_args', 'custom_acf_format_value', 10, 3);

// WOOCOMMERCE
if (class_exists('WooCommerce')) {
    require_once 'woo/woo.php';
}

// SHORTCODE
require_once 'shortcode.php';

// BLOCKS
require_once 'blocks.php';

// TGMPA
require_once 'vendor/TGMPA/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'plant_register_required_plugins');
function plant_register_required_plugins()
{
    $plugins = [
        [
            'name'               => 'Smart Slider 3 Pro',
            'slug'               => 'nextend-smart-slider3-pro',
            'source'             => get_template_directory() . '/inc/vendor/nextend/smartslider-3.5.1.27.zip',
            'required'           => false,
            'version'            => '3.5.1.27',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        [
            'name'               => 'One Click Demo Import',
            'slug'               => 'one-click-demo-import',
            'source'             => get_template_directory() . '/inc/vendor/OCDI/one-click-demo-import.3.3.0.zip',
            'required'           => false,
            'version'            => '3.3.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],

    ];
    $config  = [
        'id'           => 'plant',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    ];
    tgmpa($plugins, $config);
}

// AUTO CREATE HOME PAGE
add_action('after_switch_theme', 'plant_create_home_page');
function plant_create_home_page()
{
    if (!get_option('page_on_front')) {
        $qr_slug = get_posts(['post_type' => 'page', 'name' => 'home', 'post_status' => 'all']);
        if (!$qr_slug) {
            $qr_title = get_posts(['post_type' => 'page', 'title' => 'Home', 'post_status' => 'all']);
            if (!$qr_title) {
                $content = '<!-- wp:group {"className":"text-center","layout":{"type":"constrained"}} --><div class="wp-block-group text-center"><!-- wp:paragraph --><p></p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Welcome to</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">PLANT THEME</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"_member"} --><p class="_member">Please click on the "EDIT" button<br>at the bottom left corner of the page.</p><!-- /wp:paragraph --></div><!-- /wp:group -->';
                $homepage = array(
                    'post_title'   => 'Home',
                    'post_content' => $content,
                    'post_status'  => 'publish',
                    'post_author'  => 1,
                    'post_type'    => 'page',
                );
                $homepage_id = wp_insert_post($homepage);
                update_option('show_on_front', 'page');
                update_option('page_on_front', $homepage_id);
            }
        }
    }
}

// PLANT HEADER
function the_plant_head()
{
    if (get_theme_mod('fe_code_header', '')) {
        echo get_theme_mod('fe_code_header', '');
    }
    the_plant_head_more();
    if (get_theme_mod('fe_code_css', '')) {
        echo '<style id="fe_css" type="text/css">' . get_theme_mod('fe_code_css', '') . '</style>';
    }
}
add_action('wp_head', 'the_plant_head');

// PLANT FOOTER
function the_plant_footer()
{
    echo get_theme_mod('fe_code_footer', '');
}
add_action('wp_footer', 'the_plant_footer');

// ADMIN HEADER
function the_plant_admin_head()
{
    the_plant_head_more();
    if (get_theme_mod('be_code_css', '')) {
        echo '<style id="be_css" type="text/css">' . get_theme_mod('be_code_css') . '</style>';
    }
}
add_action('admin_head', 'the_plant_admin_head');


// FOR SEED STAT PRO PLUGIN
if (function_exists('run_Seed_Stat')) {
    add_action('plant_end_single_date', 'plant_add_stat');
    add_action('plant_page_meta', 'plant_add_stat');

    if (!function_exists('plant_add_stat')) :
        function plant_add_stat()
        {
            echo do_shortcode('[s_stat]');
        }
    endif;
}

// ADD DEFAULT AVATAR
if (!function_exists('plant_avatar_defaults')) :
    function plant_avatar_defaults($avatar_defaults)
    {
        $myavatar = get_theme_file_uri('/assets/img/avatar.png');
        $avatar_defaults[$myavatar] = "Default Avatar";
        return $avatar_defaults;
    }
endif;
add_filter('avatar_defaults', 'plant_avatar_defaults');


/**
 * Theme Demo.
 */
if (class_exists('OCDI_Plugin')) {
    require_once 'demo.php';
}
