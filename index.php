<?php
/**
 * Plugin Name:       M1press Plugin
 * Plugin URI:        https://matiere-1ere.fr
 * Description:       Module sur mesure par M1
 * Version:           3.4
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Matière 1ère
 * Author URI:        https://matiere-1ere.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wefor_wpb
 *
 */
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

if (!class_exists('WebissimeGen_autoloader')) {
	include_once PLUGIN_PATH . '/includes/class-webissime-gen-autoloader.php';
}

new ShortCode_Gabarit();

$option_custom_archive = get_option('m1press_conf');
if(isset($option_custom_archive) && $option_custom_archive)  {
    new Custom_Archive();
}

add_action('wp_enqueue_scripts', 'register_scripts_for_shortcode');
function register_scripts_for_shortcode() {
    wp_register_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', false, true);
    wp_register_style('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css', false, '2.0');

    wp_register_script('lightbox', PLUGIN_URL . 'assets/vendors/simple-lightbox.min.js', false, true);
    wp_register_style('lightbox', PLUGIN_URL  . 'assets/vendors/simple-lightbox.min.css', false, '2.11');

}
// generate options
require(__DIR__ . '/admin/index.php');
require(__DIR__ . '/wpbakery-override/wpbakery.php');
require(__DIR__ . '/updater.php');


