<?php get_header(); ?>
<main id="main" class="site-main -wide">
    <header class="page-header header-author <?php echo plant_page_title_css(); ?>">
        <div class="author-pic">
            <?php $author = get_user_by('slug', get_query_var('author_name')); ?>
            <?php echo get_avatar($author->ID, apply_filters('author_bio_avatar_size', 80)); ?>
        </div>
        <div class="author-info">
            <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description _space">', '</div>');
        ?>
        </div>
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
<?php get_footer(); ?>