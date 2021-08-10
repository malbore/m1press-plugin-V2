
<?php 
function getTabTitles($content) {
    preg_match_all( '/titre_tabs="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $tab_titles = array();
    
    /**
     * get tab titles array
     */
    if ( isset( $matches[0] ) ) {
        $tab_titles = $matches[0];
    }
    
    $tab_title_array = array();
    
    foreach ( $tab_titles as $tab ) {
        preg_match( '/titre_tabs="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
        $tab_title_array[] = $tab_matches[1][0];
    }
    
    return $tab_title_array;
}
$titles = getTabTitles($content);
$classes = ['tabs'];
if(!empty($atts['add_class']) && isset($atts['add_class']))  {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);
echo '<div class="' . $classes . '">';
    if(!empty($titles)) {
        echo '<nav class="tabs__nav"><ul class="reset-ul">';
        foreach($titles as $title) {
            echo '<li data-target="#tab-' . sanitize_title($title) . '">' . $title . '</li>';
        }
        echo '</ul></nav>';
    }
    echo '<div class="tabs__content">';
        echo do_shortcode( $content );
    echo '</div>';
echo '</div>';
?>