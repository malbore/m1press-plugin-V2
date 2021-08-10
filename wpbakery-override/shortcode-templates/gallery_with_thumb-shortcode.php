<?php
$classes = ['card'];
if(isset($atts['add_class'])) {
    array_push($classes, $atts['add_class']);
}
$classes = implode(' ', $classes);

$dataThumbs = "data-thumbs=3";
if(isset($atts['miniatures']))
    $dataThumbs = "data-thumbs=" . intval($atts['miniatures']);


var_dump($atts);
?>

<!-- Slider main container -->
<div class="swiper-container swiper-with-thumbs" <?= $dataThumbs ?> >
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <?php if(isset($atts['images'])) : $images = explode(',' ,$atts['images']); foreach($images as $k => $image) : ?>
    <div class="swiper-slide">
        <?= wp_get_attachment_image($image, 'full'); ?>
        <?php
            if(isset($atts['option_lightbox']) && $atts['option_lightbox'])
                echo '<div class="open-lightbox"></div>';
        ?>
    </div>
    <?php endforeach; endif;  ?>
  </div>
</div>
