<?php
/*
 * Plugin Name: Disable APIs
 * Plugin URI: https://github.com/Gummibeer/wp_disable_apis
 * Description: Disables the REST-API and XMLRPC to secure your Wordpress installation.
 * Version: 1.0
 * Author: Gummibeer
 * Author URI: https://gummibeer.de
 * License: MIT
*/

add_filter('xmlrpc_enabled', '__return_false');
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
add_filter('rest_authentication_errors', 'throw_rest_auth_error');

remove_action('wp_head', 'rsd_link');
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);

if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
    wp_die();
}

if (defined('REST_REQUEST') && REST_REQUEST) {
    wp_die();
}

function throw_rest_auth_error($access)
{
    return new WP_Error('api_disabled', 'The REST API is disabled.', ['status' => 404]);
}
