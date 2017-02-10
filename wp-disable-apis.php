<?php
/*
 * Plugin Name: Disable APIs
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Disables the REST-API and XMLRPC to secure your Wordpress installation.
 * Version: 1.0
 * Author: Gummibeer
 * Author URI: https://gummibeer.de
 * License: MIT
*/

add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'json_enabled', '__return_false' );
add_filter( 'json_jsonp_enabled', '__return_false' );
add_filter( 'rest_enabled', '__return_false' );
add_filter( 'rest_jsonp_enabled', '__return_false' );

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) )
  exit;

if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) )
  exit;
