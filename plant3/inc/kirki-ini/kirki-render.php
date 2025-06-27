<?php

function plant_font_google($name, $weight, $weight_alt)
{
    $name   = preg_replace('!\s+!', ' ', $name);
    $weight = 'wght@' . $weight;
    if ($weight_alt) {
        $weight .= ';' . $weight_alt;
    }
    $h  = '<link rel="preconnect" href="https://fonts.googleapis.com">';
    $h .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    $h .= '<link href="https://fonts.googleapis.com/css2?family=' . $name . ':' . $weight;
    $h .= '&display=swap" rel="stylesheet">';
    $c = '';
    return [$name, $h, $c,];
}

function plant_font_adobe($name, $code)
{
    $h = $code;
    $c = '';
    return [$name, $h, $c,];
}

function plant_font_upload($name, $weight, $file, $weight_alt, $file_alt)
{
    if (!$name) {
        $name = 'uploaded-' . $weight;
    }
    $h  = '';
    $c  = '@font-face{';
    $c .= 'font-family:"' . $name . '";';
    $c .= 'src:url("' . $file . '") format("woff2");';
    $c .= 'font-weight:' . $weight . ';';
    $c .= 'font-style:normal;font-display:swap;';
    $c .= '}';
    if ($file_alt) {
        $c .= '@font-face{';
        $c .= 'font-family:"' . $name . '";';
        $c .= 'src:url("' . $file_alt . '") format("woff2");';
        $c .= 'font-weight:' . $weight_alt . ';';
        $c .= 'font-style:normal;font-display:swap;';
        $c .= '}';
    }
    return [$name, $h, $c,];
}

function the_plant_head_more()
{
    $html = $css = $name = $h = $c = '';
    if (is_admin()) {
        $selector = 'div.editor-styles-wrapper';
    } else {
        $selector = ':root';
    }
    // BODY FONT
    $body_source = get_theme_mod('fonts_body_source', 'system');
    switch ($body_source) {
        case 'google':
            [$name, $h, $c,] = plant_font_google(
                get_theme_mod('fonts_body_google', 'Sarabun'),
                get_theme_mod('fonts_body_weight_normal', '400'),
                get_theme_mod('fonts_body_weight_strong', '700')
            );
            break;
        case 'adobe':
            [$name, $h, $c,] = plant_font_adobe(
                get_theme_mod('fonts_body_adobe', 'sans-serif'),
                get_theme_mod('fonts_body_adobe_code', '')
            );
            break;
        case 'upload':
            [$name, $h, $c,] = plant_font_upload(
                get_theme_mod('fonts_body_upload', 'sans-serif'),
                get_theme_mod('fonts_body_weight_normal', '400'),
                get_theme_mod('fonts_body_file_normal', ''),
                get_theme_mod('fonts_body_weight_strong', '700'),
                get_theme_mod('fonts_body_file_strong', ''),
            );
            break;
    }
    $html .= $h;
    if ($name) {
        $css  .= $c . $selector . '{--s-body:"' . $name . '"}';
    }

    // HEADING FONT
    if (get_theme_mod('fonts_head_title', false)) :
        $head_source = get_theme_mod('fonts_head_source', 'system');
        $weight = get_theme_mod('fonts_head_weight', '500');
        switch ($head_source) {
            case 'google':
                [$name, $h, $c,] = plant_font_google(
                    get_theme_mod('fonts_head_google', 'IBM Plex Sans Thai'),
                    $weight,
                    false
                );
                break;
            case 'adobe':
                [$name, $h, $c,] = plant_font_adobe(
                    get_theme_mod('fonts_head_adobe', 'sans-serif'),
                    get_theme_mod('fonts_head_adobe_code', '')
                );
                break;
            case 'upload':
                [$name, $h, $c,] = plant_font_upload(
                    get_theme_mod('fonts_head_upload', 'sans-serif'),
                    $weight,
                    get_theme_mod('fonts_head_file', ''),
                    false,
                    false
                );
                break;
        }
        $html .= $h;
        $css  .= $c . $selector . '{--s-heading:"' . $name . '";--s-heading-weight:' . $weight . '}';
    endif;

    // ALT HEADING FONT
    if (get_theme_mod('fonts_alt_head_title', false)) :
        $head_source = get_theme_mod('fonts_alt_head_source', 'system');
        $weight = get_theme_mod('fonts_alt_head_weight', '700');
        switch ($head_source) {
            case 'google':
                [$name, $h, $c,] = plant_font_google(
                    get_theme_mod('fonts_alt_head_google', 'IBM Plex Sans Thai'),
                    $weight,
                    false
                );
                break;
            case 'adobe':
                [$name, $h, $c,] = plant_font_adobe(
                    get_theme_mod('fonts_alt_head_adobe', 'sans-serif'),
                    get_theme_mod('fonts_alt_head_adobe_code', '')
                );
                break;
            case 'upload':
                [$name, $h, $c,] = plant_font_upload(
                    get_theme_mod('fonts_alt_head_upload', 'sans-serif'),
                    $weight,
                    get_theme_mod('fonts_alt_head_file', ''),
                    false,
                    false
                );
                break;
        }
        $html .= $h;
        $css  .= $c . $selector . '{--s-heading-alt:"' . $name . '";--s-heading-alt-weight:' . $weight . '}';
    endif;

    // FRONTEND: MORE CSS
    if (!is_admin()) {
        $css  .= plant_kirki_css();
    }
    echo $html . '<style id="plant-css" type="text/css">' . $css . '</style>';
}
// CSS
function plant_kirki_css()
{
    $css = $header_width = '';
    // HEADER
    $header_width = get_theme_mod('header_width', 'full');
    if ($header_width == 'full') {
        $css .= '.site-header .s-container, .top-bar .s-container{max-width:100%;padding: 0 var(--s-space)}';
    } elseif ($header_width == 'boxed') {
        $css .= '@media(min-width: 1024px){';
        $css .= '.site-header,.search-panel{';
        $css .= 'max-width:calc(var(--s-container-width) - 2 * var(--s-gap));';
        $css .= 'margin-left:auto;margin-right:auto;left:0;right:0}';
        $css .= '.site-header .s-container{max-width:100%;padding: 0 var(--s-space)}';
        $css .= '.site-header{border-bottom-right-radius:var(--s-rounded-2);';
        $css .= 'border-bottom-left-radius:var(--s-rounded-2);}';
        $css .= '}';
    }
    if (get_theme_mod('set_topbar', false)) {
        $css .= '.site-header{top:var(--s-topbar-height)}';
        $css .= ':root{--s-head-height:calc(var(--s-topbar-height) + var(--s-head-height))}';
    }

    // EFFECT
    $h_effect = get_theme_mod('header_effect', 'none');
    if ($h_effect != 'none') {
        switch ($h_effect) {
            case 'fixed':
                $css .= 'html{scroll-padding-top:calc(var(--s-head-height) + var(--s-topbar-height,0))}';
                $css .= '.site-header,div.top-bar{position:fixed}';
                $css .= '.site-header.active{filter:drop-shadow(var(--s-shadow-2))}';
                break;
            case 'scroll_fixed':
                $css .= '.site-header,div.top-bar{position:fixed}';
                $css .= '.site-header.active{filter:drop-shadow(var(--s-shadow-2))}';
                // no break
            case 'scroll':
                $css .= 'html{scroll-padding-top:var(--s-head-height)}';
                $css .= 'body.home .site-header-space{display:none}';
                $css .= 'body.home .site-header{position:fixed;transform: translateY(-80px);opacity:0;}';
                $css .= 'body.home .site-header.active' .
                        '{opacity:1;transform:translateY(0);filter:drop-shadow(var(--s-shadow-2))}';
                break;
        }
    }
    // OVERLAY
    if (get_theme_mod('header_overlay', false)) {
        $css .= '.home .site-header-space{display:none}';
        $css .= '.home .site-header:not(.active){background:none;box-shadow:none;}';
    }
    // HIDE BRAND
    if (get_theme_mod('header_hide_brand', false)) {
        $css .= '.home .site-branding{visibility:hidden;opacity:0;}';
    }
    // BODY
    if (get_theme_mod('set_header_colors', false) and get_theme_mod('header_space', true)) {
        $css .= '.site-header-space{margin-bottom:var(--s-space)}';
        $css .= 'body.home.page .site-header-space{margin-bottom:0}';

    }
    // CARD OVERLAP
    if (get_theme_mod('content_template') == 'overlap' and get_theme_mod('content_overlap_no_rounded', true)) {
        $css .= '.s-content-overlap{--s-rounded-1:0;--s-rounded-2:0}';
    }
    // THUBNAIL RATIO
    $css .= plant_ratio_css(get_theme_mod('content_pic_ratio', 'og'));

    // SHOP
    if (class_exists('WooCommerce')) {
        if (is_product() and get_theme_mod('shop_hide_tab', true)) {
            $css .= '.wc-tabs{display: none;}.wc-tab{display: block !important;}';
        }
        if (get_theme_mod('shop_breadcrumb_center', false)) {
            $css .= '.woocommerce-breadcrumb{text-align:center}';
        }
    }
    // EXCERPT MAX LINES
    $max_lines = get_theme_mod('content_excerpt_max', '2');
    if ($max_lines != '2') {
        $css .= '.entry-excerpt{-webkit-line-clamp:' . $max_lines . '}';
    }
    // FOOTERBAR UPPERCASE
    if (!get_theme_mod('footer_bar_text_uppercase', true)) {
        $css .= '.footer-bar{text-transform: unset}';
    }

    return $css;
}
function plant_kirki_responsive($field, $css)
{
    $field  = get_theme_mod($field, []);
    $output = '';
    if ($field['mobile']) {
        $output .= '@media(max-width:719px){' . $css . '}';
    }
    if ($field['tablet']) {
        $output .= '@media(min-width:720px) and (max-width:1023px){' . $css . '}';
    }
    if ($field['desktop']) {
        $output .= '@media (min-width:1024px){' .  $css . '}';
    }
    return $output;
}
// THUBNAIL RATIO CSS
function plant_ratio_css($ratio, $id = null, $m_width = null, $m_height = null, $d_width = null, $d_height = null)
{
    if ($id) {
        $id = '#' . $id . ' ';
    }
    switch ($ratio) {
        case 'og':
            return $id . '.entry-pic{padding-top: 52.5%}';
        case '3_2':
            return $id . '.entry-pic{padding-top:66.666666%}';
        case '1_1':
            return $id . '.entry-pic{padding-top:100%}';
        case '4_5':
            return $id . '.entry-pic{padding-top:125%}';
        case '1_1_to_2_1':
            return $id . '.entry-pic{padding-top:100%}@media(min-width:1024px){' . $id . '.entry-pic{padding-top:50%}}';
        case 'custom':
            $width  = get_theme_mod('content_pic_width', 1200);
            $height = get_theme_mod('content_pic_height', 630);
            $percent = ($height / $width)  * 100;
            return '.entry-pic{padding-top:' . number_format($percent, 6, '.', '') . '%}';
        case 'responsive':
            if (!$m_width) {
                $m_width = 1;
            }
            if (!$d_width) {
                $d_width = 1;
            }
            $m_percent = ($m_height / $m_width)  * 100;
            $d_percent = ($d_height / $d_width)  * 100;
            $output  = $id . '.entry-pic{padding-top:' . number_format($m_percent, 6, '.', '') . '%}';
            $output .= '@media(min-width:1024px){' . $id . '.entry-pic{padding-top:' .
                number_format($d_percent, 6, '.', '') . '%}}';
            return $output;
    }
}
// RESPONSIVE S-GRID
function plant_grid_columns_css($term = null)
{
    if ($term) {
        $template = get_field('content_template', $term) ?: 'default';
        if ($template != 'default') {
            $col_d = get_field('desktop_columns', $term) ?: 3;
            $col_t = get_field('tablet_columns', $term) ?: 2;
            $col_m = get_field('mobile_columns', $term) ?: 1;
            return '-m' . $col_m . ' -t' . $col_t . ' -d' . $col_d;
        }
    }

    if (!get_theme_mod('set_archive', false)) {
        return '-t2 -d3';
    }

    $cols  = get_theme_mod('grid_columns', []);
    $col_d = isset($cols['desktop']) ? $cols['desktop'] : '3';
    $col_t = isset($cols['tablet']) ? $cols['tablet'] : '2';
    $col_m = isset($cols['mobile']) ? $cols['mobile'] : '1';
    return '-m' . $col_m . ' -t' . $col_t . ' -d' . $col_d;
}
// CONTENT TEMPLATE
function plant_content_template($term = null)
{
    if ($term) {
        $template = get_field('content_template', $term) ?: 'default';
        if ($template != 'default') {
            return strtolower($template);
        }
    }

    if (!get_theme_mod('set_content_card', false)) {
        return '';
    }
    return get_theme_mod('content_template');
}

// COLORS
function plant_colors()
{
    $colors_brand_ini   = [
        'color-1' => '#235B95',
        'color-2' => '#4E9FD6',
        'color-3' => '#47BE9D',
        'color-4' => '#67D88F',
        'color-5' => '#FFA900',
        'color-6' => '#FF4D00',
    ];
    $colors_content_ini = [
        'text-1'   => '#222222',
        'text-2'   => '#71767f',
        'bg-1'     => '#ffffff',
        'bg-2'     => '#f5f5f7',
        'border-1' => '#d5d5d7',
        'border-2' => '#e5e5e7',
    ];
    $colors_brand       = get_theme_mod('colors_brand', $colors_brand_ini);
    $colors_content     = get_theme_mod('colors_content', $colors_content_ini);
    $colors             = array_merge(
        array_replace($colors_brand_ini, $colors_brand),
        array_replace($colors_content_ini, $colors_content)
    );
    $palette            = [];
    foreach ($colors as $name => $color) {
        array_push(
            $palette,
            [
            'name'  => $name,
            'slug'  => $name,
            'color' => $color,
            ]
        );
    }
    return $palette;
}

// ACTIONS
function plant_actions($position)
{
    switch ($position) {
        case 'left':
            $actions =  [ 'menu' ];
            if (get_theme_mod('set_action_left')) {
                $actions = get_theme_mod('action_left', [ 'menu' ]);
            }
            break;
        case 'right':
            $actions = [ 'search' ];
            if (get_theme_mod('set_action_right')) {
                $actions = get_theme_mod('action_right', [ 'search' ]);
            }
            break;
        case 'shop':
            $actions = [ 'member', 'cart' ];
            if (get_theme_mod('set_action_shop')) {
                $actions = get_theme_mod('action_shop', [ 'member', 'cart' ]);
            }
            break;
    }
    $output = '';
    if ($actions) {
        foreach ($actions as $action) {
            $output .= plant_action($action);
        }
    }
    return $output;
}
function plant_action($action)
{
    switch ($action) {
        case 'menu':
            return '<div class="nav-toggle"><em></em></div>';
        case 'search':
            return '<div class="search-toggle search-toggle-icon"></div>';
        case 'member':
            return plant_member();
        case 'cart':
            return plant_cart();
        case 'left_custom':
            return do_shortcode(get_theme_mod('action_left_custom'));
        case 'right_custom':
            return do_shortcode(get_theme_mod('action_right_custom'));
        case 'shop_custom':
            return do_shortcode(get_theme_mod('action_shop_custom'));
    }
}
function plant_nav_position()
{
    if (in_array('menu', get_theme_mod('action_right', [ 'search' ]))) {
        return ' -right';
    }
}

// ======== EXTENSIONS ========

// COOKIE CONSENT
function the_plant_cookie_consent()
{
    ?>
<script>
    glowCookies.start('<?php echo substr(get_locale(), 0, 2); ?>', {
        style: 1,
        analytics: '<?php echo get_theme_mod("analytics"); ?>',
        facebookPixel: '<?php echo get_theme_mod("facebook_pixel"); ?>',
        position: '<?php echo get_theme_mod("consent_position", "left"); ?>',
        policyLink: '<?php echo get_theme_mod("policy_Link", "/privacy/"); ?>',
        bannerHeading: 'none',
        hideAfterClick: true,
        bannerLinkText: '<?php echo get_theme_mod("policy_Link_text", "Privacy Policy."); ?>',
        bannerDescription: '<?php echo get_theme_mod("consent_message"); ?>',
        acceptBtnText: '<?php echo get_theme_mod("accept_text", "ACCEPT"); ?>',
        rejectBtnText: '<?php echo get_theme_mod("reject_text", "REJECT"); ?>',
        <?php if (get_theme_mod('googletagmanager')) :?>
        customScript: [{
            type: 'src',
            position: 'head',
            content: 'https://www.googletagmanager.com/gtag/js?id=<?php echo get_theme_mod('googletagmanager'); ?>'
        }]
        <?php endif; ?>
    });
</script>
<?php
}
if (get_theme_mod('consent_enable')) {
    add_action('wp_footer', 'the_plant_cookie_consent', 20);
}


// WEBP THUMBNAILS
if (get_theme_mod('set_webp')) {
    add_filter('image_editor_output_format', function ($formats) {
        $formats['image/jpeg'] = 'image/webp';
        $formats['image/png'] = 'image/webp';
        return $formats;
    });
}

// CHAT BUTTONS
if (get_theme_mod('buttons_enable')) {
    add_action('wp_footer', 'plant_chat_button_display');
}

function plant_chat_button_display()
{
    echo '<a id="s-chat" class="s-chat">';
    $chat_icon = get_theme_mod('buttons_icon', 'chat');
    if ($chat_icon == 'custom') {
        echo '<img src="' . get_theme_mod('buttons_custom_image') . '" alt="" width="40px" hieght="40px">';
    } else {
        seed_icon('s-' . $chat_icon);
    }
    $buttons_icon_message = get_theme_mod('buttons_icon_message', 'Message us');
    if ($buttons_icon_message) {
        echo '<div class="c-desc">' . $buttons_icon_message . '</div>';
    }
    if ($chat_icon != 'custom') {
        echo '<span>';
        seed_icon('x');
        echo '</span>';
    }
    echo '</a>';

    $channels = get_theme_mod('buttons_channels', array( 'messenger', 'line', 'mobile' ));
    echo '<ul id="s-chat-panel">';
    $chat_plugin = false;
    foreach ($channels as $channel) {
        if ($channel == 'messenger' && get_theme_mod('buttons_use_chat_plugin', 0)) {
            $chat_plugin = true;
            if ($chat_plugin) {
                echo '<li class="c-tip -chat-plugin">';
                echo '<div class="fb-customerchat" attribution=setup_tool page_id="' .
                trim(get_theme_mod('buttons_messenger_id', '')) . '" minimized="true"></div>';
                echo '<div class="c-desc">' . get_theme_mod('buttons_' . $channel . '_tooltip', ucfirst($channel)) .
                '</div>';
                ?>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v9.0'
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php
                echo '</li>';
            }
        } else {
            s_chat_output($channel);
        }
    }
    echo '</ul>';
}

function s_chat_output($channel)
{
    $link_prefix = '';
    $tooltip = '';
    if ($channel == 'email') {
        $link_prefix = 'mailto:';
    } elseif ($channel == 'mobile' || $channel == 'phone') {
        $link_prefix = 'tel:';
        $tooltip = ': ' . get_theme_mod('buttons_' . $channel . '_url', '');
    }
    echo '<li class="c-tip -' . $channel . '"><a href="' . $link_prefix . get_theme_mod('buttons_' .
    $channel . '_url', '#') . '" target="_blank">';
    if (substr($channel, 0, 6) == 'custom') {
        echo '<img src="' . get_theme_mod('buttons_' . $channel . '_icon') . '" alt="icon" width="60px" hieght="60px">';
    } else {
        seed_icon('s-chat-' . $channel);
    }
    echo '<div class="c-desc">' . get_theme_mod('buttons_' . $channel . '_tooltip', ucfirst($channel)) .
    $tooltip . '</div>';
    echo '</a></li>';
}
?>