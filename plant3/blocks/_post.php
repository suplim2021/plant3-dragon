<?php

// Load values and assing defaults.
$content_source     = get_field('content_source') ?: 'latest';
$template           = get_field('template') ?: 'default';
$order              = get_field('order') ?: 'Latest';
$posts_per_page     = get_field('posts_per_page') ?: 3;
$offset             = get_field('offset') ?: 0;
$custom             = get_field('custom') ?: 0;
$no_rounded         = get_field('no_rounded_corners');
$show_cat           = get_field('show_cat');
$cat_style          = get_field('cat_style') ?: 'f-button';
$show_date          = get_field('show_date');
$show_excerpt       = get_field('show_excerpt');
$show_author        = get_field('show_author');
$author_tempalte    = get_field('author_tempalte') ?: 'avatar';
$template_shortcode = get_field('template_shortcode') ?: '[s_by]';
$show_readmore      = get_field('show_readmore');
$mb                 = get_field('mobile_columns') ?: 1;
$tb                 = get_field('tablet_columns') ?: 2;
$dt                 = get_field('desktop_columns') ?: 3;
$dgap               = get_field('desktop_gap') ?: '30';
$mgap               = get_field('mobile_gap') ?: '16';
$thumbnail_ratio    = get_field('thumbnail_ratio') ?: 'default';
$thumbs_gap         = get_field('thumbnail_gap');
// CPT
$custom_post_type   = get_field('custom_post_type_slug') ?: 'post';
$wp_query_args      = get_field('wp_query_args') ?: '';

$args = array(
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish'
);

if (get_field('pagination') == 'link') {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args['offset_start'] = $offset;
    $args['offset'] = ($paged - 1) * $posts_per_page + $offset;
}

switch ($content_source) {
    case 'latest':
        break;
    case 'oldest':
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
        break;
    case 'categories':
        $args['cat'] = get_field('categories');
        if ($order == 'Oldest') {
            $args['order'] = 'ASC';
        }
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    case 'custom':
        if ($custom) {
            $args['post_type'] = 'any';
            $custom_arr = array();
            foreach ($custom as $custom_post) {
                array_push($custom_arr, $custom_post);
            }
            $args['post__in'] = $custom_arr;
            $args['posts_per_page'] = count($custom_arr);
            $args['orderby'] = 'post__in';
            $args['ignore_sticky_posts'] = true;
        }
        break;
    case 'cpt':
        $args['post_type'] = $custom_post_type;
        if ($wp_query_args) {
            $wp_args = (array) json_decode($wp_query_args, true);
            if (is_array($wp_args)) {
                $args = array_replace_recursive($args, $wp_args);
            }
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
$block_class = '-m' . esc_attr($mb) . ' -t' . esc_attr($tb) . ' -d' . esc_attr($dt);


// TEMPLATE
if (strtolower($template) == 'default') {
    if (get_theme_mod('set_content_card')) {
        $template = get_theme_mod('content_template', 'default');
        $no_rounded = get_theme_mod('content_overlap_no_rounded');
        $thumbnail_ratio = 'default';
        $show_excerpt  = get_theme_mod('content_excerpt');
        $show_author = get_theme_mod('content_author');
        $show_readmore = get_theme_mod('content_readmore');
        $author_tempalte = get_theme_mod('author_template', 'avatar');
        $template_shortcode = get_theme_mod('author_template_shortcode', '[s_by]');
    } else {
        $template = 'default';
    }
    $show_date  = get_theme_mod('content_date', true);
    $show_cat = get_theme_mod('content_cat', true);
    $cat_style = get_theme_mod('content_cat_style', 'f-button');
} elseif (strtolower($template) == 'custom') {
    $template = get_field('custom_template');
}
// CSS
$css = '';
if ($thumbnail_ratio != 'default') {
    if ($thumbnail_ratio == 'responsive') {
        $m_width  = get_field('thumbnail_width_mobile') ?: 1;
        $m_height = get_field('thumbnail_height_mobile') ?: 1;
        $d_width  = get_field('thumbnail_width_desktop') ?: 2;
        $d_height = get_field('thumbnail_height_desktop') ?: 1;
        $css .= plant_ratio_css($thumbnail_ratio, $id, $m_width, $m_height, $d_width, $d_height);
    } else {
        $css .= plant_ratio_css($thumbnail_ratio, $id);
    }
}
if (get_field('thumbs') != 'hide') {
    if (!$thumbs_gap) {
        $thumbs_gap = 0;
    }
    $css .= '#' . $id . ' .s-slider{--s-thumb-gap:' . $thumbs_gap . 'px}';
}
if ($no_rounded) {
    $css .= '#' . $id . '{--s-rounded-1:0;--s-rounded-2:0}';
}
if ($dgap != '30' || $mgap != '16') {
    $css .= '#' . $id . '{--s-space:' . $mgap . 'px}';
    $css .= '@media(min-width:1024px){#' . $id . '{--s-space:' . $dgap . 'px}}';
}
if ($css) {
    echo '<style type="text/css">' . $css . '</style>';
}

// SHOW VARS
$s_cat = $s_cat_float = 'hide';
$s_date = $s_excerpt = $s_author = $s_shortcode = $s_more = null;
$s_cat_style = substr($cat_style, 2);
if ($show_cat) {
    if (substr($cat_style, 0, 1) == 'f') {
        $s_cat_float = 'show';
    } else {
        $s_cat = 'show';
    }
}
if (!$show_date) {
    $s_date = 'hide';
}
if ($show_excerpt) {
    $s_excerpt = 'show';
} else {
    $s_excerpt = 'hide';
}
if (!$show_author) {
    $s_author = 'hide';
} else {
    $s_author = $author_tempalte;
    if ($s_author == 'custom') {
        $s_shortcode = $template_shortcode;
    }
}
if ($show_readmore) {
    $s_more = 'show';
} else {
    $s_more = 'hide';
}

$vars = [
    's_cat_float' => $s_cat_float,
    's_cat'       => $s_cat,
    's_cat_style' => $s_cat_style,
    's_date'      => $s_date,
    's_excerpt'   => $s_excerpt,
    's_author'    => $s_author,
    's_shortcode' => $s_shortcode,
    's_more'      => $s_more,
];
