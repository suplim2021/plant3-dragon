<?php
require(dirname(__DIR__, 1) . '/_product.php');
$css = '';
if ($dgap != '30' || $mgap != '16') {
    $css  = '<style>';
    $css .= '#' . $id . '{--s-gap:' . $mgap . 'px}';
    $css .= '@media(min-width:1024px){#' . $id . '{--s-gap:' . $dgap . 'px}}';
    $css .= '</style>';
}
echo $css;
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($wp_class); ?>">
    <ul class="products <?php echo esc_attr($block_class); ?>">
        <?php
    $the_query = new WP_Query($args);
while ($the_query->have_posts()) {
    $the_query->the_post();
    wc_get_template_part('parts/content', 'product');
}
wp_reset_postdata();
?>
    </ul>
</div>
<?php
if (get_field('pagination') == 'link') {
    echo plant_paging($the_query);
}
wp_reset_postdata();
?>