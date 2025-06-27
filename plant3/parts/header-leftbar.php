<style>
    @media(min-width: 1024px) {
        .header-left {
            --s-head-text: var(--s-nav-text);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            width: var(--s-nav-width);
            color: var(--s-nav-text);
            background: var(--s-nav-bg);
            padding: 20px;
            z-index: 8020;
        }

        .header-left a {
            color: var(--s-nav-text);
        }

        .site-header {
            background: none;
            position: unset;
            height: unset;
        }

        .site-header .s-container {
            display: block;
            height: unset;
            padding: 0;
        }

        .nav-panel {
            position: relative;
            height: unset;
            width: 100%;
            left: 0;
            opacity: 1;
            padding-top: 20px;
        }

        .nav-panel ul {
            padding: 0;
        }

        .nav-panel li {
            width: 100%;
        }

        .site-content {
            padding: 10px 0 0 var(--s-nav-width);
        }

        .site-footer {
            padding-left: var(--s-nav-width);
        }

        .site-main .alignwide {
            margin-left: 0;
            margin-right: 0;
        }

        .site-main .alignfull {
            margin-left: calc(-50vw + 50% + calc(var(--s-nav-width) / 2));
            margin-right: calc(-50vw + 50% + calc(var(--s-nav-width) / 2));
            max-width: calc(100vw - var(--s-nav-width));
        }

        .btn-edit {
            left: unset;
            right: 16px;
        }
    }
</style>
<div class="header-left">
    <header id="masthead" class="site-header">
        <div class="s-container">
            <div class="site-action -left _mobile">
                <?php echo plant_actions('left'); ?>
            </div>
            <div class="site-branding -center">
                <?php echo plant_logo() . plant_title(); ?>
            </div>
            <div class="site-action -right _mobile">
                <?php echo plant_actions('right'); ?>
            </div>
        </div>
    </header>
    <nav class="nav-panel -left">
        <div class="nav-toggle nav-close _mobile"><em></em></div>
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
</div>