<?php
/**
 * Enqueue plugin styles/scripts in frontend area
 * 
 * @author Kantbtrue
 * @version 1.0
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_frontend_enqueue' ) ){
    function kbtcba_frontend_enqueue () {
        $opts = get_option( '_kbtcba_opts' );
        if ( !isset( $opts ) ) {
            return;
        }
        wp_enqueue_style( 'kbtcba-main', KBTCBA_PLUGIN_URL . 'frontend/assets/css/style.css', null, KBTCBA_VERSION, 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'kbtcba_frontend_enqueue' );
