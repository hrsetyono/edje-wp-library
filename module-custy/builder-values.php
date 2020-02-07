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
  function format_header_values( $raw_data = null ) {
    $this->type = 'header';
    $section = $this->get_current_section( $raw_data );

    $data = [
      'desktop' => $this->remove_empty_row( $section['desktop'] ),
      'mobile' => $this->remove_empty_row( $section['mobile'] ),
      'items' => CustyBuilder::compile_item_values( $section, 'header' ),
    ];

    return $data;
  }

  /**
   * Rearrange the confusing FOOTER value into more-compact associative array
   */
  function format_footer_values( $raw_data = null ) {
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
   * 
   */
  private function remove_empty_row( $rows ) {
    foreach( $rows as &$row ) {
      $is_empty = true;

      // check if all item is empty
      foreach( $row['placements'] as $column ) {
        if( count( $column['items'] ) > 0 ) {
          $is_empty = false;
        }
      }

      if( $is_empty ) {
        $row['placements'] = [];
      }
    }

    return $rows;
  }
}