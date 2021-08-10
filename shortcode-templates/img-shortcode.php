<?php
if (!defined('ABSPATH')) {
    die('-1');
}
global $parent;

$classes = ['img_single'];
if (isset($atts['add_class']) && !empty($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
if (isset($atts['img_align']) && !empty($atts['img_align'])) {
    array_push($classes, $atts['img_align']);
} else {
    array_push($classes, 'text_center');
}
$classes = implode(' ', $classes);


if (!isset($atts['img_on_bg'])) {
    $output = 'Veuillez sélectionner une image';
    echo $output;
    return;
}

$constructedLink = array();
if (isset($atts['img_link_interne'])) {
    $arrLink = vc_build_link($atts['img_link_interne']);
    if (isset($arrLink['url']) && !empty($arrLink['url'])) {
        $constructedLink[] = 'href="' . $arrLink['url'] . '"';
    }
    if (isset($arrLink['title']) && !empty($arrLink['title'])) {
        $constructedLink[] = 'alt="' . $arrLink['title'] . '"';
    }
    if (isset($arrLink['target']) && !empty($arrLink['target'])) {
        $constructedLink[] = 'target="' . $arrLink['target'] . '"';
    }
    if (isset($arrLink['rel']) && !empty($arrLink['rel'])) {
        $constructedLink[] = 'rel="' . $arrLink['rel'] . '"';
    }
} else if (isset($atts['img_link_externe'])) {
    $constructedLink[] = 'href="' . $atts['img_link_externe'] . '"';
    $constructedLink[] = 'target="blank"';
}

$output = '';
$output .= $parent && $parent == 'slider' ? '<div class="swiper-slide">' : '';
$output .= !empty($constructedLink) ? '<a class="absolute_link ' . $classes . '" ' . implode(' ', $constructedLink) . '>'  : '<div class="' . $classes . '">';
$output .=  wp_get_attachment_image($atts['img_on_bg'], 'full');
$output .= !empty($constructedLink) ? '</a>'  : '</div>';
$output .= $parent && $parent == 'slider' ? '</div>' : '';
echo $output;
if ($parent && $parent == 'slider') {
    echo '<div  class="swiper-slide">';
}
if (isset($atts['img_on_bg'])) {
    $img_on_bg = $atts['img_on_bg'];
    if (isset($atts['img_link_type']) && !empty($atts['img_link_type']) && $atts['img_link_type'] != 'sans') {
        if ($atts['img_link_type'] == 'externe') {
            if (isset($atts['img_link_externe']) && !empty($atts['img_link_externe'])) {
                $link = esc_url($atts['img_link_externe']);
                echo "<a href=\"$link\" style=\"display:block;\" target=\"_blank\" class=\"{$classes}\">";
                echo wp_get_attachment_image($img_on_bg, 'full');
                echo "</a>";
            }
        } elseif ($atts['img_link_type'] == 'interne') {
        }
    } else {

        echo "<div class=\"{$classes}\">";
        echo wp_get_attachment_image($img_on_bg, 'full');
        echo "</div>";
    }
} else {
    $return = 'Veuillez choisir une image';
}

if ($parent && $parent == 'slider') {
    echo '</div>';
}
