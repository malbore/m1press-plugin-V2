<?php 
$classes = ['content'];
if(isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);
echo '<div class="' . $classes . '">';
echo '<div class="inner">';
echo wpb_js_remove_wpautop( $content, true );
echo '</div>';
echo '</div>';
