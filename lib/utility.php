<?php
class H_Util {
  /*
    Transform Title into Slug format (lower case, underscore)

    @param $title
    @return string
  */
  public static function to_slug($title) {
    $slug = strtolower( str_replace(" ", "_", $title) );
    $slug = trim($slug, "^");
    return $slug;
  }

  /*
    Transform Slug into Title format (first letter capitalized, space)

    @param $slug
    @return string
  */
  public static function to_title($slug) {
    $title = ucwords( str_replace("_", " ", $slug) );
    $title = trim($title, "^");
    return $title;
  }
}
