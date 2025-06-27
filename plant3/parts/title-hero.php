<style>
    @media(max-width: 1023px) {
        body.single .site-header-space {
            margin-bottom: 0
        }
    }
</style>
<header class="s-content s-content-hero s-title-hero alignwide _space">
    <div class="entry-pic entry-pic-hero">
        <?php the_post_thumbnail('full'); ?>
    </div>
    <div class="entry-info entry-info-hero text-left">
        <?php
            echo plant_cat();
        the_title('<h1>', '</h1>');
        echo plant_date();
        do_action('plant_end_single_date');
        echo plant_author();
        ?>
    </div>
</header>