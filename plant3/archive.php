<?php
get_header();
$sidebar = get_theme_mod('archive_sidebar', 'none');
if ($sidebar != 'none') {
    echo '<div class="site-' . $sidebar . 'bar">';
}
?>
<main id="main" class="site-main -wide">
    <header class="page-header <?php echo plant_page_title_css(); ?>">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description _space">', '</div>');
        ?>
    </header>
    <?php
    if (have_posts()) {
        $term = get_queried_object();
        echo '<div class="s-grid ' . plant_grid_columns_css($term) . '">';
        $vars = plant_content_vars();
        while (have_posts()) {
            the_post();
            get_template_part('parts/content', plant_content_template($term), $vars);
        }
        echo '</div>';
        echo plant_paging();
    } else {
        get_template_part('parts/content', 'none');
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