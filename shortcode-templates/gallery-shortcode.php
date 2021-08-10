<?php
$classes = ['card'];
if(isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);

if(isset($atts['images'])) {
    var_dump($atts['images']);
}