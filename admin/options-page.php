<?php
/**
 * Admin options page
 * 
 * @author Kantbtrue
 * @version 1.0
 * @since 1.0
 */

if ( !function_exists( 'kbtcba_opts_page' ) ) {
    function kbtcba_opts_page () {
        add_menu_page(
            'Kantbtrue Content Bottom Ads',
            'KBTCBA',
            'edit_theme_options',
            'kbtcba-opts-page',
            'kbtcba_opts_form',
            'dashicons-megaphone',
            69
        );
    }
}
