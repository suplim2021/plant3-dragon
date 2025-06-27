<?php
$text = '©[s_current_year] ' . $_SERVER['HTTP_HOST'] . '. All rights reserved.';
$text = do_shortcode(get_theme_mod('footer_bar_text', $text));
$icons = do_shortcode(get_theme_mod('footer_bar_icons', '[s_social]'));
$css = '';
if ($icons) {
    $css = 'lg:flex lg:items-center lg:justify-between';
}
?>
<div class="footer-bar">
    <div class="s-container">
        <div class="text-center <?php echo $css; ?>">
            <div class="text">
                <?php echo $text; ?>
            </div>
            <?php if ($icons) :?>
            <div class="icon lg:flex">
                <br class="_mobile" />
                <?php echo $icons; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>