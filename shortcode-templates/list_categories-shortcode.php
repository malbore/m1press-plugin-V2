<?php
$classes = ['liste_de_categories'];
if (isset($atts['add_class']) && !empty($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);

$categories = get_categories();
echo '<ul class="' . $classes . '">';
foreach ($categories as $key => $cat) {
    echo '<li><a href="' . get_category_link($cat) .'">' . $cat->name . '</a></li>';
}
echo '</ul>';