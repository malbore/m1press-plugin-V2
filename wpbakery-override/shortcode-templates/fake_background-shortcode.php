<?php
$classes = ['img-on-bg'];
if(isset($atts['add_class']) && !empty($atts['add_class']))  {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);

$display = [];
if(isset($atts['display']) && !empty($atts['display'])) {
    array_push($display, $atts['display']);
} else {
    array_push($display, 'row');
}
$display = implode(' ', $display);

?>
<picture class="<?= $classes; ?>">
	<?php echo wp_get_attachment_image($atts['img_on_bg'], 'full') ?>
</picture>

