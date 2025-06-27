<?php

/**
 * Template Name: Landing Page
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('landing-page'); ?>>
    <main id="main" class="site-main">
        <?php
        while (have_posts()) {
            the_post();
            the_content();
            edit_post_link('EDIT', '', '', null, 'btn-edit');
        }
        ?>
    </main>
    <?php wp_footer(); ?>
</body>

</html>