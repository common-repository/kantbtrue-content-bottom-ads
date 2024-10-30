<?php
/**
 * Plugin Name: Kantbtrue Content Bottom Ads
 * Plugin URI: https://wordpress.org/plugins/kantbtrue-content-bottom-ads/
 * Description: An elegant ad below content area.
 * Version: 1.1.2
 * Author: kantbtrue
 * Author URI: https://twitter.com/kantbtrue
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: kantbtrue-cba
 * Domain Path: /languages 
 */

// If this file is called directly, abort
if ( !defined('WPINC') ) {
    die;
}

// Constants
define( 'KBTCBA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('KBTCBA_VERSION', '1.1.2');

// Include
include plugin_dir_path( __FILE__ ) . 'inc/activate.php';
include plugin_dir_path( __FILE__ ) . 'admin/options-page.php';
include plugin_dir_path( __FILE__ ) . 'admin/options-form.php';
include plugin_dir_path( __FILE__ ) . 'admin/enqueue.php';
include plugin_dir_path( __FILE__ ) . 'frontend/enqueue.php';
include plugin_dir_path( __FILE__ ) . 'frontend/ads-html.php';

// Hooks
register_activation_hook( __FILE__, 'kbtcba_activate' );
add_action( 'admin_menu', 'kbtcba_opts_page' );
add_action( 'admin_post_kbtcba_save_opts', 'kbtcba_save_opts' );
add_filter( 'the_content', 'kbtcba_ads_html', 1 );
