<header id="masthead" class="site-header<?php echo esc_attr( get_query_var('floating_header_class') ); ?>">
    <div class="s-container">
        <div class="site-action -left _mobile">
            <div class="nav-toggle"><em></em></div>
        </div>
        <div class="site-branding -center lg:m-0">
            <?php echo plant_logo() . plant_title(); ?>
        </div>
        <div class="site-search">
            <?php
            $code = get_theme_mod('header_search_code', '[fibosearch]');
            include_once(ABSPATH .'wp-admin/includes/plugin.php');
            if ($code == '[fibosearch]') {
                if (is_plugin_active('ajax-search-for-woocommerce/ajax-search-for-woocommerce.php')) {
                    echo do_shortcode($code);
                }
            } else {
                echo do_shortcode($code);
            }
            ?>
        </div>
        <nav class="nav-panel nav-inline">
            <?php
            dynamic_sidebar('before_nav');
            wp_nav_menu(
                [
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 's-nav'
                ]
            );
            dynamic_sidebar('after_nav');
            ?>
        </nav>
        <div class="site-action -right">
            <?php echo plant_actions('shop'); ?>
        </div>
    </div>
</header>
<nav class="nav-panel <?php echo plant_nav_position()?> -dropdown">
    <div class="nav-toggle nav-close"><em></em></div>
    <?php dynamic_sidebar('before_nav'); ?>
    <?php if (has_nav_menu('mobile')) {
        wp_nav_menu(['theme_location' => 'mobile',]);
    } else {
        wp_nav_menu(['theme_location' => 'primary',]);
    }?>
    <?php dynamic_sidebar('after_nav');?>
</nav>
<div class="site-header-space"></div>
