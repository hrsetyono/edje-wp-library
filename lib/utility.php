<?php
class H_Util {
  /*
    Transform Title into Slug format (lower case, underscore)

    @param $title
    @return string
  */
  public static function to_slug($title) {
    $slug = strtolower( str_replace(' ', '_', $title) );
    $slug = trim($slug, '^');
    return $slug;
  }

  /*
    Transform Slug into Title format (first letter capitalized, space)

    @param $slug
    @return string
  */
  public static function to_title($slug) {
    $title = ucwords( str_replace('_', ' ', $slug) );
    $title = trim($title, '^');
    return $title;
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
