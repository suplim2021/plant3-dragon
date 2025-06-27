<?php

/**
 * Template Name: Left Sidebar (Sub Page)
 */

get_header();
global $post;
$parents = get_post_ancestors($post->ID);
$root_id = ($parents) ? $parents[count($parents) - 1] : $post->ID;

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
    <div class="site-sidebar widget-area _h">
        <?php
            // SUBPAGES
            if ($post->post_parent) {
                $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
            } else {
                $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
            }
            if ($childpages) {
                echo '<h2 class="widget-title">';
                echo '<a href="' . get_permalink($root_id) . '">';
                echo get_the_title($root_id);
                echo '</a></h2>';
                echo '<ul class="sub-pages">' . $childpages . '</ul>';
            }
        ?>
    </div>
</div>
<?php
    endwhile;
endif;
?>
<?php get_footer(); ?>
<?php get_footer(); ?>