<article id="post-<?php the_ID(); ?>" <?php post_class('s-content-search'); ?>>
    <div class="entry-info">
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>
        <div class="entry-excerpt">
            <?php the_excerpt();?>
        </div>
    </div>
    <div class="entry-pic">
        <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('medium_large');
            }
            ?>
        </a>
    </div>
</article>