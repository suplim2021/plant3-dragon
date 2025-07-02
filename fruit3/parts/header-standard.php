<header id="masthead" class="site-header<?php echo esc_attr( get_query_var('floating_header_class') ); ?>">
    <div class="s-container">
        <div class="site-branding">
            <?php echo plant_logo() . plant_title(); ?>
        </div>
        <nav class="nav-panel -right nav-inline _desktop">
            <?php
            dynamic_sidebar('before_nav');
            wp_nav_menu(['theme_location' => 'primary','menu_class'     => 's-nav']);
            dynamic_sidebar('after_nav');
            ?>
        </nav>
        <div class="site-action -right">
            <?php echo plant_actions('right'); ?>
            <div class="nav-toggle _mobile"><em></em></div>
        </div>
    </div>
</header>
<nav class="nav-panel -right -dropdown">
    <div class="nav-toggle nav-close"><em></em></div>
    <?php dynamic_sidebar('before_nav'); ?>
    <?php if (has_nav_menu('mobile')) {
        wp_nav_menu(['theme_location' => 'mobile',]);
    } else {
        wp_nav_menu(['theme_location' => 'primary',]);
    }?>
    <?php dynamic_sidebar('after_nav');?>
</nav>
<div class="search-panel">
    <div class="s-container">
        <?php echo plant_search_form(); ?>
    </div>
</div>
<div class="site-header-space"></div>
