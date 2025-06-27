<?php
if (!get_theme_mod('single_show_author', true)) {
    return;
}
$author_url = esc_url(get_author_posts_url(get_the_author_meta('ID')));
?>
<div class="single-author">
    <div class="author-pic">
        <a href="<?php echo $author_url; ?>" rel="author" aria-label="Author Info">
            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('author_bio_avatar_size', 80)); ?>
        </a>
    </div>
    <div class="author-info">
        <h2 class="name">
            <a href="<?php echo $author_url; ?>" rel="author" aria-label="Author Info"><?php the_author(); ?></a>
        </h2>
        <?php if (get_the_author_meta('description')) : ?>
        <div class="desc">
            <?php echo get_the_author_meta('description'); ?>
        </div>
        <?php endif; ?>
    </div>
</div>