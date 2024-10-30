<?php
/**
 * Enqueue plugin styles/scripts in admin area
 * 
 * @author Kantbtrue
 * @version 1.0
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_admin_enqueue' ) ){
    function kbtcba_admin_enqueue () {
        if ( !$_GET['page'] && $_GET['page'] !== 'kbtcba-opts-page' ) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script( 'jquery' );
        wp_enqueue_style( 'bootstrap', KBTCBA_PLUGIN_URL . 'admin/assets/css/bootstrap.min.css', null, '5.0', 'all' );
        wp_enqueue_style( 'fontawesome', KBTCBA_PLUGIN_URL . 'admin/assets/css/fontawesome.all.min.css', null, '5.13.1', 'all' );
        wp_enqueue_style( 'options-page', KBTCBA_PLUGIN_URL . 'admin/assets/css/options-page.css', null, KBTCBA_VERSION, 'all' );
        wp_enqueue_script( 'main', KBTCBA_PLUGIN_URL . 'admin/assets/js/main.js', 'jquery', KBTCBA_VERSION, true );
    }
}
add_action( 'admin_enqueue_scripts', 'kbtcba_admin_enqueue' );
