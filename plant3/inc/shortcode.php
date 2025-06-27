<?php

// s_loop shortcode
function s_loop_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'author'                => '',
            'author_name'           => '',
            'cat'                   => '',
            'category_name'         => '',
            'ignore_sticky_posts'   => false,
            'meta_key'              => '',
            'meta_value'            => '',
            'offset'                => 0,
            'order'                 => 'DESC',
            'orderby'               => 'date',
            'post_parent'           => false,
            'post_parent__in'       => false,
            'post_parent__not_in'   => false,
            'post_status'           => 'publish',
            'post_type'             => 'post',
            'post__in'              => false,
            'post__not_in'          => false,
            'posts_per_page'        => '9',
            'tag'                   => '',
            'tax_operator'          => 'IN',
            'tax_include_children'  => true,
            'tax_term'              => false,
            'taxonomy'              => false,
            'exclude_current'       => false,
            'pagination'            => false,
            'css'                   => 's-grid -d3',
            'template'              => 'card',
        ),
        $atts,
        's_loop'
    );

    $author                = sanitize_text_field($atts['author']);
    $author_name           = sanitize_text_field($atts['author_name']);
    $cat                   = sanitize_text_field($atts['cat']);
    $category_name         = sanitize_text_field($atts['category_name']);
    $exclude_current       = filter_var($atts['exclude_current'], FILTER_VALIDATE_BOOLEAN);
    $ignore_sticky_posts   = filter_var($atts['ignore_sticky_posts'], FILTER_VALIDATE_BOOLEAN);
    $meta_key              = sanitize_text_field($atts['meta_key']);
    $meta_value            = sanitize_text_field($atts['meta_value']);
    $offset                = (int) $atts['offset'];
    $order                 = sanitize_key($atts['order']);
    $orderby               = sanitize_key($atts['orderby']);
    $post_parent           = $atts['post_parent'];
    $post_parent__in       = $atts['post_parent__in'];
    $post_parent__not_in   = $atts['post_parent__not_in'];
    $post_status           = $atts['post_status']; // Validated later as one of a few values.
    $post_type             = sanitize_text_field($atts['post_type']);
    $post__in              = $atts['post__in'];
    $post__not_in          = $atts['post__not_in'];
    $posts_per_page        = (int) $atts['posts_per_page'];
    $tag                   = sanitize_text_field($atts['tag']);
    $tax_operator          = $atts['tax_operator']; // Validated later as one of a few values.
    $tax_include_children  = filter_var($atts['tax_include_children'], FILTER_VALIDATE_BOOLEAN);
    $tax_term              = sanitize_text_field($atts['tax_term']);
    $taxonomy              = sanitize_key($atts['taxonomy']);
    $pagination            = sanitize_key($atts['pagination']);
    $css                   = sanitize_text_field($atts['css']);
    $template              = sanitize_text_field($atts['template']);

    $args = array();

    if (!empty($cat)) {
        $args['cat'] = $cat;
    }
    if (!empty($category_name)) {
        $args['category_name'] = $category_name;
    }
    if (!empty($order)) {
        $args['order'] = $order;
    }
    if (!empty($orderby)) {
        $args['orderby'] = $orderby;
    }
    if (!empty($post_type)) {
        $args['post_type'] = s_explode($post_type);
    }
    if (!empty($posts_per_page)) {
        $args['posts_per_page'] = $posts_per_page;
    }
    if (!empty($tag)) {
        $args['tag'] = $tag;
    }
    if ($ignore_sticky_posts) {
        $args['ignore_sticky_posts'] = true;
    }
    // Meta key (for ordering).
    if (!empty($meta_key)) {
        $args['meta_key'] = $meta_key;
    }
    // Meta value (for simple meta queries).
    if (!empty($meta_value)) {
        $args['meta_value'] = $meta_value;
    }
    if ($post__in) {
        $posts_in         = array_map('intval', s_explode($post__in));
        $args['post__in'] = $posts_in;
    }

    $posts_not_in = array();
    if (!empty($post__not_in)) {
        $posts_not_in = array_map('intval', s_explode($post__not_in));
    }
    if (is_singular() && $exclude_current) {
        $posts_not_in[] = get_the_ID();
    }
    if (!empty($posts_not_in)) {
        $args['post__not_in'] = $posts_not_in;
    }

    if (!empty($author)) {
        $args['author'] = $author;
    }

    if (!empty($author_name)) {
        $args['author_name'] = $author_name;
    }

    if (!empty($offset)) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args['offset_start'] = $offset;
        $args['offset'] = ($paged - 1) * $posts_per_page + $offset;
    }

    $post_status = s_explode($post_status);
    $validated   = array();
    $available   = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
    foreach ($post_status as $unvalidated) {
        if (in_array($unvalidated, $available, true)) {
            $validated[] = $unvalidated;
        }
    }
    if (!empty($validated)) {
        $args['post_status'] = $validated;
    }

    if (!empty($taxonomy) && !empty($tax_term)) {
        if ('current' === $tax_term) {
            global $post;
            $terms    = wp_get_post_terms(get_the_ID(), $taxonomy);
            $tax_term = array();
            foreach ($terms as $term) {
                $tax_term[] = $term->slug;
            }
        } else {
            // Term string to array.
            $tax_term = s_explode($tax_term);
        }
        // Validate operator.
        if (!in_array($tax_operator, array( 'IN', 'NOT IN', 'AND' ), true)) {
            $tax_operator = 'IN';
        }
        $tax_args = array(
            'tax_query' => array(
                array(
                    'taxonomy'         => $taxonomy,
                    'field'            => 'slug',
                    'terms'            => $tax_term,
                    'operator'         => $tax_operator,
                    'include_children' => $tax_include_children,
                ),
            ),
        );
        // Check for multiple taxonomy queries.
        $count            = 2;
        $more_tax_queries = false;
        while (
            isset($original_atts[ 'taxonomy_' . $count ]) && !empty($original_atts[ 'taxonomy_' . $count ]) &&
            isset($original_atts[ 'tax_' . $count . '_term' ]) && !empty($original_atts[ 'tax_' . $count . '_term' ])
        ) :
            // Sanitize values.
            $more_tax_queries     = true;
            $taxonomy             = sanitize_key($original_atts[ 'taxonomy_' . $count ]);
            $terms                = s_explode(sanitize_text_field($original_atts[ 'tax_' . $count . '_term' ]));
            $tax_operator         = isset($original_atts[ 'tax_' . $count . '_operator' ]) ? $original_atts[ 'tax_' . $count . '_operator' ] : 'IN';
            $tax_operator         = in_array($tax_operator, array( 'IN', 'NOT IN', 'AND' ), true) ? $tax_operator : 'IN';
            $tax_include_children = isset($original_atts[ 'tax_' . $count . '_include_children' ]) ? filter_var($atts[ 'tax_' . $count . '_include_children' ], FILTER_VALIDATE_BOOLEAN) : true;
            $tax_args['tax_query'][] = array(
                'taxonomy'         => $taxonomy,
                'field'            => 'slug',
                'terms'            => $terms,
                'operator'         => $tax_operator,
                'include_children' => $tax_include_children,
            );
            $count++;
        endwhile;
        if ($more_tax_queries) :
            $tax_relation = 'AND';
            if (isset($original_atts['tax_relation']) && in_array($original_atts['tax_relation'], array( 'AND', 'OR' ), true)) {
                $tax_relation = $original_atts['tax_relation'];
            }
            $args['tax_query']['relation'] = $tax_relation;
        endif;
        $args = array_merge_recursive($args, $tax_args);
    }

    if (false !== $post_parent) {
        if ('current' === $post_parent) {
            $post_parent = get_the_ID();
        }
        $args['post_parent'] = (int) $post_parent;
    }
    if (false !== $post_parent__in) {
        $args['post_parent__in'] = array_map('intval', be_dps_explode($atts['post_parent__in']));
    }
    if (false !== $post_parent__not_in) {
        $args['post_parent__not_in'] = array_map('intval', be_dps_explode($atts['post_parent__in']));
    }


    if ($pagination) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args["paged"] = $paged;
    }

    $slider_begin = $slider_end = '';
    if (substr($css, 0, 8) == 's-slider') {
        $slider_begin = '<div class="slider">';
        $slider_end = '</div>';
    }

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
        ob_start();
        echo '<div class="' . $css . '">';
        $vars = plant_content_vars();
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo $slider_begin;
            get_template_part('parts/content', $template, $vars);
            echo $slider_end;
        }
        echo '</div>';
        if ($pagination) {
            echo plant_paging($the_query);
        }
        wp_reset_query();
        return ob_get_clean();
    } else {
        return "NOT FOUND";
    }
}
add_shortcode("s_loop", "s_loop_shortcode");

// Explode list using "," and ", ".
function s_explode($string = '')
{
    $string = str_replace(', ', ',', $string);
    return explode(',', $string);
}

// SOCIAL
function plant_social($atts)
{
    $size = isset($atts['size']) ? $atts['size'] : false;
    $socials = get_theme_mod('social', [ 'facebook', 'line' ]);
    $output = '';
    if ($socials) {
        $class = $size ? 'size-' . $size : '';
        if ($size) {
            $output .= '<style>.s_social.' . $class . ' svg{width:' . $size . 'px;}</style>';
        }
        $output .= '<div class="s_social ' . $class . '">';
        foreach ($socials as $social) {
            $output .= '<a href="' . get_theme_mod('social_' . $social, '#') . '" aria-label="' . $social . '" target="_blank">';
            if (substr($social, 0, 7) == 'custom_') {
                $output .= get_theme_mod('social_icon_' . $social, '');
            } else {
                $output .= plant_icon($social);
            }
            $output .= '</a>';
        }
        $output .= '</div>';
    }
    return $output;
}
add_shortcode("s_social", "plant_social");

// SEARCH
function plant_search_icon()
{
    return '<div class="search-toggle search-toggle-icon"></div>';
}
add_shortcode("s_search", "plant_search_icon");

// META
add_shortcode('s_by', 'plant_by');
add_shortcode('s_date', 'plant_date');


// CURRENT YEAR
function plant_current_year()
{
    return date('Y');
}
add_shortcode('s_current_year', 'plant_current_year');


/**
 * [s_icon i="ICON_NAME" width="24" height="24"]
 */
function s_icon_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'i' => '',
            'width' => '24',
            'height' => ''
        ),
        $atts,
        's_icon'
    );
    $i = sanitize_text_field($atts['i']);
    $width = 'width="' . sanitize_text_field($atts['width']) . '"';
    $height = sanitize_text_field($atts['height']);
    if ($height) {
        $height = 'height="' . $height . '"';
    } else {
        $height = 'height="' . sanitize_text_field($atts['width']) . '"';
    }
    $file = get_theme_file_path('/assets/img/i/' . $i . '.svg');
    if (file_exists($file)) {
        ob_start();
        include($file);
        $output = ob_get_contents();
        ob_end_clean();
        $output = str_replace('width="24"', $width, $output);
        $output = str_replace('height="24"', $height, $output);
        return $output;
    }
}
add_shortcode("s_icon", "s_icon_shortcode");

// MY ACCOUNT
function s_myaccount()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $email = esc_html($user->user_email);
        $name = $user->display_name;
        $output  = '<div class="s-myaccount">';
        $output .= get_avatar($user->ID, 80);
        $output .= '<div class="info">';
        $output .= '<h2 class="name">' .  $name . '</h2>';
        $output .= '<p class="email">' . $email . '</p>';
        $output .= '</div>';
        $output .= '<div class="s-logout">';
        if (current_user_can('manage_options')) {
            $output .= '<a href="' . admin_url() . '" target="_blank" class="button">' .  __('Admin', 'plant') . '</a>&nbsp;&nbsp;';
        }
        $output .= '<a href="' . wp_logout_url(get_permalink()) . '" class="button">' . __('Logout', 'plant') . '</a>';
        $output .= '</div>';
        $output .= '</div>';
        return $output . s_myaccount_orders();
    }
    return;
}
add_shortcode("s_myaccount", "s_myaccount");

// PLANT_MEMBER
add_shortcode("s_member", "plant_member");

// PLANT CART
add_shortcode("s_cart", "plant_cart");

function s_myaccount_orders()
{
    // Return if no WooCommerce
    if (!class_exists('WooCommerce')) {
        return;
    }
    $my_orders_columns = apply_filters(
        'woocommerce_my_account_my_orders_columns',
        array(
        'order-number'  => esc_html__('Order', 'woocommerce'),
        'order-date'    => esc_html__('Date', 'woocommerce'),
        'order-status'  => esc_html__('Status', 'woocommerce'),
        'order-total'   => esc_html__('Total', 'woocommerce'),
        'order-actions' => '&nbsp;',
        )
    );

    $customer_orders = get_posts(
        apply_filters(
            'woocommerce_my_account_my_orders_query',
            array(
            'numberposts' => 6,
            'meta_key'    => '_customer_user',
            'meta_value'  => get_current_user_id(),
            'post_type'   => wc_get_order_types('view-orders'),
            'post_status' => array_keys(wc_get_order_statuses()),
            )
        )
    );

    if ($customer_orders) {
        $hide_recent = get_theme_mod('shop_hide_recent_order', false);
        if($hide_recent == false):
            $output  = '<div class="s-myaccount-orders">';
            $output .= '<h2>' . apply_filters('woocommerce_my_account_my_orders_title', esc_html__('Recent orders', 'woocommerce')) . '</h2>';
            $output .= '<table class="shop_table shop_table_responsive my_account_orders woocommerce-MyAccount-orders">';
            $output .= '<thead><tr>';

            foreach ($my_orders_columns as $column_id => $column_name) :
                $output .= '<th class="woocommerce-orders-table__header woocommerce-orders-table__header-' . esc_attr($column_id) . '">';
                $output .= '<span class="nobr">' . esc_html($column_name) . '</span>';
                $output .= '</th>';
            endforeach;

            $output .= '</tr></thead>';
            $output .= '<tbody>';

            foreach ($customer_orders as $customer_order) {
                $order      = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                $item_count = $order->get_item_count();
                $output .= '<tr class="order woocommerce-orders-table__row">';

                foreach ($my_orders_columns as $column_id => $column_name) :
                    $output .= '<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-' . esc_attr($column_id) . '" data-title="' . esc_attr($column_name) . '">';
                    if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) :
                        do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order);
                    elseif ('order-number' === $column_id) :
                        $output .= '<a href="' . esc_url($order->get_view_order_url()) . '">';
                        $output .= _x('#', 'hash before order number', 'woocommerce') . $order->get_order_number();
                        $output .= '</a>';
                    elseif ('order-dte' === $column_id) :
                        $output .= '<time datetime="' . esc_attr($order->get_date_created()->date('c')) . '">' . esc_html(wc_format_datetime($order->get_date_created())) . '</time>';
                    elseif ('order-status' === $column_id) :
                        $output .= esc_html(wc_get_order_status_name($order->get_status()));
                    elseif ('order-total' === $column_id) :
                        $output .= sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count);
                    elseif ('order-actions' === $column_id) :
                        $actions = wc_get_account_orders_actions($order);
                        if (!empty($actions)) {
                            foreach ($actions as $key => $action) {
                                $output .= '<a href="' . esc_url($action['url']) . '" class="button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                            }
                        }
                    endif;
                    $output .= '</td>';
                endforeach;
                $output .= '</tr>';
            }

        $output .= '</tbody>';
        $output .= '</table></div>';
        return $output;
        endif;
    }
    return;
}

// BANNER EVENT
add_shortcode("s_banners", "plant_banners");
function plant_banners($atts)
{
    $atts = [
        'date' => date_i18n('Y-m-d')
    ];

    $banner_event_enable = get_theme_mod('banner_enable', false);
    if($banner_event_enable == false) {
        return '';
    }

    $output = '';
    $banner_repeater = get_theme_mod('banner_repeater', []);

    foreach ($banner_repeater as $data) :
        $date = $data['event_date'];

        if($date == $atts['date']) {
            $pic_mobile = $data['image_mobile'];
            $pic_desktop = $data['image_desktop'];

            $output .= '<div class="p-banner _mobile">';
            $output .= '<img src="'.$pic_mobile.'" alt="'.$data['event_name'].'-m">';
            $output .= '</div>';

            $output .= '<div class="p-banner _desktop">';
            $output .= '<img src="'.$pic_desktop.'" alt="'.$data['event_name'].'-d">';
            $output .= '</div>';
            break;
        }
    endforeach;
    return $output;
}
