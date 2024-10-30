<?php
/**
 * Check suitable WordPress version for plugin
 * 
 * @author Kantbtrue
 * @version 1.0
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_activate' ) ) {
    function kbtcba_activate () {
        if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
            wp_die( __('You should update WordPress version before activating this plugin.', 'kantbtrue-cba') );
        }
    }
}