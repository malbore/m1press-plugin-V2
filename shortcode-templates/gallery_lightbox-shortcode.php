<?php
wp_enqueue_script('lightbox');
wp_enqueue_style('lightbox');
$classes = ['ligthbox_gallery', 'row'];
if (isset($atts['add_class']) && !empty($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
if (isset($atts['nb_column']) && !empty($atts['nb_column'])) {
    global $cols;
    $cols = $atts['nb_column'];
}
$classes = implode(' ', $classes);
?>

<div class="<?= $classes ?>">
    <?php echo do_shortcode($content); ?>
</div>