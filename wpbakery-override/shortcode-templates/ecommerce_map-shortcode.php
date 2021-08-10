<?php
$address = [
	'street' => get_option( 'woocommerce_store_address' ),
	'street-more' => get_option( 'woocommerce_store_address_2' ),
	'city' => get_option( 'woocommerce_store_city' ),
	'postal-code' => get_option( 'woocommerce_store_postcode' )
];
$query= $address['street'] . $address['street-more'];
$queryAddr = rawurlencode($query);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api-adresse.data.gouv.fr/search/?q={$queryAddr}&postcode={$address['postal-code']}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
$result = json_decode($json, true);

$coords = [
	'lat' => $result['features'][0]['geometry']['coordinates'][1],
	'lng' => $result['features'][0]['geometry']['coordinates'][0]
];
curl_close($ch);
?>
<div id="map-ecommerce">
	<div class="row">
		<div class="col-md-8 px-0">			
			<div id="mapid"></div>
		</div>
		<div class="col-md-4 col-address d-flex align-items-flex-end justify-content-center p-5 flex-column">
			<!-- Generator: Adobe Illustrator 24.3.0, SVG Export Plug-In  -->
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="90.1px"
					 height="90.1px" viewBox="0 0 90.1 90.1" style="overflow:visible;enable-background:new 0 0 90.1 90.1;" xml:space="preserve">
				<style type="text/css">
					.st0{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
					.st1{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
				</style>
				<defs>
				</defs>
				<path id="Shape_50_2_" class="st0" d="M48,1C33.1,1,19.3,9.1,12.1,22.1c-7.3,13-6.9,29,1,41.7L1,89.1L26.4,77
					c14.8,9.2,33.8,8,47.4-2.9s18.8-29.2,13-45.7C81,12,65.4,1,48,1L48,1z"/>
				<g>
					<path class="st1" d="M47.9,17.5c10.2,0,18.5,8.3,18.5,18.5c0,8.2-12,24.2-16.7,30.1c-0.4,0.6-1.1,0.9-1.8,0.9
						c-0.7,0-1.4-0.3-1.8-0.9c-4.7-5.9-16.7-21.8-16.7-30.1C29.5,25.7,37.7,17.5,47.9,17.5z"/>
					<circle class="st1" cx="47.9" cy="35.9" r="6.9"/>
				</g>
				</svg>
				
				
			<div class="title">
				Notre adresse
			</div>
			<div class="address  mb-4"> 
				<?= $address['street'] . $address['street-more'] ?>,
				<br>
				<?= $address['postal-code'] ?>&nbsp;<?= $address['city'] ?>
			</div>
			<div class="btn_plein_white">
				<?php 
					$fulladdress = $address['street'] . $address['street-more'] . ',' . $address['postal-code'] . ' ' . $address['city']; 
				echo '<a target="_blank" href="https://www.google.fr/maps/dir//',
					rawurlencode($fulladdress), '">Obtenir un itinéraire</a>';
				?>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
<script>
var mymap = L.map('mapid', {	scrollWheelZoom: false}).setView(['<?= $coords['lat'] ?>', '<?= $coords['lng'] ?>'], 13.3);

L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.png', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	id: 'mapbox/streets-v11',
	tileSize: 512,
	zoomOffset: -1,
}).addTo(mymap);

L.marker(['<?= $coords['lat'] ?>', '<?= $coords['lng'] ?>']).addTo(mymap)
</script>
