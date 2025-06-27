<?php
$headline_title    = get_field('headline_title', get_the_id());
$headline_subtitle = get_field('headline_subtitle', get_the_id());
?>
<style>
    body.single .site-header-space {
        margin-bottom: 0
    }
</style>
<header class="s-content s-content-headline s-title-headline alignfull _space">
    <div class="entry-pic entry-pic-headline">
        <?php the_post_thumbnail('full'); ?>
    </div>
    <div class="entry-info entry-info-headline">
        <div class="s-lax" data-rellax-speed="-2" data-rellax-xs-speed="-3" data-rellax-mobile-speed="-3">
            <?php
        echo plant_cat();
if ($headline_title) {
    echo '<h1 class="title">' . $headline_title . '</h1>';
    if ($headline_subtitle) {
        echo '<h2 class="sub">' . $headline_subtitle . '</h2>' ;
    }
} else {
    the_title('<h1 class="title">', '</h1>');
}
echo plant_date();
do_action('plant_end_single_date');
echo plant_author();
?>
        </div>
    </div>
</header>