<?php
/**
 * @package MyPrivacyPolicy
 * 
 * Plugin Name: My Privacy Policy
 * Description: Set privacy policy on your site.
 * Version: 1.0.
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: JL
 * License: . 
 * Text Domain: jlprivacy
 * Domain Path: /languages
 * License: GPL2
 * 
 * {Plugin Name} is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *   
 * {Plugin Name} is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with {Plugin Name}. If not, see {URI to Plugin License}.
 */

defined( 'ABSPATH' ) or die( 'hey, you don\'t have an access to read this site' );

// jlplg_prvpol - jl plugin - privacy policy

// adding styles and scripts
function jlplg_prvpol_enqueue_scripts() {
    wp_enqueue_style( 'styles', plugins_url( 'styles.css', __FILE__ ) );
    wp_enqueue_script( 'script', plugins_url( 'public/js/script.js', __FILE__ ), true );
}
add_action( 'wp_enqueue_scripts', 'jlplg_prvpol_enqueue_scripts' );


// setting cookie - this function must be called before html code is displayed
function jlplg_prvpol_set_cookie() {
    // make action when cookie accept button was clicked
    if ( isset( $_POST['cookie-accept-button'] ) ) {
        $domain = explode('https://', site_url());
        if ( ! is_ssl() ) {
            $domain = explode('http://', site_url());
        }
        $domain = explode('/', $domain[1]);
        setcookie('cookie-accepted', 1, time()+3600*24*100, '/', $domain[0] );
        $current_url = is_ssl() ? 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] : 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        wp_redirect( $current_url );
        exit;
    }

    // make action when cookie privacy policy button was clicked
    if ( isset( $_POST['cookie-privacy-policy'] ) ) {
        $privacy_policy = get_privacy_policy_url();
        if ( empty($privacy_policy) ) {
            $privacy_policy = 'privacy-policy';
        }
        wp_redirect( $privacy_policy );
        exit;
    }
}
add_action('init', 'jlplg_prvpol_set_cookie');


// adding new page to admin menu
add_action( 'admin_menu', 'jlplg_prvpol_add_new_page' );
function jlplg_prvpol_add_new_page() {
    add_menu_page(
        'Privacy Policy',                                       // $page_title
        'Privacy Policy',                                       // $menu_title
        'manage_options',                                       // $capability
        'privacy-policy',                                       // $menu_slug
        'jlplg_prvpol_page_html_content',                       // $function
        plugin_dir_url(__FILE__) . 'images/icon_wporg.png',     // $icon_url
        90                                                      // $position
    );
}

// adding content to menu page
function jlplg_prvpol_page_html_content() {
    ?>
    <div class="wrap">
        <h2>Privacy Policy & Cookie Info</h2>
        <form action="options.php" method="post">
            
            <?php
            // outpus settings fields (without this there is error after clicking save settings button)
            settings_fields( 'jl_options' );                        // A settings group name. This should match the group name used in register_setting()
            // output setting sections and their fields
            do_settings_sections( 'jl-slug' );                      // The slug name of settings sections you want to output.
            // output save settings button
            $other_attributes = array( 'style' => 'background-color: white; color: blue; border: 1px solid blue' );
            submit_button( 'Save Settings', 'primary', 'submit', true, $other_attributes );     // Button text, button type, button id, wrap, any other attribute
            ?>
        </form>
    </div>
    <?php
}

// adding settings and sections
function jlplg_prvpol_add_new_settings() {
    // register setting
    $settins_field1_arg = array(
        'type' => 'string',
        'description' => 'descrption of settings for field1 and field2',
        'sanitize_callback' => 'jlplg_prvpol_sanitize_input_field',
        'default' => 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies'
    );
    $settins_field2_arg = array(
        'type' => 'boolean',
        'sanitize_callback' => 'jlplg_prvpol_sanitize_checkbox',
        'default' => true
    );
    register_setting( 'jl_options', 'jlplg_prvpol-field1-cookie-message', $settins_field1_arg);     // option group, option name, args
    register_setting( 'jl_options', 'jlplg_prvpol-field2-checkbox-privacy-policy', $settins_field2_arg);     // option group, option name, args
    register_setting( 'jl_options', 'field2', $settins_field1_arg);
    // adding sections
    add_settings_section( 'jlplg_prvpol_section_1_configuration', 'Configuration', null, 'jl-slug' );  // id (Slug-name to identify the section), title, callback, page slug
    add_settings_section( 'jl_setting_section_2', 'Section Title 2 - adding from section 2 options', 'jlplg_prvpol_section_2_text', 'jl-slug' );
    // adding fields for section
    add_settings_field( 'field-1-cookie-message', 'Cookie Message', 'jlplg_prvpol_field_1_callback', 'jl-slug', 'jlplg_prvpol_section_1_configuration' );       // id (Slug-name to identify the field), title, callback, slug-name of the settings page on which to show the section, section, args (attr for field)
    add_settings_field( 'field-2-privacy-policy-button', 'Display Privacy Policy Button', 'jlplg_prvpol_field_2_callback', 'jl-slug', 'jlplg_prvpol_section_1_configuration' );       // id (Slug-name to identify the field), title, callback, slug-name of the settings page on which to show the section, section, args (attr for field)
    add_settings_field( 'field-2', 'Field 2', 'jlplg_prvpol_field_callback2', 'jl-slug', 'jl_setting_section_2' );
}
add_action( 'admin_init', 'jlplg_prvpol_add_new_settings' );


function jlplg_prvpol_section_1_text() {
    echo 'to jest tresc sekcji 1';
}

function jlplg_prvpol_section_2_text() {
    echo 'to jest tresc sekcji 2';
}

function jlplg_prvpol_field_1_callback() {
    echo '<textarea type="text" cols="50" rows="4" name="jlplg_prvpol-field1-cookie-message" >'.get_option( "jlplg_prvpol-field1-cookie-message" ).'</textarea>';
}

function jlplg_prvpol_field_2_callback() {
    if ( get_option( "jlplg_prvpol-field2-checkbox-privacy-policy" ) ) {
        echo '<input type="checkbox" name="jlplg_prvpol-field2-checkbox-privacy-policy" checked />';
    } else {
        echo '<input type="checkbox" name="jlplg_prvpol-field2-checkbox-privacy-policy" />';
    }
}

function jlplg_prvpol_field_callback2() {
    echo '<textarea type="text" cols="50" rows="4" name="jlplg_prvpol_field1_message" value="'.get_option( "jlplg_prvpol_message" ).'" >'.get_option( "field2" ).'</textarea>';

    echo '<input type="text" name="field2" value="'.get_option( "field2" ).'" />';
}

// sanitize input
function jlplg_prvpol_sanitize_input_field( $input ) {
    if ( isset( $input ) ) {
        $input = sanitize_text_field( $input );
    }
    return $input;
}

// sanitize checkbox
function jlplg_prvpol_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// set cookie
function jlplg_prvpol_display_cookie_notice() {    
    if ( !isset( $_COOKIE['cookie-accepted'] ) ) {
        add_action('wp_body_open', 'jlplg_prvpol_your_function');
    }
}
add_action( 'init', 'jlplg_prvpol_display_cookie_notice');


// displaying cookie info on page
function jlplg_prvpol_your_function() {
?>
    <div class="jlplg-prvpol-cookie-info-container">
        <form action="" method="post" id="cookie-form">
            <p class="jlplg-prvpol-cookie-info"><?php echo get_option( "jlplg_prvpol-field1-cookie-message" ); ?></p>
            <div class="jlplg-prvpol-buttons">
            <button type="submit" name="cookie-accept-button" class="jlplg-prvpol-cookie-accept-button" id="cookie-accept-button">Accept Cookies</button>
            <?php if ( get_option( "jlplg_prvpol-field2-checkbox-privacy-policy" ) ) { ?>
            <button type="submit" name="cookie-privacy-policy" class="jlplg-prvpol-cookie-privacy-policy" id="cookie-privacy-policy">Privacy policy</button>
            <?php } ?>
            </div>
        </form>
    </div>
<?php
}