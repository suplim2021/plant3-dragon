<?php // Standard (Logo Center on Mobile)?>
<style>
    .site-branding {
        margin: 0 auto;
    }

    @media(min-width: 1024px) {
        .site-branding {
            margin: 0;
        }

        .site-action .nav-toggle {
            display: none;
        }
    }
</style>
<header id="masthead" class="site-header<?php echo esc_attr( get_query_var('floating_header_class') ); ?>">
    <div class="s-container">
        <div class="site-action -left _mobile">
            <?php echo plant_actions('left'); ?>
        </div>
        <div class="site-branding">
            <?php echo plant_logo() . plant_title(); ?>
        </div>
        <nav class="nav-panel -right nav-inline _desktop">
            <?php dynamic_sidebar('before_nav'); ?>
            <?php wp_nav_menu(['theme_location' => 'primary','menu_class' => 's-nav']);?>
            <?php dynamic_sidebar('after_nav');?>
        </nav>
        <div class="site-action -right">
            <div class="site-action _desktop"><?php echo plant_actions('left'); ?></div>
            <?php echo plant_actions('right'); ?>
        </div>
    </div>
</header>
<nav class="nav-panel _mobile <?php echo plant_nav_position()?> -dropdown">
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
