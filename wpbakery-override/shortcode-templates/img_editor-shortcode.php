<?php
global $parent;
$classes = ['img_editor'];
if (isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}

$styles = array('background-repeat:no-repeat;');
//size
if (isset($atts['container_size'])) {
    $styles[] = 'height:' . $atts['container_size'] . ';';
} else {
    $styles[] = 'height:100%;';
}
// background-size
if (isset($atts['img_size'])) {
    $styles[] = 'background-size:' . $atts['img_size'] . ';';
} else {
    $styles[] = 'background-size:cover;';
}
// background-position
if (isset($atts['img_position'])) {
    $styles[] = 'background-position:' . $atts['img_position'] . ';';
} else {
    $styles[] = 'background-position:50% 50%;';
}
// background-image
if (isset($atts['img_on_bg'])) {
    $styles[] = 'background-image:url(' . wp_get_attachment_image_url($atts['img_on_bg'], 'full') . ');';
}

// link 
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

$styles[] = !empty($constructedLink) ? 'position: relative' : '';

$output = '';
$output .= $parent && $parent == 'slider' ? '<div class="swiper-slide">' : '';
$output .= '<div class="' . implode(' ', $classes) . '" style="' . implode(' ', $styles) . '">';
$output .= '<div class="content">';
$content_html = isset($atts['content_html']) ? $atts['content_html'] : '';
$output .= isset($atts['content_html'])
    ?  rawurldecode(base64_decode($content_html))
    : (isset($content)
        ? wpb_js_remove_wpautop($content, true)
        : '');
$output .= '</div>';
$output .= !empty($constructedLink) ? '<a class="absolute_link" ' . implode(' ', $constructedLink) . '></a>'  : '';
$output .= '</div>';
$output .= $parent && $parent == 'slider' ? '</div>' : '';

echo $output;
