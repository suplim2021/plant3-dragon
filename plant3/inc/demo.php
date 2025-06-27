<?php
/**
 * Theme Demo Importer
 *
 * https://ocdi.com/quick-integration-guide/
 */

function ocdi_import_files()
{
    return [
      [
        'import_file_name'           => 'Plant 3 • ตัวอย่างเทมเพลต',
        'categories'                 => [ 'GenerateBlocks'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/plant3/plant3.content.xml',
        'import_widget_file_url'     => 'https://i.seedwebs.com/ocdi/plant3/plant3.widgets.wie',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/plant3/plant3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/plant3/preview.jpg',
        'preview_url'                => 'https://plant3.seeddemo.com/',
      ],
      [
        'import_file_name'           => 'Ongkorn • เว็บองค์กร',
        'categories'                 => [ 'Corporate', 'GenerateBlocks'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/ongkorn3/ongkorn3.content.xml',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/ongkorn3/ongkorn3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/ongkorn3/preview.jpg',
        'preview_url'                => 'https://ongkorn3.seeddemo.com/',
      ],
      [
        'import_file_name'           => 'Ranka • เว็บร้านค้า',
        'categories'                 => [ 'E-Commerce'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/ranka3/ranka3.content.xml',
        'import_widget_file_url'     => 'https://i.seedwebs.com/ocdi/ranka3/ranka3.widgets.wie',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/ranka3/ranka3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/ranka3/preview.jpg',
        'preview_url'                => 'https://ranka3.seeddemo.com/',
      ],
      [
        'import_file_name'           => 'SalesPage • เว็บเซลเพจ',
        'categories'                 => [ 'E-Commerce'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/salespage3/salespage3.content.xml',
        'import_widget_file_url'     => 'https://i.seedwebs.com/ocdi/salespage3/salespage3.widgets.wie',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/salespage3/salespage3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/salespage3/preview.jpg',
        'preview_url'                => 'https://salespage3.seeddemo.com/',
      ],
      [
        'import_file_name'           => 'Magazine • เว็บแมกาซีน',
        'categories'                 => [ 'Magazine'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/magazine3/magazine3.content.xml',
        'import_widget_file_url'     => 'https://i.seedwebs.com/ocdi/magazine3/magazine3.widgets.wie',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/magazine3/magazine3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/magazine3/preview.jpg',
        'preview_url'                => 'https://magazine3.seeddemo.com/',
      ],
      [
        'import_file_name'           => 'Mu • เว็บสายมู',
        'categories'                 => [ 'Magazine'],
        'import_file_url'            => 'https://i.seedwebs.com/ocdi/mu3/mu3.content.xml',
        'import_widget_file_url'     => 'https://i.seedwebs.com/ocdi/mu3/mu3.widgets.wie',
        'import_customizer_file_url' => 'https://i.seedwebs.com/ocdi/mu3/mu3.customizer.dat',
        'import_preview_image_url'   => 'https://i.seedwebs.com/ocdi/mu3/preview.jpg',
        'preview_url'                => 'https://mu3.seeddemo.com/',
      ],
    ];
}
add_filter('ocdi/import_files', 'ocdi_import_files');

function ocdi_register_plugins($plugins)
{

    $theme_plugins = [];

    // Check if user is on the theme recommeneded plugins step and a demo was selected.
    if (
        isset($_GET['step']) &&
        $_GET['step'] === 'import' &&
        isset($_GET['import'])
    ) {

        // Plant
        if ($_GET['import'] === '0') {
            $theme_plugins = [
              [
                'name'     => 'GenerateBlocks',
                'slug'     => 'generateblocks',
                'required' => true,
              ]
            ];
        }

        // Ongkorn & SalesPage
        if ($_GET['import'] === '1' ||  $_GET['import'] === '3') {
            $theme_plugins = [
              [
                'name'     => 'Forminator',
                'slug'     => 'forminator',
                'required' => true,
            ],
            [
                'name'     => 'GenerateBlocks',
                'slug'     => 'generateblocks',
                'required' => true,
              ]
            ];
        }

        // Ranka Demo Import
        if ($_GET['import'] === '2') {
            $theme_plugins = [
              [
                'name'     => 'WooCommerce',
                'slug'     => 'woocommerce',
                'required' => true,
              ],
              [
                'name'     => 'FiboSearch – Ajax Search for WooCommerce',
                'slug'     => 'ajax-search-for-woocommerce',
                'required' => true,
              ],
              [
                'name'     => 'Premmerce Product Filter for WooCommerce',
                'slug'     => 'premmerce-woocommerce-product-filter',
                'required' => true,
              ],
            ];
        }

        // Magazine
        if ($_GET['import'] === '4') {
            $theme_plugins = [
              [
                'name'     => 'GenerateBlocks',
                'slug'     => 'generateblocks',
                'required' => true,
              ],
              [
                'name'     => 'One User Avatar | User Profile Picture',
                'slug'     => 'one-user-avatar',
                'required' => false,
              ],
            ];
        }

        // MU Demo Import
        if ($_GET['import'] === '5') {
            $theme_plugins = [
              [
                'name'     => 'WooCommerce',
                'slug'     => 'woocommerce',
                'required' => true,
              ],
              [
                'name'     => 'Filter Everything — Product Filter & WordPress Filter',
                'slug'     => 'filter-everything',
                'required' => true,
              ],
              [
                'name'     => 'GenerateBlocks',
                'slug'     => 'generateblocks',
                'required' => true,
              ]
            ];
        }
    }

    return array_merge($plugins, $theme_plugins);
}
add_filter('ocdi/register_plugins', 'ocdi_register_plugins');

// Remove posts, pages, and widgets
function ocdi_before_content_import($selected_import)
{
    $posts = get_posts(array(
        'post_type' => ['post', 'page'],
        'numberposts' => 20,
        'post_status' => 'any'
    ));
    foreach ($posts as $post) {
        wp_delete_post($post->ID);
    }
}
add_action('ocdi/before_content_import', 'ocdi_before_content_import');


function ocdi_after_import_setup()
{

    // Assign menus
    $main_menu = get_term_by('slug', 'main', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'primary' => $main_menu->term_id,
        'mobile' => $main_menu->term_id,
    ));

    // Assign front page.
    $front_page_id = get_page_by_path('home-2');

    if (!$front_page_id) {
        $front_page_id = get_page_by_path('home');
    }
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);

    $blog_page_id = get_page_by_path('news');

    if ($blog_page_id) {
        update_option('page_for_posts', $blog_page_id->ID);
    }

    // WooCommerce
    if (class_exists('woocommerce')) {

        $page_shop = get_page_by_path('shop');
        update_option('woocommerce_shop_page_id', $page_shop->ID);

        $page_cart = get_page_by_path('cart');
        update_option('woocommerce_cart_page_id', $page_cart->ID);

        $page_checkout = get_page_by_path('checkout');
        update_option('woocommerce_checkout_page_id', $page_checkout->ID);

        $page_terms = get_page_by_path('terms-and-conditions');
        update_option('woocommerce_terms_page_id', $page_terms->ID);

        $page_account = get_page_by_path('my-account');
        update_option('woocommerce_myaccount_page_id', $page_account->ID);
    }

    // PERMALINKS
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
}
add_action('ocdi/after_import', 'ocdi_after_import_setup');




// Disable GenerateBlocsk Redirect
function ocdi_change_activation_redirect()
{
    return false;
}
add_filter('generateblocks_do_activation_redirect', 'ocdi_change_activation_redirect', 10, 3);
