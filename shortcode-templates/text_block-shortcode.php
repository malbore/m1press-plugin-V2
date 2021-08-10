<?php
if (!defined('ABSPATH')) {
    die('-1');
}
global $parent;
$classes = array('text-bloc');
if(isset($atts['add_class']))  {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);

$output = '';
$output .= $parent && $parent == 'slider' ? '<div class="swiper-slide">' : '';
$output .= '<div class="' . $classes . '">';
$output .= wpb_js_remove_wpautop( $content, true );
$output .= '</div>';
$output .= $parent && $parent == 'slider' ? '</div>' : '';
echo $output;
