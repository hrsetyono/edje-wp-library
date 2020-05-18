<?php

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
  // if URL doesn't start with "http", prepend API_URL
  if( preg_match( '/^http/', $url, $matches ) ) {
    $url = API_URL . $url;
  }

  $get = wp_remote_get( $url, $args );
  return json_decode( $get['body'] );
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
  // if URL doesn't start with "http", prepend API_URL
  if( preg_match( '/^http/', $url, $matches ) ) {
    $url = API_URL . $url;
  }

  $post = wp_remote_post( $url, [
    'body' => $body
  ] );
  return json_decode( $post['body'] );
}



/////

/**
 * Register GET route. Can only be used in `rest_api_init` action.
 * 
 * `H::register_GET_route( '/sample/:id', 'callback' );`
 * 
 * @deprecated - Just use the original register_rest_route()
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
 * 
 * @deprecated - Just use the original register_rest_route()
 */
function h_register_POST_route( string $path, $callback ) {
  require_once __DIR__ . '/api-register.php';
  
  \h\API_Register::register_rest_route( $path, [
    'methods' => 'POST',
    'callback' => $callback
  ] );
}

