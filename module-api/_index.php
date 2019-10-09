<?php

add_action( 'plugins_loaded' , '_h_load_api' );

/**
 * @action plugins_loaded
 */
function _h_load_api() {

}

/////

/**
 * Register GET route. Can only be used in `rest_api_init` action.
 * 
 * `H::register_GET_route( '/sample/:id', 'callback' );`
 */
function h_register_GET_route( string $path, $callback ) {
  require_once __DIR__ . '/api-register.php';
  
  \h\API_Register::register_rest_route( $path, [
    'methods' => 'GET',
    'callback' => $callback
  ] );
}


/**
 * Register POST route. Can only be used in `rest_api_init` action.
 * 
 * `H::register_POST_route( '/sample/:id', 'callback' );`
 */
function h_register_POST_route( string $path, $callback ) {
  require_once __DIR__ . '/api-register.php';
  
  \h\API_Register::register_rest_route( $path, [
    'methods' => 'POST',
    'callback' => $callback
  ] );
}


/**
 * Do a GET request.
 * 
 * Usage:  
 * `H::GET( 'https://yoursite.com/wp-json/my/v1/get-endpoint', [] );`
 * 
 * Shorthand: (need to define base url in `API_URL` constant)
 * `H::GET( '/get-endpoint', [ 'param1' => 'value1' ] );`
 */
function h_GET( string $url, $data = [] ) {
  require_once __DIR__ . '/api-request.php';
  return \h\API_Request::get_request( $url, $data );
}


/**
 * Do a POST request.
 * 
 * Usage:  
 * `H::POST( 'https://yoursite.com/wp-json/my/v1/post-endpoint', [ 'param1' => 'value1' ] );`
 * 
 * Shorthand: (need to define base url in `API_URL` constant)  
 * `H::POST( '/post-endpoint', [ 'param1' => 'value1' ] );`
 */
function h_POST( string $url, $data = [] ) {
  require_once __DIR__ . '/api-request.php';
  return \h\API_Request::post_request( $url, $data );
}