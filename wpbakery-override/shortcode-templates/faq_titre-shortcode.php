<?php
$classes = ['content'];
if (isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);
if(isset($atts['titre'])) {
    if(isset($atts['balise'])) echo "<{$atts['balise']} class=\"titre opener {$classes}\">";
        else echo "<div class=\"titre opener {$classes}\">";
    echo $atts['titre'] . '<span class="arrow"></span>';
    if (isset($atts['balise'])) echo "</{$atts['balise']}>";
        else echo '</div>';
}
?>