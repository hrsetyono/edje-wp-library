<?php

/**
 * Class with generic methods for internal use
 */
class _H {
  /**
   * Transform Slug into Title format (first letter capitalized, space)
   * 
   * @param $slug
   * @return string
   */
  static function to_title( $slug ) {
    $title = ucwords( str_replace( array('_', '-'), ' ', $slug ) );
    $title = trim( $title, '^' );
    return $title;
  }

  /**
   * Transform Title into Slug format (lower case, underscore).
   */
  static function to_slug( $text, $separator = '_' ) {
    $targets = array( ' ', '[' , ']' );
    $replace_with = array( $separator, $separator, '' );

    $slug = strtolower( str_replace( $targets, $replace_with, $text ) );
    $slug = trim( $slug, '^' );
    return $slug;
  }

  /**
   * Alias for to_slug
   */
  static function to_param( $title ) {
    return self::to_slug( $title );
  }

  /**
   * Transform text to dashicons icon.
   */
  static function to_icon( $name ) {
    $full_name = 'dashicons-' . str_replace( 'dashicons-', '', $name );
    return $full_name;
  }
}