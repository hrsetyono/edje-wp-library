<?php

/**
 * Do a GET request.
 * 
 * Usage:  
 * `H::GET( 'https://yoursite.com/wp-json/my/v1/get-endpoint' );`
 * 
 * Shorthand: (need to define base url in `API_URL` constant)
 * `H::GET( '/get-endpoint' );`
 */
function h_GET( string $url, $data = [] ) {
  // if URL doesn't start with "http", prepend API_URL
  if( !preg_match( '/^http/', $url, $matches ) ) {
    $url = API_URL . $url;
  }

  if( $data ) {
    $url = sprintf( "%s?%s", $url, http_build_query($data) );
  }
  
  $curl = curl_init();
  curl_setopt( $curl, CURLOPT_URL, $url );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1) ;

  $result = curl_exec( $curl );
  curl_close( $curl );

  return json_decode( $result, true );
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
  if( !preg_match( '/^http/', $url, $matches ) ) {
    $url = API_URL . $url;
  }

  $payload = json_encode( $data );

  // Prepare new cURL resource
  $ch = curl_init( $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLINFO_HEADER_OUT, true );
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
  
  // Set HTTP Header for POST request 
  curl_setopt( $ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen( $payload )
  ] );
  
  // Submit the POST request
  $response = curl_exec( $ch );
  curl_close( $ch );

  return $response;
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

