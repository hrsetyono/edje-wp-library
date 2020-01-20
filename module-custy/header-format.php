<?php

new Custy_FormatHeader();


class Custy_FormatHeader {
  function __construct() {
    add_filter( 'custy_render_header', [$this, 'rearrange_header_data' ], 1, 2 );
    add_filter( 'custy_render_header', [$this, 'format_header_data' ], 1, 2 );
  }

  /**
   * Rearrange the confusing value into more-compact associative array
   * @filter custy_render_header
   */
  function rearrange_header_data( $data ) {
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

    $data['desktop'] = $this->parse_values( $values['desktop'] );
    $data['mobile'] = $this->parse_values( $values['mobile'] );

    return $data;
  }

  /**
   * Format the header value
   * @filter custy_render_header
   */
  function format_header_data( $data ) {
    // var_dump( $data );

    return $data;
  }

  /////


  /**
   * Assign values into each key. If not found, use default
   */
  private function parse_values( $values ) {
    $data = [];
    $default_values = Custy::get_default_values();

    foreach( $values as $row ) {
      $items = [];
        
      foreach( $row['placements'] as $place ) {
        $items[ $place['id'] ] = [];

        // get item data - if not found, use default
        foreach( $place['items'] as $i ) {
          $items[ $place['id'] ][ $i ] = $values['items'][ $i ] ?? $default_values[ $i ];
        }
      }
      
      $data['desktop'][ $row['id'] ] = $items;
    }

    return $data;
  }

}