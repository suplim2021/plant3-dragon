<?php

get_header();

$class = 'shop-full';
$toggle = $shopbar = '';

if (is_shop()) {
    echo plant_page_title(wc_get_page_id('shop'));
} else {
    if (function_exists('rank_math_the_breadcrumbs')) {
        rank_math_the_breadcrumbs();
    } else {
        woocommerce_breadcrumb();
    }
}

if (is_shop() or is_product_category() or is_product_tag()) {
    $shopbar = get_theme_mod('shop_bar', 'left');
    if ($shopbar) {
        $class = 'shop-bar -' . $shopbar;
        $w_class = 'shop-widgets -' . $shopbar;
        if (get_theme_mod('shop_stickybar', false)) {
            $w_class .= ' sticky-bar';
        }
        if (get_theme_mod('shop_hide_filter_button', false)) {
            $w_class .= ' active';
        } else {
            $toggle = '<div class="shop-widgets-toggle">' . plant_icon('filter') . '</div>';
        }
    }
}

echo '<main id="main" class="shop-main ' . $class  . '">';

if ($shopbar) {
    echo '<aside id="secondary" class="' . $w_class . ' _h">';
    if (is_active_sidebar('shopbar')) {
        dynamic_sidebar('shopbar');
    } else {
        echo '<h2>' . __('Shop Sidebar', 'plant') . '</h2>';
        echo '<p>' . __('Please go to Appearance → Widgets → Shop Sidebar, and add some widgets.', 'plant') . '</p>';
        echo '<p>' . __('Or disable Sidebar via Appearance → Customize → WooCommerce → More Shop Settings → Shop Sidebar → Disabled', 'plant') . '</p>';
    }
    echo '</aside>';
}

echo '<div id="primary" class="shop-content">' . $toggle;
if (is_shop() and (get_theme_mod('shop_custom_page', false))) {
    /* Use Shop Page, not Archive Product */
    $q = new WP_Query(array( 'page_id' => wc_get_page_id('shop') ));
    while ($q->have_posts()) {
        $q->the_post();
        the_content();
        edit_post_link('EDIT', '', '', null, 'btn-edit');
    }
} else {
    woocommerce_content();
}
echo ' </div>';
echo ' </main>';

get_footer();
