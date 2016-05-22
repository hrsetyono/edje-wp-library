<?php
class H_Elper {

  /*
    Transform Title into Param format (lower case, underscore)
    @param $title
    @return string
  */
  static function to_param($title) {
    $slug = strtolower( str_replace(' ', '_', $title) );
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
