<?php
echo '<div class="tab" id="tab-' . sanitize_title( $atts['titre_tabs'] ) . '">';
echo do_shortcode($content);
echo '</div>';
?>