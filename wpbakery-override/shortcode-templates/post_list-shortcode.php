<?php
$args = [];

if (isset($atts['post_type']) && !empty($atts['post_type'])) {
    $args['post_type'] = $atts['post_type'];
}

if (isset($atts['nb_results']) && !empty($atts['nb_results'])) {
    if ($atts['nb_results'] == 'limited') $args['posts_per_page'] = $atts['limited_result'];
}

if (!isset($atts['display_type'])) {
    if (is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }
    $args['paged'] = $paged;
}

/*
if (isset($atts['slider_limit']) && !empty($atts['slider_limit'])) {
    $args['posts_per_page'] = $atts['slider_limit'];
}
*/


$classes = ['card'];
if (isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}

$classes = implode(' ', $classes);


/**
 * Push POST CLASSES
 */
$postclasses = [];
if (isset($atts['col_mob'])) array_push($postclasses, $atts['col_mob']);
if (isset($atts['col_tab'])) array_push($postclasses, $atts['col_tab']);
if (isset($atts['col_desk'])) array_push($postclasses, $atts['col_desk']);
if (empty($postclasses)) {
    $postclasses = 'col-12';
} else {
    $postclasses = implode(' ', $postclasses);
}


/**
 * Push SLIDER OPTIONS
 */
$slideroptions = [];
if (isset($atts['display_type']) && $atts['display_type'] == 'slider') {
    //global options slider
    if (isset($atts['slider_options'])) {
        $arr_options = explode(',', $atts['slider_options']);
        if (in_array('fleche', $arr_options)) array_push($slideroptions, 'data-arrows=true');
        if (in_array('dots', $arr_options)) array_push($slideroptions, 'data-dots=true');
    }

    //spacing slides
    if (isset($atts['spacing_slide']) && !empty($atts['spacing_slide']))
        array_push($slideroptions, 'data-spacebetween=' . intval($atts['spacing_slide']));


    // slideperviews
    $slideperviews = [];
    if (isset($atts['slider_col_desk'])) $slideperviews['desk'] = intval($atts['slider_col_desk']);
    else $slideperviews['desk'] = 1;
    if (isset($atts['slider_col_tab'])) $slideperviews['tab'] = intval($atts['slider_col_tab']);
    else $slideperviews['tab'] = 1;
    if (isset($atts['slider_col_mob'])) $slideperviews['mob'] = intval($atts['slider_col_mob']);
    else $slideperviews['mob'] = 1;

    $slideperviews = json_encode($slideperviews);

    array_push($slideroptions, "data-slidesperview={$slideperviews}");
}
$slideroptions = implode(' ', $slideroptions);


/**
 * Get GABARIT OPTION
 */

$postcontent = get_option('s2m_gabarits');
if (isset($atts['gabarit']) && !empty($atts['gabarit'])) {
    $key = $atts['gabarit'];
} else {
    $key = 'gabarit_1';
}
$postcontent = $postcontent[$key];


/**
 * Si on est en page d'archive filtré par la catégorie courante
 */
if (is_tax() && isset($atts['post_type']) && !empty($atts['post_type']) && $atts['post_type'] == get_post_type()) {
    $id = get_queried_object()->term_id;
    $name = get_queried_object()->taxonomy;
    if ($id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $name,
                'field'    => 'id',
                'terms'    => $id,
            ),
        );
    }
} else if (is_archive()) {
    $term_obj = get_queried_object();
    $name = get_queried_object()->taxonomy;
    if ($term_obj->category_parent > 0) {
        $id = $term_obj->term_id;
    } else {
        $id = $term_obj->category_parent;
    }

    if ($id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $name,
                'field'    => 'id',
                'terms'    => $id,
            ),
        );
    }
}



/**
 * Get POST QUERY
 */
$query = new WP_query($args);
$html = '';
$uniqid = uniqid();
if ($query->have_posts()) :
    if (isset($atts['display_type']) && $atts['display_type'] == 'slider') :
        $html .= '<div class="swiper-around  ' . $classes . '">';
        $html .= '<div id="slider-' . $uniqid . '" class="swiper-container"  ' . $slideroptions . '>';
        $html .= '<div class="swiper-wrapper post_list">'; // open slider
    else :
        $html .= "<div class=\"post_list row\">"; // open post-list row
    endif;
    $arrdate = array();
    while ($query->have_posts()) : $query->the_post();
        // replace shortcode by content
        $id = get_the_ID();
        $author = get_userdata($query->post_author);
        $date = get_the_date('d M Y');
        $output = $postcontent['content'];
        if (isset($atts['ordertype']) && $atts['ordertype'] == 'groupby') {
            if ($date != $date_check) {
                $html .= '<div class="date col-12">' . $date . '</div>';
            }
        }

        if (isset($atts['display_type']) && $atts['display_type'] == 'slider') :
            $html .= '<div class="swiper-slide">';
        else :
            $html .= "<div class=\"{$postclasses}\">";
        endif;
        $html .= do_shortcode($output);
        $html .= "</div>";
        $date_check = $date;
    endwhile;
    if (isset($atts['display_type']) && $atts['display_type'] == 'slider') :
        $html .= '</div>';
        if (in_array('dots', $arr_options)) :
            $html .= '<div class="swiper-pagination"></div>';
        endif;
        $html .= '</div>'; // close slider
        if (in_array('fleche', $arr_options)) :
            $html .= '<div class="swiper-button-prev"></div>';
            $html .= '<div class="swiper-button-next"></div>';
        endif;
        $html .= '</div>';
    else :
        $html .= '</div>';
        if (!isset($atts['display_type'])) {
            $big = 999999999;
            $html .= '<div class="s2m_pagination">';
            $html .= paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, $paged),
                'total' => $query->max_num_pages,
                'before_page_number' => '<span class="separator"></span>',
                'prev_text' => '<span class="icon"></span> Page précèdente',
                'next_text' => 'Page suivante <span class="icon"></span>',
            ));
            $html .= '</div>';
        }
    endif;
endif;


echo $html;
