<!DOCTYPE html>
<html <?php language_attributes();
echo plant_html_tag(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'plant'); ?></a>
    <?php
        if (get_theme_mod('wrap_body', true)) {
            echo '<div id="page" class="site site-page">';
        }
        if (get_theme_mod('set_topbar', false)) {
            get_template_part('parts/top-bar');
        }

        $style = get_theme_mod('floating_header_style', 'none');
        $classes = '';
        if ($style !== 'none') {
            $classes = ' header--floating';
            if ($style === 'blur') {
                $classes .= ' header--blur';
            } elseif ($style === 'solid') {
                $classes .= ' header--solid';
            }
        }
        set_query_var('floating_header_class', $classes);
    ?>
    <?php get_template_part('parts/header', get_theme_mod('header_template', 'minimal-standard'));?>
    <div id="content" class="site-content">
        <div class="s-container">