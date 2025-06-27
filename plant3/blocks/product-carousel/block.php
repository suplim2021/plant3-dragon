<?php
require(dirname(__DIR__, 1) . '/_product.php');
$mb     = get_field('mobile_columns') ?: 2;
$tb     = get_field('tablet_columns') ?: 3;
$dt     = get_field('desktop_columns') ?: 4;
$align  = get_field('align') ?: 'start';
$arrows = get_field('arrows') ?: 'show';
$dots   = get_field('dots') ?: 'show';
$block_class = '-m' . esc_attr($mb) . ' -t' . esc_attr($tb) . ' -d' . esc_attr($dt);
$block_class .= ' arrows-' . $arrows . ' dots-' . $dots;
$css = '';
if ($dgap != '30' || $mgap != '16') {
    $css  = '<style>';
    $css .= '#' . $id . '{--s-space:' . $mgap . 'px}';
    $css .= '@media(min-width:1024px){#' . $id . '{--s-space:' . $dgap . 'px}}';
    $css .= '</style>';
}
echo $css;
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($wp_class); ?>">
    <div class="s-slider <?php echo $block_class; ?>" data-align="<?php echo $align; ?>">
        <div class="s-viewport">
            <div class="s-slides products">
                <?php $the_query = new WP_Query($args); ?>
                <?php while ($the_query->have_posts()) {
                    $the_query->the_post();
                    echo '<ul class="slide">';
                    wc_get_template_part('parts/content', 'product');
                    echo '</ul>';
                } ?>
                <?php wp_reset_postdata(); ?>
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