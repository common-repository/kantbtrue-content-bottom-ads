<?php
/**
 * Remove options from database on plugin uninstall
 * 
 * @author Kantbtrue
 * @version 1.0
 * @since 1.0
 */

// if uninstall.php is not called by WordPress, die
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

delete_option( '_kbtcba_opts' );
delete_site_option( '_kbtcba_opts' );
