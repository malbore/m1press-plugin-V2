<?php
$classes = ['accordeon'];
if (isset($atts['add_class']))
    array_push($classes, $atts['add_class']);
?>
<div class="<?php echo implode(' ', $classes); ?>">
    <?php do_shortcode($content); ?>
</div>