<?php

// Load values and assing defaults.
$content_source     = get_field('product_source') ?: 'latest';
$template           = get_field('template') ?: 'card';
$posts_per_page     = get_field('posts_per_page') ?: '4';
$custom             = get_field('custom') ?: 0;
$dt                 = get_field('desktop_columns') ?: 4;
$dgap   = get_field('desktop_gap') ?: '30';
$mgap   = get_field('mobile_gap') ?: '16';
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page,
    'post_status'    => 'publish'
);
switch ($content_source) {
    case 'latest':
        break;
    case 'categories':
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => get_field('categories'),
            ]
        ];
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    case 'custom':
        if ($custom) {
            $custom_arr = array();
            foreach ($custom as $custom_post) {
                array_push($custom_arr, $custom_post);
            }
            $args['post__in'] = $custom_arr;
            $args['posts_per_page'] = count($custom_arr);
            $args['orderby'] = 'post__in';
        }
        break;
    default:
        break;
}


// Create id attribute allowing for custom "anchor" value.
$id = $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$wp_class = '';
if (!empty($block['className'])) {
    $wp_class .= $block['className'];
}
if (!empty($block['align'])) {
    $wp_class .= ' align' . $block['align'];
}
$block_class = 'columns-' . esc_attr($dt);
