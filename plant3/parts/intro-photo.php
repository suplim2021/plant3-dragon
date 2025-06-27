<style>
.blog-intro {
    min-height: 300px;
    margin-bottom: var(--s-space);
    overflow: hidden;
}

.blog-intro h2 {
    font-size: 1.8em;
    margin-bottom: 0.5rem;
}

.blog-intro-text {
    padding: 40px 0;
    text-align: center;
}

.blog-intro-photo {
    line-height: 0;
    text-align: center;
}

@media(min-width: 720px) {
    .blog-intro .s-container {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .blog-intro-text {
        text-align: left;
        order: 1;
        min-width: 30%;
    }

    .blog-intro-photo {
        <?php if (get_theme_mod('blog_intro_layout', 'text_photo') == 'text_photo') {
            echo 'order: 2;';
        } else {
            echo 'order: 0;';
        }

        ?>
    }
}
</style>
<div class="blog-intro alignfull">
    <div class="s-container">
        <div class="blog-intro-text s-lax" data-rellax-speed="-2" 
        data-rellax-xs-speed="-3" data-rellax-mobile-speed="-3">
            <?php
            $txt = get_theme_mod('blog_intro_text');
            if ($txt) {
                echo do_shortcode($txt);
            } else {
                echo '<h2>' . get_bloginfo('name') .  '</h2>';
                echo '<h3>' .  get_bloginfo('description') . '</h3>';
                echo do_shortcode('[s_social]');
            }
            ?>
        </div>
        <div class="blog-intro-photo s-lax" data-rellax-speed="-6" 
        data-rellax-xs-speed="-2" data-rellax-mobile-speed="-2">
            <?php
            $img_id = get_theme_mod('blog_intro_photo');
            if ($img_id) {
                echo wp_get_attachment_image($img_id, 'full');
            } else {
                echo '<img src="https://seedcdn.com/demo/bai/girl.webp" alt="girl" width="400" height="600">';
            }
            ?>
        </div>
    </div>
</div>
<?php
    echo get_theme_mod('blog_intro_latest', '<h2 class="text-center alignwide">' . __('Latest', 'plant') . '</h2>');
?>