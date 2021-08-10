<?php
global $parent;
$parent = 'slider';
wp_enqueue_script('swiper');
wp_enqueue_style('swiper');
$classes = [];
if(isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);
/**
 * Push SLIDER OPTIONS
 */
$slideroptions = [];

//global options slider
if(isset($atts['slider_options'])) {
    $arr_options = explode(',', $atts['slider_options']);
    if(in_array('fleche', $arr_options)) array_push($slideroptions, 'data-arrows=true');
    if(in_array('dots', $arr_options)) array_push($slideroptions, 'data-dots=true');
    if(in_array('autoplay', $arr_options)) array_push($slideroptions, 'data-autoplay=true');
    // activate lightbox
    if (in_array('lightbox', $arr_options)) {

        array_push($slideroptions, 'data-lightbox=true');
        wp_enqueue_script('lightbox');
        wp_enqueue_style('lightbox');
        global $lightbox;
        $lightbox = true;
    }
}

//spacing slides
if(isset($atts['spacing_slide']) && !empty($atts['spacing_slide']))
    array_push($slideroptions, 'data-spacebetween=' . intval($atts['spacing_slide']));


// slideperviews
$slideperviews = [];
if(isset($atts['slider_col_desk'])) $slideperviews['desk'] = intval($atts['slider_col_desk']);
    else $slideperviews['desk'] = 1;
if(isset($atts['slider_col_tab'])) $slideperviews['tab'] = intval($atts['slider_col_tab']);
    else $slideperviews['tab'] = 1;
if(isset($atts['slider_col_mob'])) $slideperviews['mob'] = intval($atts['slider_col_mob']);
    else $slideperviews['mob'] = 1;

$slideperviews = json_encode($slideperviews);

array_push($slideroptions, "data-slidesperview={$slideperviews}");

$slideroptions = implode(' ', $slideroptions);
$uniqid = uniqid();
echo '<div class="swiper-around ' . $classes . '">';
    echo '<div id="slider-' . $uniqid . '" class="swiper-container slider-element"  ' . $slideroptions . '>';
        echo '<div class="swiper-wrapper">';
        echo do_shortcode($content);
        echo '</div>';
        if(!empty($arr_options) && in_array('dots', $arr_options)) :
            echo '<div class="swiper-pagination"></div>';
        endif;
    echo '</div>';
if(!empty($arr_options) && in_array('fleche', $arr_options)) :
    echo '<div class="swiper-button-prev"></div>';
    echo '<div class="swiper-button-next"></div>';
endif;
echo '</div>';
?>