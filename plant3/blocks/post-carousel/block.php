<?php
require(dirname(__DIR__, 1) . '/_post.php');
$align  = get_field('align') ?: 'start';
$arrows = get_field('arrows') ?: 'show';
$dots   = get_field('dots') ?: 'show';

$block_class .= ' arrows-' . $arrows . ' dots-' . $dots;
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($wp_class); ?>">
    <div class="s-slider <?php echo $block_class; ?>" data-align="<?php echo $align; ?>">
        <div class="s-viewport">
            <div class="s-slides">
                <?php
                $the_query = new WP_Query($args);
while ($the_query->have_posts()) {
    $the_query->the_post();
    echo '<div class="slide">';
    get_template_part('parts/content', strtolower($template), $vars);
    echo '</div>';
}
wp_reset_postdata();
?>
            </div>
        </div>
        <div class="s-slidenav">
            <span class="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </span>
            <div class="s-dots"></div>
            <span class="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </span>
        </div>
    </div>
</div>