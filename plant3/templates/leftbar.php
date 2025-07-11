<?php

/**
 * Template Name: Left Sidebar
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
<div class="site-leftbar">
    <main id="main" class="site-main">
        <?php echo plant_page_title(); ?>
        <div class="page-content">
            <?php the_content(); ?>
            <?php edit_post_link('EDIT', '', '', null, 'btn-edit'); ?>
        </div>
    </main>
    <div class="site-sidebar widget-area">
        <?php dynamic_sidebar('leftbar'); ?>
    </div>
</div>
<?php
    endwhile;
endif;
?>
<?php get_footer(); ?>