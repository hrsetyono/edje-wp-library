<?php

function load_hmodule_api() {

}

/**
 * Register GET route. Can only be used in `rest_api_init` action.
 * 
 * `H::register_GET_route( '/sample/:id', 'callback' );`
 */
function h_register_GET_route( string $path, $callback ) {
  require_once __DIR__ . '/api.php';
  
  \h\API::register_rest_route( $path, [
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
  require_once __DIR__ . '/api.php';
  
  \h\API::register_rest_route( $path, [
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
  require_once __DIR__ . '/api.php';
  return \h\API::get_request( $url, $data );
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
  require_once __DIR__ . '/api.php';
  return \h\API::post_request( $url, $data );
}


// function _h_get_url();