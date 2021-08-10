<?php
global $cols;
$classes = ['gallery_lighbox_img', 'object_fit_cover'];
if ($cols) {
    array_push($classes, $cols);
}
$classes = implode(' ', $classes);


$attr = array();
if(isset($atts['lightbox_desc'])) {
    $attr['title'] = $atts['lightbox_desc'];
}

?>

<div class="<?= $classes ?>">
    <a href="<?php echo wp_get_attachment_url($atts['img_on_bg'], 'full'); ?>">
        <?php echo wp_get_attachment_image($atts['img_on_bg'], 'full', false, $attr); ?>
    </a>
</div>