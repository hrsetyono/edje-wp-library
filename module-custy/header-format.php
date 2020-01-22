<?php

new Custy_FormatHeader();


class Custy_FormatHeader {
  function __construct() {
    add_filter( 'custy_header_data', [$this, 'format_header_data' ], 1, 2 );
  }

  /**
   * Rearrange the confusing value into more-compact associative array
   * @filter custy_header_data
   */
  function format_header_data( $data ) {
    $data = [
      'desktop' => [],
      'mobile' => [],
    ];

    $raw_values = Custy::get_mod( 'header_placements' );
    $values = [];

    // get the selected type
    foreach( $raw_values['sections'] as $type ) {
      if ( $type['id'] === $raw_values['current_section'] ) {
        // format items
        $items = [];
        foreach( $type['items'] as $i ) {
          $items[ $i['id'] ] = $i['values'];
        }
        $type['items'] = $items;

        $values = $type;
        break;
      }
    }

    $data['desktop'] = $this->parse_rows( $values['desktop'], $values['items'] );
    $data['mobile'] = $this->parse_rows( $values['mobile'], $values['items'] );

    return $data;
  }

  /////


  /**
   * Assign values into each key. If not found, use default
   */
  private function parse_rows( $rows, $item_values ) {
    $data = [];
    $default_values = Custy::get_default_values();
    $formatter = new Custy_FormatValues();

    foreach( $rows as $row ) {
      $items = [];

      foreach( $row['placements'] as $col ) {
        if( count( $col['items'] ) <= 0 ) { continue; } // break if no items

        $col_id = str_replace( '-row', '', $col['id'] );
        $items[ $col_id ] = [];

        // get item value - if not found, use default
        foreach( $col['items'] as $item_id ) {
          $item = $item_values[ $item_id ] ?? $default_values[ $item_id ];
          $items[ $col_id ][ $item_id ] = $this->format_item( $item, $formatter );
        }
      }

      $data[ $row['id'] ] = $items;
    }

    return $data;
  }

  /**
   * Format each setting of an item
   */
  private function format_item( $item, $formatter = false ) {
    if( !$formatter ) {
      $formatter = new Custy_FormatValues();
    } 

    foreach( $item as $option => &$value ) {
      $value = $formatter->format( $value );
    }

    return $item;
  }
}