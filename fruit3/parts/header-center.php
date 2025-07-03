<style>
    :root {
        --s-logo-space: 2.5rem;
    }

    .nav-inline {
        flex: 1;
    }

    .nav-left {
        justify-content: flex-end;
        padding-right: var(--s-logo-space);
    }

    .nav-right {
        justify-content: flex-start;
        padding-left: var(--s-logo-space);
    }

    .site-header.active {
        top: 0;
    }
</style>
<header id="masthead" class="site-header<?php echo esc_attr( get_query_var('floating_header_class') ); ?>">
    <div class="s-container">
        <div class="site-action -left">
            <?php echo plant_actions('left'); ?>
        </div>
        <nav class="nav-panel nav-inline nav-left _desktop">
            <?php if(has_nav_menu('left')): ?>
            <?php wp_nav_menu(['theme_location' => 'left','menu_class' => 's-nav']); ?>
            <?php else: ?>
            <div class="s-nav">
                <small><code>Please add Left Menu via Appearance → Menus.</code></small>
            </div>
            <?php endif; ?>
        </nav>
        <div class="site-branding -center">
            <?php echo plant_logo() . plant_title(); ?>
        </div>
        <nav class="nav-panel nav-inline nav-right _desktop">
            <?php if(has_nav_menu('right')): ?>
            <?php wp_nav_menu(['theme_location' => 'right','menu_class' => 's-nav']); ?>
            <?php else: ?>
            <div class="s-nav">
                <small><code>Please add Right Menu via Appearance → Menus.</code></small>
            </div>
            <?php endif; ?>
        </nav>
        <div class="site-action -right">
            <?php echo plant_actions('right'); ?>
        </div>
    </div>
</header>
<?php $floating = get_query_var('floating_header_class'); ?>
<nav class="nav-panel <?php echo plant_nav_position()?> -dropdown">
    <?php if (!$floating): ?>
    <div class="nav-toggle nav-close"><em></em></div>
    <?php endif; ?>
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
