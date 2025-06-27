<?php
get_header();
if (is_front_page()) {
    if (get_theme_mod('set_blog_intro')) {
        get_template_part('parts/intro', get_theme_mod('blog_intro_template', 'photo'));
    } else {
        echo '<div class="_space"></div>';
    }
}
$sidebar = get_theme_mod('archive_sidebar', 'none');
if ($sidebar != 'none') {
    echo '<div class="site-' . $sidebar . 'bar">';
}
?>
<main id="main" class="site-main -wide">
    <?php if (is_home()) : ?>
        <header>
            <h1 class="page-title"><?php single_post_title(); ?></h1>
        </header>
    <?php endif; ?>
    <?php
    if (have_posts()) {
        echo '<div class="s-grid ' . plant_grid_columns_css() . '">';
        $vars = plant_content_vars();
        while (have_posts()) {
            the_post();
            get_template_part('parts/content', plant_content_template(), $vars);
        }
        echo '</div>';
        echo plant_paging();
    }
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