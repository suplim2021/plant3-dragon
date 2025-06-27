<?php
get_header();
$keyword = trim(str_replace('/', ' ', $_SERVER['REQUEST_URI']));
?>
<style>
    .er-404 h1 {
        margin-top: 10vh;
    }

    .er-404 header p {
        margin-bottom: 20px;
        color: var(--s-text-2);
    }

    .er-404 form {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        max-width: 400px;
        gap: 8px;
    }

    .er-404 #s {
        width: calc(100% - 90px);
        border: 1px solid var(--s-border-1);
        color: var(--s-text-2);
    }

    .er-404 #s:focus {
        border-color: var(--s-color-1);
    }

    .er-404 #searchsubmit {
        flex: 1;
    }
</style>
<main id="main" class="site-main er-404">
    <header class="text-center">
        <h1>
            <?php esc_html_e('PAGE NOT FOUND', 'plant'); ?>
        </h1>
        <p>ERROR 404</p>
    </header>
    <p class="text-center">
        <?php esc_html_e('Sorry, the page you are looking for doesn\'t exist or has been moved.', 'plant');?>
        <?php esc_html_e('Try searching our site.', 'plant'); ?>
    </p>
    <form role="search" method="get" action="<?php echo home_url('/'); ?>">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span>
        <input type="text" value="<?php echo $keyword; ?>" name="s" id="s">
        <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x('Search', 'submit button') ?>">
    </form>
    <div class="_space"></div>
</main>
<?php get_footer(); ?>