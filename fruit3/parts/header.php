<header id="masthead" class="site-header<?php echo esc_attr( get_query_var('floating_header_class') ); ?>">
    <div class="s-container">
        <div class="site-action -left">
            <?php echo plant_actions('left'); ?>
        </div>
        <div class="site-branding -center">
            <?php echo plant_logo() . plant_title(); ?>
        </div>
        <div class="site-action -right">
            <?php echo plant_actions('right'); ?>
        </div>
    </div>
</header>
<nav class="nav-panel <?php echo plant_nav_position()?>">
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
