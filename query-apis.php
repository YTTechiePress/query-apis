<?php
/**
 * Plugin name: Query APIs
 * Plugin URI: https://omukiguy.com
 * Description: Get information from external APIs in WordPress
 * Author: Laurence Bahiirwa
 * Author URI: https://omukiguy.com
 * version: 0.1.0
 * License: GPL2 or later.
 * text-domain: query-apis
 */

// If this file is access directly, abort!!!
defined( 'ABSPATH' ) or die( 'Unauthorized Access' );

function techiepress_get_send_data() {

    $url = 'https://jsonplaceholder.typicode.com/users';
    
    $arguments = array(
        'method' => 'GET'
    );

	$response = wp_remote_get( $url, $arguments );

	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		echo '<pre>';
		var_dump( wp_remote_retrieve_body( $response ) );
		echo '</pre>';
	}
}	

/**
 * Register a custom menu page to view the information queried.
 */
function techiepress_register_my_custom_menu_page() {
	add_menu_page(
		__( 'Query API Test Settings', 'query-apis' ),
		'Query API Test',
		'manage_options',
		'api-test.php',
		'techiepress_get_send_data',
		'dashicons-testimonial',
		16
	);
}

add_action( 'admin_menu', 'techiepress_register_my_custom_menu_page' );
