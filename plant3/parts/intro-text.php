<style>
.blog-intro {
    min-height: 300px;
    margin-bottom: var(--s-space);
    overflow: hidden;
}

.blog-intro h2 {
    font-size: 1.8em;
    margin-bottom: 0.5rem;
}

.blog-intro-text {
    padding: 40px 0;
    text-align: center;
}
</style>
<div class="blog-intro alignfull">
    <div class="s-container">
        <div class="blog-intro-text s-lax" data-rellax-speed="-2" 
        data-rellax-xs-speed="-3" data-rellax-mobile-speed="-3">
            <?php
            $txt = get_theme_mod('blog_intro_text');
            if ($txt) {
                echo do_shortcode($txt);
            } else {
                echo '<h2>' . get_bloginfo('name') .  '</h2>';
                echo '<h3>' .  get_bloginfo('description') . '</h3>';
                echo do_shortcode('[s_social]');
            }
            ?>
        </div>
    </div>
</div>
<?php
    echo get_theme_mod('blog_intro_latest', '<h2 class="text-center alignwide">' . __('Latest', 'plant') . '</h2>');
?>