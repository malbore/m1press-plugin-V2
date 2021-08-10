<?php

/********
 *
 * GENERATE ELEMENT
 *
 *****************************/
$utilities = new Utilities();

$json =  file_get_contents(PLUGIN_PATH . '/elements.json');
$json = str_replace('%path%', PLUGIN_URL, $json);

$gabarits = $utilities->s2m_get_gabarits();
$json = str_replace('"%gabarits%"', json_encode($gabarits), $json);

$elements = json_decode($json, true);
foreach ($elements as $id => $value) {
    $generateElement = new Generate_Element($id, $value);
    $generateShortcode = new Generate_Shortcode($id, $value);
}


/********
 *
 * ADD SHORTCODE CONTAINER
 *
 *****************************/
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_M1_Slider extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Bloc_Group extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Slide_Group extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Faq_Wrapper extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Spoiler_Wrapper extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Tabs_Wrapper extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Tabs_Item extends WPBakeryShortCodesContainer
    {
    }
    class WPBakeryShortCode_M1_Gallery_Lightbox extends WPBakeryShortCodesContainer
    {
    }
}
/********
 *
 * Change defaut classes
 *
 *****************************/
add_filter(
    'vc_shortcodes_css_class',
    'custom_css_classes_for_vc_row_and_vc_column',
    10,
    2
);
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row', 'row', $class_string);
        $class_string = str_replace(
            'row-o-content-middle',
            'align-items-center',
            $class_string
        );
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        $class_string = preg_replace(
            '/vc_col-sm-(\d{1,2})/',
            'col-$1',
            $class_string
        ); // This will replace "vc_col-sm-%" with "my_col-sm-%"
    }
    return $class_string; // Important: you should always return modified or original $class_string
}
/********
 *
 * Remove elements
 *
 *****************************/
add_action('vc_after_init', 'vc_after_init_actions');

function vc_after_init_actions()
{
    // Remove VC Elements
    if (function_exists('vc_remove_element')) {
        vc_remove_element('vc_btn');
        vc_remove_element('vc_separator');
        vc_remove_element('vc_column_text');
        vc_remove_element('vc_icon');
        vc_remove_element('vc_zigzag');
        vc_remove_element('vc_text_separator');
        vc_remove_element('vc_message');
        vc_remove_element('vc_hoverbox');
        vc_remove_element('vc_facebook');
        vc_remove_element('vc_tweetmeme');
        vc_remove_element('vc_pinterest');
        vc_remove_element('vc_toggle');
        vc_remove_element('vc_single_image');
        vc_remove_element('vc_gallery');
        vc_remove_element('vc_images_carousel');
        vc_remove_element('vc_tta_tabs');
        vc_remove_element('vc_tta_tour');
        vc_remove_element('vc_tta_accordion');
        vc_remove_element('vc_tta_pageable');
        vc_remove_element('vc_custom_heading');
        vc_remove_element('vc_cta');
        vc_remove_element('vc_widget_sidebar');
        vc_remove_element('vc_posts_slider');
        vc_remove_element('vc_video');
        //vc_remove_element( 'vc_raw_html' );
        vc_remove_element('vc_raw_js');
        vc_remove_element('vc_flickr');
        vc_remove_element('vc_progress_bar');
        vc_remove_element('vc_round_chart');
        vc_remove_element('vc_line_chart');
        vc_remove_element('vc_empty_space');
        vc_remove_element('vc_basic_grid');
        vc_remove_element('vc_media_grid');
        vc_remove_element('vc_masonry_grid');
        vc_remove_element('vc_masonry_media_grid');
        vc_remove_element('vc_gmaps');
        vc_remove_element('vc_pie');
    }
}
/********
 *
 * Update row to add spacing
 *
 *****************************/

// 1 | VC ROW
$attributes = array(
    array(
        'type' => 'dropdown',
        'heading' => "Padding vertical",
        'param_name' => 'py',
        "edit_field_class" => "vc_col-xs-4",
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5", "perso"),
        'description' => __("Ajout d'une marge intérieur (haut + bas)", "my-text-domain")
    ),
    array(
        'type' => 'dropdown',
        'heading' => "Padding haut",
        'param_name' => 'pt',
        "edit_field_class" => "vc_col-xs-4",
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5"),
        'description' => __("Ajout d'une marge intérieur (haut)", "my-text-domain"),
        'dependency' => array(
            'element' => 'py',
            'value' => 'perso'
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => "Padding bas",
        'param_name' => 'pb',
        "edit_field_class" => "vc_col-xs-4",
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5"),
        'description' => __("Ajout d'une marge intérieur (bas)", "my-text-domain"),
        'dependency' => array(
            'element' => 'py',
            'value' => 'perso'
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => "Margin vertical",
        "edit_field_class" => "vc_col-xs-4",
        'param_name' => 'my',
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5", "perso"),
        'description' => __("Ajout d'une marge intérieur (haut + bas)", "my-text-domain")
    ),
    array(
        'type' => 'dropdown',
        'heading' => "Margin haut",
        "edit_field_class" => "vc_col-xs-4",
        'param_name' => 'mt',
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5"),
        'description' => __("Ajout d'une marge intérieur (haut)", "my-text-domain"),
        'dependency' => array(
            'element' => 'my',
            'value' => 'perso'
        )
    ),
    array(
        'type' => 'dropdown',
        'heading' => "Margin bas",
        "edit_field_class" => "vc_col-xs-4",
        'param_name' => 'mb',
        'value' => array("par défaut", "0", "1", "2", "3", "4", "5"),
        'description' => __("Ajout d'une marge intérieur (bas)", "my-text-domain"),
        'dependency' => array(
            'element' => 'my',
            'value' => 'perso'
        )
    )
);
vc_add_params('vc_row', $attributes);


$dir = PLUGIN_PATH . '/wpbakery-override/vc_templates';
vc_set_shortcodes_templates_dir($dir);
