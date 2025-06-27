<?php
require('_content.php');
$headline_title    = get_field('headline_title', get_the_id());
$headline_subtitle = get_field('headline_subtitle', get_the_id());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('s-content s-content-headline'); ?>>
    <div class="entry-pic entry-pic-headline">
        <?php do_action('plant_begin_entry_pic'); ?>
        <?php
        echo plant_cat($s_cat_float, $s_cat_style);
        if (has_post_thumbnail()) {
            the_post_thumbnail('full');
        } else {
            echo plant_placeholder('full');
        }
        ?>
        <?php do_action('plant_end_entry_pic'); ?>
    </div>
    <div class="entry-info entry-info-headline">
        <div class="s-lax" data-rellax-speed="-2" data-rellax-xs-speed="-3" data-rellax-mobile-speed="-3">
        <?php
        echo plant_cat($s_cat, $s_cat_style);
        echo '<a href="' . esc_url(get_permalink()) .  '">';
        if ($headline_title) {
            echo '<h2 class="entry-title title">' . $headline_title . '</h2>';
            if ($headline_subtitle) {
                echo '<h3 class="sub">' . $headline_subtitle . '</h3>' ;
            }
        } else {
            the_title('<h2 class="entry-title title">', '</h2>');
        }
        echo '</a>';
        echo plant_date($s_date);
        echo plant_excerpt($s_excerpt);
        echo plant_author($s_author, get_the_author_meta('ID'), $s_shortcode);
        echo plant_readmore($s_more);
        ?>
        </div>
    </div>
</article>