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

// prevent directly access to file
defined( 'ABSPATH' ) or die( 'hey, you don\'t have an access to read this site' );

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
      <form action="options.php" method="post">
        <h2>Page title</h2>
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