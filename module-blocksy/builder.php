<?php

/**
 * 
 */
class H_BuilderData {
  function __construct() {
    // add_filter( 'h_builder_items', [$this, 'format_items'], 10, 4 );
  }

	/**
	 * @param $include (string) - all | primary | secondary
	 */
  function format_items( $items,
    $panel_type = 'header',
    $include = 'all',
    $require_options = 'false') {

    
  }

  function get_data() {
    foreach( $this->header as &$h ) {
      $h['id'] = str_replace( '-row', '', $h['id'] );
  
      foreach( $h['placements'] as $p ) {
        $items = [];
        foreach( $p['items'] as $i ) {
          $items[ $i ] = $this->get_values( $i );
        }
  
        $p['items'] = $items;
      }
    }
  }

  /**
   * 
   */
  private function get_values( $section_id ) {
    $sections = _h_get_header_sections();
    $section = $sections[ $section_id ];


  }
}

new H_BuilderData();