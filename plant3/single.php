<?php get_header(); 
$sidebar = get_theme_mod('single_sidebar', 'none');
if ($sidebar != 'none') {
    echo '<div class="site-' . $sidebar . 'bar">';
}
?>
<main id="main" class="site-main single-main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_plant_single_title();
            echo '<div class="single-content">';
            do_action('plant_before_single_content');
            the_content();
            do_action('plant_after_single_content');
            edit_post_link('EDIT', '', '', null, 'btn-edit');
            echo '</div>';
        }
    }
    ?>
    <?php
    get_template_part('parts/single', 'meta');
    get_template_part('parts/single', 'author');
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    get_template_part('parts/single', 'related');
    ?>
</main>

<?php 
if ($sidebar != 'none') {
    echo '<div class="site-sidebar widget-area">';
    dynamic_sidebar($sidebar . 'bar');
    echo '</div>';
    echo '</div>';
}
get_footer(); 
?>