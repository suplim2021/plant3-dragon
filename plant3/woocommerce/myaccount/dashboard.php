<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (get_theme_mod('shop_dashboard_begin')) {
    echo '<div class="shop-begin">' . do_shortcode(get_theme_mod('shop_dashboard_begin')) . '</div>';
}

if (get_theme_mod('shop_announcement')) {
    echo '<div class="shop-announcement">' . get_theme_mod('shop_announcement') . '</div>';
}

if (get_theme_mod('shop_dashboard_end', '[s_myaccount]')) {
    echo '<div class="shop-end">' . do_shortcode(get_theme_mod('shop_dashboard_end', '[s_myaccount]')) . '</div>';
}

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');
