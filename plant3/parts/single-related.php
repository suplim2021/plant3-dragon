<?php
if (!get_theme_mod('single_show_related', true) or !is_singular('post')) {
    return;
}
// CHECK IF RELATED POSTS EXIST
$show_related = false;
$total = get_theme_mod('single_related_num', 3);
$related_posts = [];
$pid = get_the_ID();
$ramdom = get_field('random', $pid);

if (have_rows('related', $pid)) {
    $show_related = true;
} else {
    $check_query = new WP_Query(
        [
            'category__in' => wp_get_post_categories($pid),
            'post__not_in' => [$pid],
        ]
    );
    if ($check_query->have_posts()) {
        $show_related = true;
    }
}
if (!$show_related) {
    return;
}
?>
<div class="s-sec single-related alignfull">
    <div class="s-container">
        <h2 class="text-center"><?php echo get_theme_mod('single_related_title', 'Related Posts'); ?></h2>
        <div class="s-grid -m1 -t2 -d3">
            <?php

            if (have_rows('related', $pid)) {
                while (have_rows('related', $pid)) {
                    the_row();
                    $related_posts[] =  get_sub_field('post');
                }
            }

            if (empty($related_posts)) {
                $more = $total;
            } else {
                $args = array(
                    'post__in' => $related_posts,
                    'orderby' => 'post__in',
                    'posts_per_page' => count($related_posts)
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    $vars = plant_content_vars();
                }
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    get_template_part('parts/content', plant_content_template(), $vars);
                }
                wp_reset_postdata();
                $more = $total - count($related_posts);
            }

            if ($ramdom) {
                $args = array(
                    'post__not_in' => [$pid],
                    'orderby' => 'rand',
                    'posts_per_page' => $total,
                    'category__in' => wp_get_post_categories($pid),
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    $vars = plant_content_vars();
                }
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    get_template_part('parts/content', plant_content_template(), $vars);
                }
                wp_reset_postdata();
            } elseif ($more > 0) {
                $related_posts[] = $pid;
                $args = array(
                    'post__not_in' => $related_posts,
                    'category__in' => wp_get_post_categories($pid),
                    'posts_per_page' => $more
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    $vars = plant_content_vars();
                }
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    get_template_part('parts/content', plant_content_template(), $vars);
                }
                wp_reset_postdata();
            }
?>
        </div>
    </div>
</div>