<?php

/**
 * @filter custy_header_items 0
 */
function _custy_set_header_items( $items ) {
  $bi = new Custy_BuilderItems();
  $items = $bi->populate_items( 'header' );

  return $items;
}

/**
 * @filter custy_footer_items 0
 */
function _custy_set_footer_items( $items ) {
  $bi = new Custy_BuilderItems();
  $items = $bi->populate_items( 'footer' );

  return $items;
}

/**
 * Format the options
 * 
 * @filter custy_header_items 9999
 * @filter custy_footer_items 9999
 */
function _custy_format_builder_items( $items, $include = 'all', $require_options = false ) {
  $bi = new Custy_BuilderItems();
  $type = isset( $items['offcanvas'] ) ? 'header' : 'footer';

  $items = $bi->filter_items( $items, $include );
  $items = $bi->format_items( $items, $type, $require_options );
  return $items;
}


/**
 * 
 */
class Custy_BuilderItems {
  function __construct() {}

  /**
   * Compile items by reading all files in /header or /footer
   * 
   * @param $type (string) - Either 'header' or 'footer'
   */
  function populate_items( $type = 'header' ) {
    $all_items = [];
    $files = glob( __DIR__ . "/{$type}-items/*.php" );

    // Loop all files
    foreach( $files as $f ) {
      $item = null; $items = null; // reset
      $file_name = basename( $f, '.php' );
      
      // SKIP if first letter is underscore
      if( preg_match( '/^_/', $file_name, $matches ) ) { continue; }

      // Get variable $item or $items from file
      require $f;

      if( isset( $item ) ) {
        $all_items[ $file_name ] = $item;
      }
      elseif( isset( $items ) ) {
        $all_items = array_merge( $all_items, $items );
      }
    }

    return $all_items;
  }


  /**
   * Return the needed items based on $include arg.
   * 
   * @param $items (array)
   * @param $include (string) - Either 'primary' (rows), 'secondary' (non-rows), or 'all'
   * 
   * @return array - Filtered items
   */
  function filter_items( $items, $include = 'all' ) {
    $filtered_items = [];

    foreach( $items as $id => $item ) {
      $id = str_replace('_', '-', $id );

      $is_primary = $item['is_primary'] ?? false;

      // Skip if include primary, but item is not primary
      if( $include === 'primary' && !$is_primary ) {
        continue;
      }
      // Skip if looking for secondary, but item is primary
      elseif( $include === 'secondary' && $is_primary ) {
        continue;
      }

      $filtered_items[ $id ] = $item;
    }

    return $filtered_items;
  }
  

  /**
   * Format the items to be accepted by Blocksy builder
   * 
   * @param $items (array)
   * @param $type (string) - Either 'header' or 'footer'
   * @param $require_options (bool) - Include the options arg or not
   */
  function format_items( $items, $type = 'header', $require_options = false ) {
    $formatted_items = [];
    $defaults = Custy::get_default_values( $type );
    $co = new Custy_Options();

    foreach( $items as $item_id => $item ) {
      $item_args = [
        'id' => $item_id,
        'is_primary' => $item['is_primary'] ?? false,
        'config' => [
          'name' => $item['title'],
          'description' => $item['description'] ?? '',
          'typography_keys' => [],
          'devices' => $item['devices'] ?? [ 'desktop', 'mobile' ],
          'selective_refresh' => $item['selective_refresh'] ?? [],
          'allowed_in' => $item['allowed_in'] ?? [],
          'excluded_from' => $item['excluded_from'] ?? [],
          'shortcut_style' => 'drop',
          'enabled' => true,
        ],
      ];

      if( $require_options && isset( $item['options'] ) ) {
        $item_args['options'] = $co->format( $item['options'], $defaults[ $item_id ] );
      }

      $formatted_items[] = $item_args;
    }
    
    return $formatted_items;
  }

}