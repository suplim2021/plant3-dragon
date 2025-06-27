<?php

if (get_locale() == 'th') {
    include_once 'woo-th.php';
}
// WOO SUPPORT
function plant_woo_setup()
{
    add_theme_support('woocommerce');
    // add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'plant_woo_setup');

// HIDE SHOP PAGE TITLE
add_filter('woocommerce_show_page_title', '__return_false');


// CHANGE BREADCRUMB
function plant_change_breadcrumb($defaults)
{
    $defaults['home'] = get_the_title(wc_get_page_id('shop'));
    $defaults['delimiter'] = '<span> › </span>';
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'plant_change_breadcrumb');

function plant_woo_home_url()
{
    return get_permalink(wc_get_page_id('shop'));
}
add_filter('woocommerce_breadcrumb_home_url', 'plant_woo_home_url');

// PLUS AND MINUS BUTTONS
function plant_minus_btn()
{
    echo '<span class="btn-minus"><svg width="10"  fill="currentColor" height="10" enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"><polygon points="4.5 4.5 3.5 4.5 0 4.5 0 5.5 3.5 5.5 4.5 5.5 10 5.5 10 4.5"></polygon></svg></span>';
}
function plant_plus_btn()
{
    echo '<span class="btn-plus"><svg width="10"  fill="currentColor" height="10" enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"><polygon points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon></svg></span>';
}
// WOO CSS/JS
function plant_woo_css()
{
    $ver = wp_get_theme()->get('Version');
    $url = get_template_directory_uri() . '/assets/';
    wp_enqueue_style('woo-m', $url . 'css/woo-m.css', [], $ver);
    wp_enqueue_style('woo-d', $url . 'css/woo-d.css', [], $ver, '(min-width: 1024px)');
    if (get_locale() == 'th') {
        wp_enqueue_style('woo-th', $url . 'css/woo-th.css', [], $ver);
    }
}
if (get_theme_mod('shop_remove_css', true)) {
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    add_action('wp_enqueue_scripts', 'plant_woo_css');
    add_action('woocommerce_before_quantity_input_field', 'plant_minus_btn');
    add_action('woocommerce_after_quantity_input_field', 'plant_plus_btn');
}
function plant_woo_js()
{
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_script('woo', get_theme_file_uri('/assets/js/woo.min.js'), array('jquery'), $ver, true);
}
add_action('wp_enqueue_scripts', 'plant_woo_js');

/* REFRESH CART COUNT */
if(get_theme_mod('shop_remove_cart_ajax', false) == false) {
    if (!function_exists('plant_cart_count')) {
        function plant_cart_count($fragments)
        {
            ob_start();
            $css_class = 'class="cart-count"';
            $count = WC()->cart->get_cart_contents_count();
            if ($count == 0) {
                $css_class = 'class="cart-count hide"';
            }
            echo '<strong id="cart-count"' . $css_class . '><span>' . $count . '</span></strong>';
            $fragments['#cart-count'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter('woocommerce_add_to_cart_fragments', 'plant_cart_count');
}

// Display the discount percentage on the sale badge.
// https://stackoverflow.com/questions/52558950/display-the-discount-percentage-on-the-sale-badge-in-woocommerce-3
add_filter('woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3);
if (!function_exists('add_percentage_to_sale_badge')) :
    function add_percentage_to_sale_badge($html, $post, $product)
    {
        if ($product->is_type('variable')) {
            $percentages = array();
            // Get all variation prices
            $prices = $product->get_variation_prices();
            foreach ($prices['price'] as $key => $price) {
                // Only on sale variations
                if ($prices['regular_price'][$key] !== $price) {
                    // Calculate and set in the array the percentage for each variation on sale
                    $percentages[] = (floatval($prices['regular_price'][ $key ]) - floatval($price)) / floatval($prices['regular_price'][ $key ]) * 100;
                }
            }
            $percentage = round(max($percentages)) . '%';
        } else {
            $regular_price = (float) $product->get_regular_price();
            if ($regular_price > 0) {
                $sale_price    = (float) $product->get_sale_price();
                $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
            }
        }
        return '<span class="onsale">' . esc_html__('Sale', 'plant') . ' ' . $percentage . '</span>';
    }
endif;

// ADD EDIT LINK ON PRODUCT
function plant_woo_edit_link()
{
    global $product;
    $edit_link = get_edit_post_link($product->get_id());
    if ($edit_link) {
        echo '<a href="' . $edit_link . '" class="btn-edit">EDIT</a>';
    }
}
add_action('woocommerce_after_single_product_summary', 'plant_woo_edit_link');

// REMOVE ADD TO CART BUTTON
if (get_theme_mod('shop_hide_add_to_cart')) {
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
}

// CROSS SELLS - 4 COLUMNS
add_filter('woocommerce_cross_sells_columns', 'plant_woo_cross_sells');
function plant_woo_cross_sells($columns)
{
    return 4;
}

// CLASS FOR CART PAGE
function plant_woo_cart_body_classes($classes)
{
    global $woocommerce;
    if (is_cart() && WC()->cart->cart_contents_count != 0) {
        $classes[] = '-has-item';
    }
    return $classes;
}
add_filter('body_class', 'plant_woo_cart_body_classes');


// THAI ADDRESS FROM POSTAL CODE
if (get_theme_mod('shop_address_filter', true)) {
    add_action('wp_footer', 'add_address_filter_elm_id');
    function add_address_filter_elm_id()
    {
        $billing_id = get_theme_mod('shop_billing_filter_position', '#billing_address_1_field');
        $shipping_id = get_theme_mod('shop_shipping_filter_position', '#shipping_address_1_field');
        $text_before = get_theme_mod('shop_filter_label_text_before', 'ที่อยู่และรหัสไปรษณีย์');
        $text_after = get_theme_mod('shop_filter_label_text_after', 'รหัสไปรษณีย์');
        ?>
<input type="hidden" class="aft-billing" value="<?php echo $billing_id; ?>">
<input type="hidden" class="aft-shipping" value="<?php echo $shipping_id; ?>">
<input type="hidden" class="aft-text-before" value="<?php echo $text_before; ?>">
<input type="hidden" class="aft-text-after" value="<?php echo $text_after; ?>">
<?php
    };

    add_action('wp_enqueue_scripts', 'shop_address_filter_js_css');
    function shop_address_filter_js_css()
    {
        $ver = wp_get_theme()->get('Version');
        $url = get_template_directory_uri() . '/assets/';

        wp_enqueue_style('woo-aft', $url . 'css/woo-aft.css', [], $ver);
        wp_enqueue_script('woo-aft', $url . 'js/woo-aft.js', [], $ver, true);

        if (class_exists('woocommerce')) {
            wp_dequeue_script('selectWoo');
            wp_deregister_script('selectWoo');
        }
    }
}

// REMOVE REVIEW
function plant_disable_woo_reviews()
{
    remove_post_type_support('product', 'comments');
}
if (get_theme_mod('shop_hide_review', true)) {
    add_action('init', 'plant_disable_woo_reviews');
}

// REMOVE RELATED PRODUCTS
if (get_theme_mod('shop_hide_related')) {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

// REMOVE DOWNLOADS MENU
if (get_theme_mod('shop_hide_downloads', true)) {
    add_filter('woocommerce_account_menu_items', 'plant_woo_remove_my_account_links');
    function plant_woo_remove_my_account_links($menu_links)
    {
        unset($menu_links['downloads']);
        return $menu_links;
    }
}

// CHAT ON LINE BUTTON
if (get_theme_mod('shop_enable_add_to_line', false) == true && class_exists('woocommerce')) {
    function plant_add_to_line_box()
    {
        $screens =  array('product');
        foreach ($screens as $screen) {
            add_meta_box(
                'plant_add_to_line_box',
                'Chat on LINE Button',
                'plant_add_to_line_box_html',
                $screen,
                'advanced',
                'low'
            );
        }
    }
    add_action('add_meta_boxes', 'plant_add_to_line_box');

    function plant_add_to_line_box_html()
    {
        $value_atl = get_post_meta(get_the_ID(), '_plant_add_to_line_button_disable', true);
        $value_atc = get_post_meta(get_the_ID(), '_plant_add_to_cart_button_disable', true);
        ?>
<div class="disable-atl">
    <input type="checkbox" name="plant_add_to_line_button_disable" id="plant_add_to_line_button_disable" value="disable" class="postbox" <?php checked($value_atl, 'disable'); ?> />
    <label for="plant_add_to_line_button_disable">Disable Chat on LINE button</label>
</div>
<div class="disable-atc">
    <input type="checkbox" name="plant_add_to_cart_button_disable" id="plant_add_to_cart_button_disable" value="disable" class="postbox" <?php checked($value_atc, 'disable'); ?> />
    <label for="plant_add_to_cart_button_disable">Disable Add to cart button</label>
</div>
<?php
    }

    function plant_add_to_line_button_save_postdata($post_id)
    {
        if (array_key_exists('plant_add_to_line_button_disable', $_POST)) {
            update_post_meta($post_id, '_plant_add_to_line_button_disable', $_POST['plant_add_to_line_button_disable']);
        } else {
            delete_post_meta($post_id, '_plant_add_to_line_button_disable');
        }

        if (array_key_exists('plant_add_to_cart_button_disable', $_POST)) {
            update_post_meta($post_id, '_plant_add_to_cart_button_disable', $_POST['plant_add_to_cart_button_disable']);
        } else {
            delete_post_meta($post_id, '_plant_add_to_cart_button_disable');
        }
    }
    add_action('save_post', 'plant_add_to_line_button_save_postdata');

    function custom_add_to_line_button_loop_shop()
    {
        global $product;
        $disable = get_post_meta($product->get_id(), '_plant_add_to_line_button_disable', true);
        $status = $disable != '' ? $disable : 'enable';

        if($status != 'disable') {
            $link_m = 'https://line.me/R/oaMessage/'.get_theme_mod('line_contact_link', '@seedwebs').'/?'.rawurlencode(__("I'm interested in ", 'plant') .get_the_permalink(get_the_ID()));
            $link_d = 'https://line.me/R/ti/p/'.get_theme_mod('line_contact_link', '@seedwebs');
            ?>
<a href="<?php echo $link_m; ?>" class="button add_to_cart_button line_chat loop _mobile" target="_blank">
    <?php echo plant_icon('line'); ?>
    <?php echo get_theme_mod('add_to_line_button_text', 'Chat on LINE'); ?>
</a>
<a href="<?php echo $link_d; ?>" class="button add_to_cart_button line_chat loop _desktop" target="_blank">
    <?php echo plant_icon('line'); ?>
    <?php echo get_theme_mod('add_to_line_button_text', 'Chat on LINE'); ?>
</a>
<?php
        }
    }
    add_action('woocommerce_after_shop_loop_item_title', 'custom_add_to_line_button_loop_shop', 40);

    function remove_add_to_cart_specific_products($add_to_cart_html, $product)
    {
        $disable = get_post_meta($product->get_id(), '_plant_add_to_cart_button_disable', true);
        $status = $disable != '' ? $disable : 'enable';

        if($status == 'disable') {
            return '';
        }
        return $add_to_cart_html;

    }
    add_filter('woocommerce_loop_add_to_cart_link', 'remove_add_to_cart_specific_products', 25, 2);

    function remove_add_to_cart_product_with_meta()
    {
        if(is_product()) {
            $disable = get_post_meta(get_the_ID(), '_plant_add_to_cart_button_disable', true);
            $status = $disable != '' ? $disable : 'enable';

            if($status == 'disable') {
                // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            }
        }
    }
    add_action('wp', 'remove_add_to_cart_product_with_meta');

    /**
     * WooCommerce Post Class filter.
     *
     * @since 3.6.2
     * @param array      $classes Array of CSS classes.
     * @param WC_Product $product Product object.
     */
    function plant_add_to_cart_class($classes, $product)
    {
        // is_product() - Returns true on a single product page
        // NOT single product page, so return
        if (!is_product()) {
            return $classes;
        }
        $disable = get_post_meta(get_the_ID(), '_plant_add_to_cart_button_disable', true);
        $status = $disable != '' ? $disable : 'enable';

        if($status == 'disable') {
            $classes[] = 'hide_add_to_cart';

        }

        return $classes;
    }
    add_filter('woocommerce_post_class', 'plant_add_to_cart_class', 10, 2);


    function custom_add_to_line_button_single()
    {
        $disable = get_post_meta(get_the_ID(), '_plant_add_to_line_button_disable', true);
        $status = $disable != '' ? $disable : 'enable';

        if($status != 'disable') {
            $link_m = 'https://line.me/R/oaMessage/'.get_theme_mod('line_contact_link', '@seedwebs').'/?'.rawurlencode(__("I'm interested in ", 'plant') .get_the_permalink(get_the_ID()));
            $link_d = 'https://line.me/R/ti/p/'.get_theme_mod('line_contact_link', '@seedwebs');
            ?>
<a href="<?php echo $link_m; ?>" class="button add_to_cart_button line_chat single _mobile" target="_blank">
    <?php echo plant_icon('line'); ?>
    <?php echo get_theme_mod('add_to_line_button_text', 'Chat on LINE'); ?>
</a>
<a href="<?php echo $link_d; ?>" class="button add_to_cart_button line_chat single _desktop" target="_blank">
    <?php echo plant_icon('line'); ?>
    <?php echo get_theme_mod('add_to_line_button_text', 'Chat on LINE'); ?>
</a>
<?php
        }
    }
    add_action('woocommerce_after_add_to_cart_button', 'custom_add_to_line_button_single', 30);
}
?>