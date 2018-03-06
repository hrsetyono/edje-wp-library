<?php
// enable checking if plugin active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*
  Helper class for internal use
*/
class _H {
  /*
    Transform Title into Param format (lower case, underscore)
    @param $title
    @return string
  */
  static function to_param($title) {
    $targets = array( ' ', '[' , ']');
    $replace_with = array( '_', '_', '' );

    $slug = strtolower( str_replace( $targets, $replace_with, $title) );
    $slug = trim($slug, '^');
    return $slug;
  }

  /*
    Transform Slug into Title format (first letter capitalized, space)
    @param $slug
    @return string
  */
  static function to_title($slug) {
    $title = ucwords( str_replace('_', ' ', $slug) );
    $title = trim($title, '^');
    return $title;
  }

  static function to_slug($title) {
    $slug = strtolower( str_replace('_', '-', $title) );
    return $slug;
  }

  static function to_icon($name) {
    $full_name = 'dashicons-' . str_replace('dashicons-', '', $name);
    return $full_name;
  }

  /*
    Trim Post content into SEO friendly description. Only trim until nearest word.

    @param string $text - The raw post content
    @param int $char_number - Max characters
    @return string - The trimmed content
  */
  static function trim_content($text, $char_number ='156') {
    $text = html_entity_decode($text, ENT_QUOTES);
    if (strlen($text) > $char_number) {
      $text = substr($text, 0, $char_number);
      $text = substr($text,0,strrpos($text, ' '));

      $punctuation = '.!?:;,-'; // punctuation you want removed

      $text = (strspn(strrev($text),  $punctuation) != 0)
              ?
              substr($text, 0, -strspn(strrev($text),  $punctuation))
              :
              $text;
    }
    $text = htmlentities($text, ENT_QUOTES);
    return $text;
  }

  /*
    Check whether a plugin is active

    @param $slug string - The slug of a plugin, it's a pre-determinated keyword.
    @return bool
  */
  static function is_plugin_active($slug) {
    $path = array();

    switch($slug) {
      case 'yoast':
        array_push($path,
          'wordpress-seo/wp-seo.php',
          'wordpress-seo-premium/wp-seo-premium.php',
          'wordpress-seo-premium-trial/wp-seo-premium.php'
        );
        break;

      case 'jetpack':
        $path[] = 'jetpack/jetpack.php';
        break;

      case 'woocommerce':
        $path[] = 'woocommerce/woocommerce.php';
        break;

      case 'timber':
        $path[] = 'timber-library/timber.php';
        break;
    }

    // if at least 1 is active, returns true
    foreach($path as $p) {
      if(is_plugin_active($p) ) { return true; }
    }

    return false;
  }
}

// PHP 5.5 Array Column
if (! function_exists('array_column') ) {
  function array_column(array $input, $columnKey, $indexKey = null) {
    $array = array();
    foreach ($input as $value) {
      if ( ! isset($value[$columnKey])) {
        trigger_error('Key "$columnKey" does not exist in array');
        return false;
      }
      if (is_null($indexKey)) {
        $array[] = $value[$columnKey];
      }
      else {
        if ( ! isset($value[$indexKey])) {
          trigger_error('Key "$indexKey" does not exist in array');
          return false;
        }
        if ( ! is_scalar($value[$indexKey])) {
          trigger_error('Key "$indexKey" does not contain scalar value');
          return false;
        }
        $array[$value[$indexKey]] = $value[$columnKey];
      }
    }
    return $array;
  }
}
