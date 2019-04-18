<?php
// enable checking if plugin active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*
  Helper class for internal use
*/
class _H {
  /*
    Transform Slug into Title format (first letter capitalized, space)
    
    @param $slug
    @return string
  */
  static function to_title( $slug ) {
    $title = ucwords( str_replace( array('_', '-'), ' ', $slug ) );
    $title = trim( $title, '^' );
    return $title;
  }

  /*
    Transform Title into Slug format (lower case, underscore)
    @param $text
    @return string
  */
  static function to_slug( $text ) {
    $targets = array( ' ', '[' , ']' );
    $replace_with = array( '_', '_', '' );

    $slug = strtolower( str_replace( $targets, $replace_with, $text ) );
    $slug = trim( $slug, '^' );
    return $slug;
  }

  /*
    Alias for to_slug
  */
  static function to_param( $title ) {
    return self::to_slug( $title );
  }

  /*
    Transform text to dashicons icon.

    DEPRECATED - replace the one in sidenav.php too
  */
  static function to_icon( $name ) {
    $full_name = 'dashicons-' . str_replace( 'dashicons-', '', $name );
    return $full_name;
  }

  /*
    Check whether a plugin is active

    @param $slug string - The slug of a plugin, it's a pre-determinated keyword.
    @return bool
  */
  static function is_plugin_active( $slug ) {
    $path = array();

    switch( $slug ) {
      case 'yoast':
        array_push( $path,
          'wordpress-seo/wp-seo.php',
          'wordpress-seo-premium/wp-seo-premium.php',
          'wordpress-seo-premium-trial/wp-seo-premium.php'
        );
        break;

      case 'the-seo-framework':
      case 'tsf':
        $path[] = 'autodescription/autodescription.php';
        break;

      case 'jetpack':
        $path[] = 'jetpack/jetpack.php';
        break;

      case 'woocommerce':
        $path[] = 'woocommerce/woocommerce.php';
        break;

      case 'timber':
        $path[] = 'timber-library/timber.php';
        $path[] = 'timber-library-150/timber.php';
        $path[] = 'timber-library-160/timber.php';
        $path[] = 'timber-library-170/timber.php';
        $path[] = 'timber-library-180/timber.php';
        $path[] = 'timber-library-190/timber.php';
        break;

      case 'acf':
        $path[] = 'advanced-custom-fields/acf.php';
        $path[] = 'advanced-custom-fields-pro/acf.php';
        $path[] = 'advanced-custom-fields-beta/acf.php';
        break;
    }

    // if at least 1 is active, returns true
    foreach( $path as $p ) {
      if( is_plugin_active( $p ) ) { return true; }
    }

    return false;
  }
}