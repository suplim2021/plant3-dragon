<style>
    .top-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        overflow: hidden;
        z-index: 900;
        font-size: 0.875rem;
    }

    .top-bar .s-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
    }

    .top-bar .left,
    .top-bar .right {
        display: flex;
        align-items: center;
    }

    .site-header-space {
        height: calc(var(--s-head-height) + var(--s-topbar-height));
    }
</style>
<div class="top-bar">
    <div class="s-container">
        <div class="left">
            <?php echo do_shortcode(get_theme_mod('topbar_left')); ?>
        </div>
        <div class="right">
            <?php echo do_shortcode(get_theme_mod('topbar_right')); ?>
        </div>
    </div>
</div>