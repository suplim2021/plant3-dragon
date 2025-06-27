<style>
.blog-intro {
    min-height: 200px;
    margin-bottom: var(--s-space);
}

.blog-intro .wp-block-image img {
    width: 100%;
}
</style>
<div class="blog-intro alignfull">
    <?php
    if (is_active_sidebar('intro')) {
        dynamic_sidebar('intro');
    } else {
        echo '<style>.blog-intro {background:#EFE7E1}</style>';
        echo '<div class="s-container text-center"><br><br><br>';
        echo '<h2>' . __('Blog Introduction', 'plant') . '</h2>';
        echo '<p>' . __('Please go to Appearance → Widgets → Blog Introduction, and add some widgets.', 'plant') .
             '</p>';
        echo '<br><br></div>';
    }
    ?>
</div>
<?php
    echo get_theme_mod('blog_intro_latest', '<h2 class="text-center alignwide">' . __('Latest', 'plant') . '</h2>');
?>