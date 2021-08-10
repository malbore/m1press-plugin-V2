<?php

$image = get_the_post_thumbnail($product_id, 'full');
$title = get_the_title($product_id);
$link = get_the_permalink($product_id);
$excerpt = get_the_excerpt($product_id);
$product = wc_get_product($product_id);

?>

<div class="thumbnail-product">
	<?= $image ?>
	<div class="hover">
		<div class="product-actions">
			<a href="<?= $link ?>" class="icon-link">
				<svg viewBox="0 0 24 24">
					<use xlink:href="#view_product"></use>
				</svg>
			</a>
			<a href="<?php echo $product->add_to_cart_url() ?>"  data-quantity="1" class="ajax_add_to_cart add_to_cart_button icon-link" data-product_id="<?php echo $product_id ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="Add “<?php echo $title ?>” to your cart"> 
				<svg>
					<use xlink:href="#add_to_cart"></use>
				</svg>
			</a>
		</div>
	</div>
</div>
<div class="price">
	<?= $product->get_regular_price(); ?>&nbsp;€
</div>
<div class="title-product">
	<a href="<?= $link ?>"><?= $title ?></a>
</div>
<div class="description">
	<?= $excerpt ?>
</div>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
	<symbol id="add_to_cart" viewBox="0 0 23.2 24">
		<path style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" d="M22.7,20.1
		c0.1,0.9-0.2,1.7-0.7,2.4c-0.6,0.6-1.4,1-2.2,1H3.5c-0.9,0-1.7-0.4-2.2-1S0.4,21,0.5,20.1L2.1,7.5h19L22.7,20.1z"/>
		<path style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" d="M5.6,5H4.2
			C3.8,5,3.5,5.2,3.3,5.5l-1.2,2h19l-1.2-2C19.7,5.2,19.4,5,19,5h-1.4"/>
		<path style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" d="M15.6,4.5
			c0-2.2-1.8-4-4-4s-4,1.8-4,4v3h8V4.5z"/>
		<line style="fill:none;stroke-linecap:round;stroke-miterlimit:10;" x1="12.1" y1="13.3" x2="12.1" y2="18.7"/>
		<line style="fill:none;stroke-linecap:round;stroke-miterlimit:10;" x1="9.4" y1="16" x2="14.8" y2="16"/>
	</symbol>
	<symbol id="view_product" viewBox="0 0 24 14">
		<circle style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" cx="12" cy="7" r="3.5"/>
		<path style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" d="M23.4,6.7
			C22.2,5.4,17.6,0.5,12,0.5S1.8,5.4,0.6,6.7c-0.2,0.2-0.2,0.5,0,0.7c1.2,1.3,5.8,6.2,11.4,6.2s10.2-4.9,11.4-6.2
			C23.5,7.1,23.5,6.9,23.4,6.7z"/>
	</symbol>
</svg>