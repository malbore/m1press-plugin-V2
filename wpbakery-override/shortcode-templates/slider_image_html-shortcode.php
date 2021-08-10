<?php
$classes = ['card'];
if (isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
?>
<div class="swiper-slide">
    <div class="<?php echo implode(' ', $classes) ?>">
        <div class="thumbnail">
            <?php echo wp_get_attachment_image($img, 'full'); ?>
        </div>
        <div class="content">
            <?php
            if($atts['contenu_html']) {
                $test = base64_decode($atts['contenu_html']);
                echo rawurldecode($test);
            } else {
                echo 'pas de contenu';
            }
            ?>
        </div>
    </div>
</div>