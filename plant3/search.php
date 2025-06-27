<?php get_header(); ?>
<main id="main" class="site-main">
    <header>
        <h1>
        <?php printf(__('Search Results for: %s', 'shape'), '<span>' . get_search_query() . '</span>'); ?>
        </h1>
    </header>
    <?php if (have_posts()) : ?>
    <div class="s-grid">
        <?php
        while (have_posts()) {
            the_post();
            get_template_part('parts/content', 'search');
        }
        ?>
    </div>
        <?php echo plant_paging(); ?>
    <?php else : ?>
        <?php get_template_part('parts/content', 'none');?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>