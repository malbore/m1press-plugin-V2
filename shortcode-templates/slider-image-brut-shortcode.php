<div class="swiper-slide">
    <?php

    global $lightbox;
    if (isset($atts['img_on_bg'])) {

        if ($lightbox) {
            echo '<a class="lightbox-link" href="' . wp_get_attachment_url($atts['img_on_bg']) . '">';
        }
        echo wp_get_attachment_image($atts['img_on_bg'], 'full');

        if ($lightbox) {
            echo '</a>';
        }
    }
    ?>
</div>