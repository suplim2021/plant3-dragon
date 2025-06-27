<?php

// FIX CUSTOMIZER
if (!function_exists('plant_html_tag')) :
    function plant_html_tag()
    {
        if (is_user_logged_in() && get_theme_mod('show_admin_bar', false)) {
            global $wp_customize;
            if (!isset($wp_customize)) {
                return 'class="logged-in"';
            }
        }
    }
endif;

// LOGO
if (!function_exists('plant_logo')) :
    function plant_logo()
    {
        if (get_theme_mod('svg_logo', '')) {
            return '<a href="' . esc_url(home_url()) . '" class="site-logo" title="Logo">' . get_theme_mod('svg_logo', '') . '</a>';
        } else {
            return get_custom_logo();
        }
    }
endif;

// WEB TITLE
if (!function_exists('plant_title')) :
    function plant_title()
    {
        if (get_theme_mod('hide_title', false)) {
            return;
        }
        if (is_front_page() && is_home()) {
            $tag = 'h1';
        } else {
            $tag = 'p';
        }
        return '<' . $tag . ' class="site-title"><a href="' . esc_url(home_url()) . '" rel="home">' .
        get_bloginfo('name') . '</a></' . $tag . '>';
    }
endif;

// SEARCH
if (!function_exists('plant_search_form')) :
    function plant_search_form()
    {
        $placeholder = get_theme_mod('search_placeholder', __('Enter Search Keyword', 'plant'));
        return '<form role="search" method="get" class="search-form" action="' . home_url('/') . '" >' .
            '<label class="screen-reader-text" for="s">' . __('Search for:') . '</label>' .
            '<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="' .
            $placeholder . '" /></form>';
    }
endif;

// MEMBER AVATAR
if (!function_exists('plant_member')) :
    function plant_member()
    {
        $user       = wp_get_current_user();
        if (class_exists('woocommerce')) {
            $member_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
        } else {
            $member_url = '/my-account/';
        }
        $member_url = get_theme_mod('member_url', $member_url);

        $output = '<a href="' . sanitize_url($member_url) . '" title="Member" class="site-member">';
        if (0 != $user->ID) {
            $name = ($user->user_firstname) ? $user->user_firstname : $user->display_name;
            $name = (mb_strlen($name) > 40) ? mb_substr($name, 0, 36) . '...' : $name;
            $output .= get_avatar($user->ID, 32);
            $output .= '<span class="label">' . $name . '</span>';
        } else {
            $output .= plant_icon('user');
            $output .= '<span class="label">' . __('Member', 'plant') . '</span>';
        }
        $output .= '</a>';
        return $output;
    }
endif;

// CART ICON
if (!function_exists('plant_cart')) :
    function plant_cart()
    {
        $cart_url = '#';
        if (function_exists('wc_get_cart_url')) {
            $cart_url = wc_get_cart_url();
        }

        $count = class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : 0;
        $css_class = 'class="cart-count"';
        if ($count == 0) {
            $css_class = 'class="cart-count hide"';
        }

        return '<a class="site-cart" href="' .  $cart_url . '" title="' . __('View your shopping cart', 'plant') .
        '">' . plant_icon('cart') . '<strong id="cart-count" ' . $css_class . '><span>' . $count . '</span></strong></a>';
    }
endif;


// PAGE WIDTH
if (!function_exists('plant_content_width')) :
    function plant_content_width($id = false)
    {
        $width   = get_field('content_width', $id) ?: 'narrow';
        if ($width == 'narrow') {
            return '-narrow';
        } else {
            return '-wide';
        }
    }
endif;
// PAGE TITLE
if (!function_exists('plant_page_title')) :
    function plant_page_title($id = false)
    {
        if (!$id) {
            $id = get_the_ID();
        }
        $style = get_field('title_style', $id);
        if ($style == 'hidden') {
            return;
        }
        if (is_front_page()) {
            return;
        } else {
            $h1 = '<h1>';
            if (get_theme_mod('set_page')) {
                if (get_theme_mod('page_title_align')) {
                    $h1 =  '<h1 class="text-' . get_theme_mod('page_title_align') . '">';
                }
            }
            $head = $h1 . get_the_title($id) . '</h1>';
            $img = '';
            if ($style == 'banner') {
                if (has_post_thumbnail($id)) {
                    $img = get_the_post_thumbnail($id, 'full');
                }
                $head = '<div class="page-banner alignfull">' . $img . $head . '</div>';
            }
            return '<header class="page-header">' . $head . '</header>';
        }
    }
endif;


// PAGE TITLE CSS
if (!function_exists('plant_page_title_css')) :
    function plant_page_title_css()
    {
        if (get_theme_mod('set_page')) {
            if (get_theme_mod('page_title_align') == 'left') {
                return 'text-left';
            }
        }
        return 'text-center';
    }

endif;

// SINGLE POST TITLE
if (!function_exists('the_plant_single_title')) :
    function the_plant_single_title()
    {
        $template = get_field('title_style') ?: 'default';
        if ($template == 'default') {
            get_template_part('parts/title', get_theme_mod('set_single') ? get_theme_mod('single_title_template') : '');
        } else {
            get_template_part('parts/title', get_field('title_style'));
        }
    }
endif;

// PLACEHOLDER
if (!function_exists('plant_placeholder')) :
    function plant_placeholder($size = 'medium_large')
    {
        $img_id = get_theme_mod('content_placeholder');
        if ($img_id) {
            return wp_get_attachment_image($img_id, $size);
        } else {
            $img_src = get_template_directory_uri() . '/assets/img/placeholder.webp';
            return '<img src="' . $img_src . '" alt="placeholder" />';
        }
    }
endif;
// POST DATE
if (!function_exists('plant_date')) :
    function plant_date($s_date = null)
    {
        if ($s_date == 'hide') {
            return;
        }
        if (is_single() and get_theme_mod('single_show_date', true) == false) {
            return;
        }
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string  = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            $time_string .= '<time class="updated hide" datetime="%3$s">%4$s</time>';
        }
        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        return '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

// POST CATEGORY
if (!function_exists('plant_cat')) :
    function plant_cat($s_cat = null, $s_cat_style = null)
    {
        if ($s_cat == 'hide' || !get_the_category()) {
            return;
        }
        $max = get_theme_mod('main_cat', 'max_1');
        $num = 0;
        $output = '';
        if (!$s_cat_style) {
            $s_cat_style = substr(get_theme_mod('content_cat_style', 'f-button'), 2);
        }
        $css_class = 'posted-cat _h -' . $s_cat_style;
        switch ($max) {
            case 'max_1':
                $cat_id = 0;
                if (function_exists('the_seo_framework')) {
                    // THE SEO FRAMEWORK
                    $cat_id = tsf()->data()->plugin()->post()->get_primary_term_id(get_the_ID(), 'category');
                } elseif (function_exists('yoast_get_primary_term_id')) {
                    // YOAST
                    $cat_id = yoast_get_primary_term_id();
                }
                if (!$cat_id) {
                    // FIRST CAT
                    $cat = get_the_category();
                    if ($cat[0]) {
                        $cat_id = $cat[0]->term_id;
                    }
                }
                $link = '<a href="' . get_category_link($cat_id) . '">' . get_cat_name($cat_id) . '</a>';
                return '<div class="' . $css_class . '">' . $link . '</div>';
                break;
            case 'max_2':
                $num = 2;
                break;
            case 'max_3':
                $num = 3;
                break;
            case 'max_4':
                $num = 4;
                break;
            case 'all':
                $num = 999;
                break;
        }
        $cats = get_the_category();
        $output = '<div class="' . $css_class . '">';
        $i = 0;
        foreach ($cats as $cat) {
            $i++;
            if ($i > $num) {
                break;
            }
            $output .= '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
        }
        $output .= '</div>';
        return $output;
    }
endif;

// POST BY
if (!function_exists('plant_by')) :
    function plant_by()
    {
        return '<span class="byline"><span class="author vcard"><a class="url fn n" href="' .
        esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) .
        '</a></span></span>';
    }
endif;

// POST CATEGORIES
if (!function_exists('plant_cats')) :
    function plant_cats($css_class = '')
    {
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if (strpos($categories_list, ',')) {
                return '<div class="single_cats s-flex _h ' . $css_class . '">' .  plant_icon('folder') .  '<span>' .
                $categories_list . '</span></div>';
            }
        }
    }
endif;

// POST TAGS
if (!function_exists('plant_tags')) :
    function plant_tags($css_class = '')
    {
        if ('post' === get_post_type()) {
            $tags_list = get_the_tag_list('', ' ');
            if ($tags_list) {
                return '<div class="single_tags _h ' . $css_class . '">' . $tags_list . '</div>';
            }
        }
    }
endif;

// POST EXCERPT
if (!function_exists('plant_excerpt')) :
    function plant_excerpt($s_excerpt = null)
    {
        if ($s_excerpt == 'hide') {
            return;
        }

        if (get_theme_mod('content_excerpt') or $s_excerpt == 'show') {
            return '<p class="entry-excerpt">' . get_the_excerpt() . '</p>';
        }
    }
endif;

// POST AUTHOR
function plant_author($s_author = 'avatar', $uid = 0, $template = null)
{
    if ($s_author == 'hide') {
        return;
    }

    if (is_single() and get_theme_mod('single_show_author', true) == false) {
        return;
    }

    if ($uid == 0) {
        global $post;
        $uid = $post->post_author;
    }

    switch ($s_author) {
        case 'avatar':
            $avatar = get_avatar($uid, '24');
            $author =  $avatar . '<span class="by_date">' . plant_by() . '</span>';
            break;
        case 'avatar_date':
            $avatar = get_avatar($uid, '32');
            $author =  $avatar . '<span class="by_date">' . plant_by() . plant_date() . '</span>';
            break;
        case 'shortcode':
            $author = do_shortcode(get_theme_mod('author_template_shortcode'));
            break;
        case 'custom':
            $author = do_shortcode($template);
            break;
        case 'text':
            $author = __('By', 'plant') . plant_by() . __('On', 'plant') . plant_date();
            break;
        default:
            $avatar = get_avatar($uid, '24');
            $author =  $avatar . '<span class="by_date">' . plant_by() . '</span>';
    }

    return '<div class="entry-author -' . $s_author . '">' . $author . '</div>';
}

// POST READ MORE
if (!function_exists('plant_readmore')) :
    function plant_readmore($s_more = null)
    {
        if ($s_more == 'hide') {
            return;
        }
        if (get_theme_mod('content_readmore') or $s_more == 'show') {
            $icon = get_theme_mod('content_readmore_icon', '');
            $style = get_theme_mod('content_readmore_style', 'button');
            $text = '<span>' . get_theme_mod('content_readmore_text', __('Read more', 'plant')) . '</span>' . $icon;
            return '<div class="entry-more"><a href="' . esc_url(get_permalink()) .
            '" class="btn-readmore -' . $style . '">' .  $text . '</a></div>';
        }
    }
endif;

// DEFAULT CONTENT VARS
if (!function_exists('plant_content_vars')) :
    function plant_content_vars()
    {
        $s_cat_float = $s_cat = 'hide';
        $s_date = $s_excerpt = $s_author = $s_more = null;
        if (get_theme_mod('content_cat', true)) {
            $c_style = get_theme_mod('content_cat_style', 'f-button');
            if (substr($c_style, 0, 2) == 'f-') {
                $s_cat_float = 'show';
            } else {
                $s_cat = 'show';
            }
        }
        if (!get_theme_mod('content_date', true)) {
            $s_date = 'hide';
        }
        if (!get_theme_mod('content_author')) {
            $s_author = 'hide';
        } else {
            $s_author = get_theme_mod('author_template', 'avatar');
        }
        if (!get_theme_mod('content_excerpt')) {
            $s_excerpt = 'hide';
        }
        if (!get_theme_mod('content_readmore')) {
            $s_readmore = 'hide';
        }
        return [
            's_cat_float' => $s_cat_float,
            's_cat'      => $s_cat,
            's_date'     => $s_date,
            's_excerpt'  => $s_excerpt,
            's_author'   => $s_author,
            's_more'     => $s_more,
        ];
    }
endif;


// PAGING
if (!function_exists('plant_paging')) :
    function plant_paging($wp_query = null)
    {
        if (!$wp_query) {
            global $wp_query;
        }
        $offset_start = 0;
        $posts_per_page = isset($wp_query->query_vars['posts_per_page']) ? $wp_query->query_vars['posts_per_page'] : 0;
        $offset_start = isset($wp_query->query_vars['offset_start']) ? $wp_query->query_vars['offset_start'] : 0;
        $total_rows = max(0, $wp_query->found_posts - $offset_start);
        $total_pages = ceil($total_rows / $posts_per_page);
        $big = 9999999;
        $output = '<div class="s-paging alignwide justify-center">';
        $output .= paginate_links(
            array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'mid_size'  => 1,
                'total'     => $total_pages,
                'prev_text'  => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                'next_text'  => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>',
            )
        );
        $output .= '</div>';
        return $output;
    }
endif;

// DATA
if (!function_exists('p_data')) :
    function p_data()
    {
        $data = '';
        $data .= 'data-hfx="' . get_theme_mod('header_effect_position', 50) . '"';
        return $data;
    }
endif;
