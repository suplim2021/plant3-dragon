<style>
    @media(max-width: 1023px) {
        body.single .site-header-space {
            margin-bottom: 0
        }
    }
</style>
<header class="text-center">
    <div class="single-pic alignwide">
        <?php the_post_thumbnail('full'); ?>
    </div>
    <div class="single-cat">
        <?php echo plant_cat(); ?>
    </div>
    <h1>
        <?php the_title(); ?>
    </h1>
    <div class="entry-meta single-meta">
        <?php echo plant_date(); ?>
        <?php do_action('plant_end_single_date'); ?>
    </div>
</header>