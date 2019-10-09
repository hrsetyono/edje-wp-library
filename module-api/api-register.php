<?php namespace h;

class API_Register {
  /**
   * Create full path for registering route
   */
  static function register_rest_route( $path, $args ) {
    global $h_api_namespace;
    $path = preg_replace( '/(:)(.+)/', '(?P<$2>.+)', $path );

    register_rest_route( $h_api_namespace, $path, [
      'methods' => $args['methods'],
      'callback' => $args['callback']
    ] );
  }

}