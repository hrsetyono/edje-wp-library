<?php

/**
 * Format the values of Header or Footer
 */
class Custy_BuilderValues {
  private $type;

  function __construct() {}

  /**
   * Rearrange the confusing HEADER value into more-compact associative array
   */
  function format_header_values( $raw_data ) {
    $this->type = 'header';
    $section = $this->get_current_section( $raw_data );

    $data = [
      // TODO: hide row if empty
      'desktop' => $section['desktop'], // $this->format_rows( $selected_rows['desktop'], 'desktop' ),
      'mobile' => $section['mobile'], // $this->format_rows( $selected_rows, 'mobile' ),
      'items' => CustyBuilder::compile_item_values( $section, 'header' ),
    ];

    return $data;
  }

  /**
   * Rearrange the confusing FOOTER value into more-compact associative array
   */
  function format_footer_values( $raw_data ) {
    $this->type = 'footer';
    $section = $this->get_current_section( $raw_data );

    $data = [
      'rows' => $section['rows'],
      'items' =>  CustyBuilder::compile_item_values( $section, 'footer' ),
    ];

    return $data;
  }

  /////

  /**
   * get the selected header / footer
   */
  private function get_current_section( $raw_data ) {
    foreach( $raw_data['sections'] as $type ) {
      if ( $type['id'] === $raw_data['current_section'] ) {
        return $type;
      }
    }

    // else, return first one
    return $raw_data['sections'][0];
  }


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
      $data[ $row_id ] = []; // initiate row
      $columns = $this->type === 'header' ? $row['placements'] : $row;

      switch( $this->type ) {
        case 'header':
          // complete the columns if at least one exists
          if( count( $data[ $row_id ] ) >= 1 && $row_id !== 'offcanvas' ) {
            $data[ $row_id ] = wp_parse_args( $data[ $row_id ], [
              'start' => [],
              'start-middle' => [],
              'middle' => [],
              'middle-end' => [],
              'end' => [],
            ] );
          }
          break;
      }
    }

    return $data;
  }
}