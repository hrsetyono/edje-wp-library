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
    $raw_values = $raw_values ?? Custy::get_mod( $type . '_placements' );
    $formatted_data = [];
    $bv = new Custy_BuilderValues();

    switch( $type ) {
      case 'header':
        $formatted_data = $bv->format_header_values( $raw_values );
        break;
      case 'footer':
        $formatted_data = $bv->format_footer_values( $raw_values );
        break;
    }

    return $formatted_data;
  }

  /**
   * Render the content - Require Timber Library and view named '_header.twig' and '_footer.twig'
   */
  static function render( $type = 'header', $raw_values = null ) {
    if( !class_exists( 'Timber' ) ) { return; }

    $values = self::get_values( $type, $raw_values );
    return Timber::compile( "_{ $type }.twig", [ $type => $values ] );
  }


  /**
   * Collect all item values and assign default if doesn't exist
   * 
   * @param $section (array) - Current section of Header or Footer
   * @param $type (string)
   * @param $need_format (bool) - Should the value be formatted or not. Default = true
   * 
   * @return array - The item values in associative array (item_id as key)
   */
  static function compile_item_values( $section, $type = 'header', $need_format = true ) {
    $items = [];
    $item_ids = [];
    $default_values = Custy::get_default_values( $type );

    // remap existing values
    $values = array_reduce( $section['items'], function( $result, $i ) {
      $result[ $i['id'] ] = $i['values'];
      return $result;
    }, [] );

    $item_ids = [];

    // compile item ids
    switch( $type ) {
      case 'header':
        $item_ids = array_merge(
          self::_compile_item_ids( $section['desktop'], 'header' ),
          self::_compile_item_ids( $section['mobile'], 'header' )
        );
        break;
      case 'footer':
        $item_ids = self::_compile_item_ids( $section['rows'], 'footer' );
        break;
    }


    $formatter = new Custy_FormatValues();

    // assign values to ids
    foreach( $item_ids as $id ) {
      $value = $values[ $id ] ?? $default_values[ $id ];
      $items[ $id ] = $need_format ? $formatter->format( $value ) : $value;
    }

    return $items;
  }


  /**
   * Get item IDs from Header / Footer placements
   * 
   * @param $rows (array) - Header desktop/mobile placement or Footer rows
   * @param $type (string)
   * 
   * @return array
   */
  private static function _compile_item_ids( $rows, $type ) {
    $item_ids = [];

    foreach( $rows as $row ) {
      $columns = ($type === 'header') ? $row['placements'] : $row['columns'];

      foreach( $columns as $col ) {
        $items = ($type === 'header') ? $col['items'] : $col;

        foreach( $items as $id ) {
          if( in_array( $id, $item_ids ) ) { continue; }
          $item_ids[] = $id;
        }
      }
    }

    // add the placement rows
    $item_ids += [ 'top-row', 'middle-row', 'bottom-row' ];
    if( $type === 'header' ) {
      $item_ids += [ 'offcanvas' ];
    }

    return $item_ids;
  }

}