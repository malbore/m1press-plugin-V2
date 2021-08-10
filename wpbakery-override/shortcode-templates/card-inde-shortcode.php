<?php
$classes = ['card'];
if (isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
?>
<div class="<?php echo implode(' ', $classes) ?>">
    <div class="thumbnail">
        <?php echo wp_get_attachment_image($img, 'full'); ?>
    </div>
    <div class="content">
        <?php echo wpb_js_remove_wpautop($content, true); ?>
    </div>
</div>