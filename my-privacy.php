<?php
/**
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


function jlprivacy_activate_plugin() {
    // do domething on activation
}
register_activation_hook( __FILE__, 'jlprivacy_activate_plugin' );

function jlprivacy_deactivate_plugin() {
    // do domething on activation
}
register_deactivation_hook( __FILE__, 'jlprivacy_deactivate_plugin' );

function jlprivacy_uninstall_plugin() {
    // do domething on activation
}
register_uninstall_hook( __FILE__, 'jlprivacy_uninstall_plugin' );