<?php

/**
 * @filter custy_header_items 9999
 * @filter custy_footer_items 9999
 */
function _custy_format_builder_items( $items, $include = 'all', $require_options = false ) {
  $bi = new Custy_BuilderItems();
  $type = isset( $items['offcanvas'] ) ? 'header' : 'footer';

  $items = $bi->filter_items( $items, $include );
  return $bi->format_items( $items, $type, $require_options );
}



class Custy_BuilderItems {
  function __construct() {}

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

    foreach( $items as $item_id => $item ) {
      $item_args = [
        'id' => $item_id,
        'config' => [
          'name' => $item['title'],
          'description' => '',
          'typography_keys' => [],
          'devices' => [ 'desktop', 'mobile' ],
          'selective_refresh' => [],
          'allowed_in' => [],
          'excluded_from' => [],
          'shortcut_style' => 'drop',
          'enabled' => true,
        ],
        'is_primary' => $item['is_primary'] ?? false,
      ];

      if( $require_options && isset( $item['options'] ) ) {
        $defaults = Custy::get_default_values( $type );
        $formatter = new Custy_FormatSections();

        $item_args['options'] = $formatter->format( $item['options'], $defaults[ $item_id ] ?? null );
      }

      $formatted_items[] = $item_args;
    }

    return $formatted_items;
  }

}