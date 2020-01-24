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
    $raw_rows = Custy::get_mod( 'header_placements' );
    $selected_rows = [];

    // get the selected header (in case there are multiple)
    foreach( $raw_rows['sections'] as $type ) {
      if ( $type['id'] === $raw_rows['current_section'] ) {

        $items = [];
        foreach( $type['items'] as $i ) {
          $items[ $i['id'] ] = $i['values'];
        }
        $type['items'] = $items;

        $selected_rows = $type;
        break;
      }
    }

    $data = [
      'desktop' => $this->format_rows( $selected_rows, 'desktop' ),
      'mobile' => $this->format_rows( $selected_rows, 'mobile' ),
      'rows' => $this->format_items(
        [ 'top-row', 'middle-row', 'bottom-row', 'offcanvas' ],
        $selected_rows['items']
      ),
    ];

    return $data;
  }

  /////


  /**
   * Assign values into each key. If not found, use default
   * 
   * @param $rows (array) - The Desktop / Mobile header rows
   * @param $media (array) - Either desktop or mobile
   */
  private function format_rows( $rows, $media = 'desktop' ) {
    $data = [];

    foreach( $rows[ $media ] as $row ) {
      $row_id = $row['id'];
      $data[ $row_id ] = []; // initiate columns
      
      foreach( $row['placements'] as $col ) {
        if( count( $col['items'] ) <= 0 ) { continue; } // skip if no items

        $col_id = $col['id'];
        $data[ $row_id ][ $col_id ] = $this->format_items( $col['items'], $rows['items'] );
      }
    }

    return $data;
  }

  /**
   * Format all items in the column
   * 
   * @param $item_ids (array) - List of item IDs
   * @param $values (array) - All the header item's values
   */
  private function format_items( $item_ids, $values ) {
    $items = [];
    $default_values = Custy::get_default_values( 'header' );
    $formatter = new Custy_FormatValues();

    // get item value - if not found, use default
    foreach( $item_ids as $id ) {
      $item = $values[ $id ] ?? $default_values[ $id ];

      foreach( $item as $option => &$value ) {
        $value = $formatter->format( $value );
      }

      $items[ $id ] = $item;
    }

    return $items;
  }
}