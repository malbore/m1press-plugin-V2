<?php
$classes = ['bloc'];
if(isset($atts['add_class']) && !empty($atts['add_class']))  {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);
?>
<div class="<?php echo $classes ?>">
    <?php echo do_shortcode($content); ?>
</div>