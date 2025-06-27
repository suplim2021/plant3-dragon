<?php get_header(); ?>
<?php
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
<main id="main" class="site-main <?php echo plant_content_width(); ?>">
    <?php echo plant_page_title(); ?>
    <div class="page-content">
        <?php
        the_content();
        if (!is_front_page()) {
            do_action('plant_page_meta');
        }
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        edit_post_link('EDIT', '', '', null, 'btn-edit');
        ?>
    </div>
</main>
<?php
    endwhile;
endif;
?>
<?php get_footer(); ?>