<?php
require(dirname(__DIR__, 1) . '/_post.php');
$class = $wp_class . ' s-grid ' . $block_class;
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
    <?php
    $the_query = new WP_Query($args);
    while ($the_query->have_posts()) {
        $the_query->the_post();
        get_template_part('parts/content', strtolower($template), $vars);
    }
    ?>
</div>
<?php
if (get_field('pagination') == 'link') {
    echo plant_paging($the_query);
}
wp_reset_postdata();