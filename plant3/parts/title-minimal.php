<style>
.title-space {
    height: 24px;
}
</style>
<header class="s-title-minimal text-center">
    <div class="title-space"></div>
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