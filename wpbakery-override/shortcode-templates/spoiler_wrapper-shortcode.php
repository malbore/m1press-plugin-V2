<?php
$classes = ['spoiler'];
if (isset($atts['add_class']))
    array_push($classes, $atts['add_class']);
?>
<div class="<?php echo implode(' ', $classes); ?>">
    <?php echo do_shortcode($content); ?>
</div>