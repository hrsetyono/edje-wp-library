<?php namespace h;

class API {
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


  /**
   * Do a GET request.
   */
  static function get_request( string $url, array $data = [] ) {
    $curl = curl_init();
    $url = self::format_request_url( $url );

    if( $data ) {
      $url = sprintf( "%s?%s", $url, http_build_query($data) );
    }

    curl_setopt( $curl, CURLOPT_URL, $url );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1) ;

    $result = curl_exec( $curl );
    curl_close( $curl );

    return json_decode( $result, true );
  }


  /**
   * Do a POST request.
   */
  static function post_request( string $url, array $data = [] ) {
    $url = self::format_request_url( $url );
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


  //

  /**
   * Create full URL for request
   */
  private static function format_request_url( $url ) {
    // if doesn't contain "http", prepend API_URL
    if( strpos( $url, 'http' ) !== false ) {
      return API_URL . $url;
    }

    return $url;
  }

}