<?php
/**
 * Trigger this file when user uninstall plugin
 * 
 * @package MyPrivacyPolicy
 *
*/

// security check - prevent access fro outside of wordpress
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

function jlplg_lovecoding_delete_settings() {
    delete_option( 'jlplg_lovecoding-field1-cookie-message' );
    delete_option( 'jlplg_lovecoding-field2-checkbox-privacy-policy' );
    delete_option( 'jlplg_lovecoding-field3-cookie-button-text' );
    delete_option( 'jlplg_lovecoding-field4-cookie-plugin-placement' );
    delete_option( 'jlplg_lovecoding-field5-background-color' );
    delete_option( 'jlplg_lovecoding-field6-text-color' );
    delete_option( 'jlplg_lovecoding-field7-button-background-color' );
    delete_option( 'jlplg_lovecoding-field8-button-text-color' );
    delete_option( 'jlplg_lovecoding-field9-cookie-expire-time' );
}

jlplg_lovecoding_delete_settings();

function jlplg_lovecoding_delete_cookies() {
    unset( $_COOKIE['jlplg-cookies-accepted'] );
    setcookie( sanitize_key( 'jlplg-cookies-accepted' ), '', 1);
}

jlplg_lovecoding_delete_cookies();

