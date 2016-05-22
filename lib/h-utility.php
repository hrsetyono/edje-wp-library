<?php
class H_Util {
  /*
    Transform Title into Param format (lower case, underscore)

    @param $title
    @return string
  */
  public static function to_param($title) {
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

  public static function to_slug($title) {
    $slug = strtolower( str_replace('_', '-', $title) );
    return $slug;
  }

  public static function to_icon($name) {
    $full_name = 'dashicons-' . str_replace('dashicons-', '', $name);
    return $full_name;
  }

}
