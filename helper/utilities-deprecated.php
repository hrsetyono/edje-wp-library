<?php

/**
 * Register GET route. Can only be used in `rest_api_init` action.
 * 
 * `H::register_GET_route( '/sample/:id', 'callback' );`
 * 
 * @deprecated - Just use the original register_rest_route()
 */
function h_register_GET_route( string $path, $callback ) {
  global $h_api_namespace;
  $path = preg_replace( '/(:)(.+)/', '(?P<$2>.+)', $path );

  register_rest_route( $h_api_namespace, $path, [
    'methods' => 'GET',
    'callback' => $args['callback']
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
  global $h_api_namespace;
  $path = preg_replace( '/(:)(.+)/', '(?P<$2>.+)', $path );

  register_rest_route( $h_api_namespace, $path, [
    'methods' => 'POST',
    'callback' => $args['callback']
  ] );
}

