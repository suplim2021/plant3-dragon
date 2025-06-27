</div>
</div>
<!-- #content -->
<div class="site-modal-bg"></div>
<footer id="colophon" class="site-footer">
    <?php
    if (get_theme_mod('set_footer_widget', false)) {
        echo '<div class="footer-widgets">';
        if (get_theme_mod('set_footer_widget_full', true)) {
            dynamic_sidebar('footer');
        } else {
            echo '<div class="s-container">';
            dynamic_sidebar('footer');
            echo '</div>';
        }
        echo '</div>';
    }
    if (get_theme_mod('set_footer_bar', true)) {
        get_template_part('parts/footer', 'bar');
    }
    ?>
    <div id="data" <?php echo p_data(); ?>><?php wp_footer();?></div>
</footer>
<?php
if (get_theme_mod('wrap_body', true)) {
    echo '</div>';
}
    ?>
</body>

</html>