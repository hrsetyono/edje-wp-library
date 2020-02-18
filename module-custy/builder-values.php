<?php

/**
 * Format the values of Header or Footer
 */
class Custy_BuilderValues {
  private $type;

  function __construct() {}

  /**
   * Format the header_placements data
   */
  function format_header( $section, $need_format = true ) {
    $this->type = 'header';

    $data = [
      'desktop' => $this->remove_empty_row( $section['desktop'] ),
      'mobile' => $this->remove_empty_row( $section['mobile'] ),
      'items' => $this->format_items_arg( $section, $need_format ),
    ];

    return $data;
  }


  /**
   * Format the footer_placements data
   */
  function format_footer( $section, $need_format = true ) {
    $this->type = 'footer';

    $data = [
      'rows' => $this->remove_empty_row( $section['rows'] ),
      'items' =>  $this->format_items_arg( $section, $need_format ),
    ];

    return $data;
  }

  
  /**
   * Get the section with the specified ID
   */
  function get_section( $placements, $id = null ) {
    // if ID is not given, use current ID
    if( empty( $id ) ) {
      $id = $placements['current_section'];
    }

    // search for the section with that ID
    foreach( $placements['sections'] as $section ) {
      if ( $section['id'] === $id ) {
        return $section;
      }
    }

    // if not found, just return the first one
    return $placements['sections'][0];
  }


  /**
   * Format the header_placements or footer_placements value from theme mod
   */
  function format_placements( $type = 'header', $raw_values = null, $need_format = true ) {
    $this->type = $type;

    $raw_values = $raw_values ?? Custy::get_mod( $type . '_placements' );
    $section = $this->get_current_section( $raw_values );

    $data = [];

    switch( $type ) {
      case 'header':
        $data = [
          'desktop' => $this->remove_empty_row( $section['desktop'] ),
          'mobile' => $this->remove_empty_row( $section['mobile'] ),
          'items' => $this->format_items_arg( $section, $need_format ),
        ];
        break;

      case 'footer':
        $data = [
          'rows' => $this->remove_empty_row( $section['rows'] ),
          'items' =>  $this->format_items_arg( $section, $need_format ),
        ];
        break;
    }
    
    return $data;
  }


  /////


  /**
   * get the selected header / footer
   */
  private function get_current_section( $raw_values ) {
    foreach( $raw_values['sections'] as $section ) {
      if ( $section['id'] === $raw_values['current_section'] ) {
        return $section;
      }
    }

    // else, return first one
    return $raw_values['sections'][0];
  }


  /**
   * Format all values and assign default value if doesn't exist
   * 
   * Why we need to do this:
   * - When an item is added, but all its values stay default, it won't exist in 'items' arg
   * - So we need to get all used items, and check if it has value. Otherwise, assign default value
   */
  private function format_items_arg( $section, $need_format = true ) {
    $items = [];
    $item_ids = [];
    $default_values = Custy::get_default_values( $this->type );

    // remap existing values
    $values = array_reduce( $section['items'], function( $result, $i ) {
      $result[ $i['id'] ] = $i['values'];
      return $result;
    }, [] );

    $item_ids = [];

    // get item ids
    switch( $this->type ) {
      case 'header':
        $item_ids = array_merge(
          $this->extract_item_ids( $section['desktop'] ),
          $this->extract_item_ids( $section['mobile'] )
        );
        break;

      case 'footer':
        $item_ids = $this->extract_item_ids( $section['rows'] );
        break;
    }


    $cv = new Custy_Values();

    // assign values to ids
    foreach( $item_ids as $id ) {
      $value = $values[ $id ] ?? $default_values[ $id ];
      $items[ $id ] = $need_format ? $cv->format( $value ) : $value;
    }

    return $items;
  }


  /**
   * Get all item IDs from each placements
   * 
   * @return array
   */
  private function extract_item_ids( $rows ) : array {
    $item_ids = [];

    foreach( $rows as $row ) {
      $columns = ($this->type === 'header') ? $row['placements'] : $row['columns'];

      foreach( $columns as $col ) {
        $items = ($this->type === 'header') ? $col['items'] : $col;

        foreach( $items as $id ) {
          if( in_array( $id, $item_ids ) ) { continue; }
          $item_ids[] = $id;
        }
      } 
    }

    // add the placement rows
    $item_ids = array_merge( $item_ids, [ 'top-row', 'middle-row', 'bottom-row' ] );
    if( $this->type === 'header' ) {
      $item_ids[] = 'offcanvas';
    }

    return $item_ids;
  }


  /**
   * Remove the row that has no item
   */
  private function remove_empty_row( $rows ) {
    foreach( $rows as &$row ) {
      $is_empty = true;
      
      // TODO: footer arg is shorter
      $columns = $this->type === 'header' ? $row['placements'] : $row['columns'];

      // check whether the whole row is empty
      if( $this->type === 'header' ) {
        foreach( $row['placements'] as $column ) {
          if( count( $column['items'] ) > 0 ) {
            $is_empty = false;
            break;
          }
        }

        if( $is_empty ) {
          $row['placements'] = [];
        }
      }
      elseif( $this->type === 'footer' ) {
        foreach( $row['columns'] as $column ) {
          if( count( $column ) > 0 ) {
            $is_empty = false;
            break;
          }
        }

        if( $is_empty ) {
          $row['columns'] = [];
        }
      }
    }

    return $rows;
  }
}