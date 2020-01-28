<?php

/**
 * @filter custy_header_values 10
 * @filter custy_footer_values 10
 */
function _custy_format_builder_values( $values ) {
  $type = $values['sections'][0]['mode'] === 'placements' ? 'header' : 'footer';
  $bv = new Custy_BuilderValues();

  switch( $type ) {
    case 'header':
      return $bv->format_header_values( $values );
    case 'footer':
      return $bv->format_footer_values( $values );
  }
}


/**
 * Format the values of Header or Footer
 */
class Custy_BuilderValues {
  private $type;

  function __construct() {}

  /**
   * Rearrange the confusing HEADER value into more-compact associative array
   */
  function format_header_values( $rows ) {
    $this->type = 'header';
    $selected_rows = $this->get_selected_rows( $rows );

    $data = [
      'desktop' => $this->format_rows( $selected_rows, 'desktop' ),
      'mobile' => $this->format_rows( $selected_rows, 'mobile' ),
      'placements' => $this->format_items(
        [ 'top-row', 'middle-row', 'bottom-row', 'offcanvas' ],
        $selected_rows['items']
      ),
    ];

    return $data;
  }

  /**
   * Rearrange the confusing FOOTER value into more-compact associative array
   */
  function format_footer_values( $rows ) {
    $this->type = 'footer';
    $selected_rows = $this->get_selected_rows( $rows );

    $data = [
      'rows' => $this->format_rows( $selected_rows, 'rows' ),
      'placements' => $this->format_items(
        [ 'top-row', 'middle-row', 'bottom-row' ],
        $selected_rows['items']
      ),
    ];

    return $data;
  }

  /////

  /**
   * get the selected header / footer
   */
  private function get_selected_rows( $rows ) {
    foreach( $rows['sections'] as $type ) {
      if ( $type['id'] === $rows['current_section'] ) {

        $items = [];
        foreach( $type['items'] as $i ) {
          $items[ $i['id'] ] = $i['values'];
        }
        $type['items'] = $items;

        return $type;
      }
    }
  }


  /**
   * Assign values into each key. If not found, use default
   * 
   * @param $rows (array) - The Desktop / Mobile header rows
   * @param $media (array) - Either desktop or mobile
   */
  private function format_rows( $rows, $media = 'desktop' ) {
    $data = [];
    $values = $rows['items'];

    foreach( $rows[ $media ] as $row ) {
      $row_id = $row['id'];
      $data[ $row_id ] = []; // initiate row
      $columns = $this->type === 'header' ? $row['placements'] : $row;

      switch( $this->type ) {
        case 'header':
          foreach( $row['placements'] as $col ) {
            if( count( $col['items'] ) <= 0 ) { continue; } // skip if no items
    
            $col_id = $col['id'];
            $data[ $row_id ][ $col_id ] = $this->format_items( $col['items'], $values );
          }

          // complete the columns if at least one exists
          if( count( $data[ $row_id ] ) >= 1 ) {
            $data[ $row_id ] = wp_parse_args( $data[ $row_id ], [
              'start' => [],
              'start-middle' => [],
              'middle' => [],
              'middle-end' => [],
              'end' => [],
            ] );
          }
          break;
        
        case 'footer':
          $item_ids = [];
          foreach( $row['columns'] as $col ) {
            if( count( $col ) <= 0 ) { continue; } // skip if no items
            $item_ids[] = $col[0];
          }
          $data[ $row_id ] = $this->format_items( $item_ids, $values );
          break;
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
    $default_values = Custy::get_default_values( $this->type );
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