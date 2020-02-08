<?php
/**
 * Helper methods for Header or Footer builder 
 */
class CustyBuilder {

  /**
   * Set a cache to Header and Footer items
   */
  static function set_items() {
    global $custy_header_items;
    global $custy_footer_items;

    $custy_header_items = apply_filters( 'custy_header_items', [] );
    $custy_footer_items = apply_filters( 'custy_footer_items', [] );
  }

  /**
   * Get Header or Footer items.
   * 
   * @param $type (string) - 'header' or 'footer'
   * @param $include (string) - 'primary', 'secondary', or 'all'. Primary is rows, Secondary is non-rows.
   * @param $require_options (bool) - include option arg or not.
   * @param $need_format (bool) - return formatted or non-formatted items
   * 
   * @return array
   */
  static function get_items( $type, $include = 'all', $require_options = false, $need_format = true ) {
    global $custy_header_items;
    global $custy_footer_items;

    // get items
    $items = $type === 'header' ? $custy_header_items : $custy_footer_items;

    // format items
    $bi = new Custy_BuilderItems();
    $items = $bi->filter_items( $items, $include );

    if( $need_format ) {
      $co = new Custy_Options();
      $items = $co->format_items( $items, $type, $require_options );
    }

    return $items;
  }


  /**
   * Get Header or Footer values
   * 
   * @param $type (string) - 'header' or 'footer'
   * @param $raw_values (array) - The raw mod value
   * 
   * @return string - HTML Markup
   */
  static function get_values( $type = 'header', $raw_values = null ) {
    $bv = new Custy_BuilderValues();
    $placements = $bv->format_placements( $type, $raw_values );
    return $placements;
  }


  /**
   * Render the content - Require Timber Library and view named '_header.twig' and '_footer.twig'
   */
  static function render( $type = 'header', $raw_values = null ) {
    if( !class_exists( 'Timber' ) ) { return; }

    $values = self::get_values( $type, $raw_values );
    return Timber::compile( "_{ $type }.twig", [ $type => $values ] );
  }
}