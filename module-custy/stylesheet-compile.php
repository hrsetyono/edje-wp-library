<?php

/**
 * Collect all the CSS Variables from sections
 */
class Custy_CompileStyles {
  private $mod_values = [];
  private $current_values = [];
  private $styles = [];

  function __construct() {
    $this->mod_values = Custy::get_mods();
  }

  /**
   * Compile all the "css" arguments from each section
   * 
   * @return array - the compiled CSS variables
   */
  function compile_from_sections( $sections ) { 
    foreach( $sections as $section_id => $args ) {
      $selector = $args['css_selector'] ?? ':root';

      if( !isset( $args['options'] ) ) { continue; }

      $options = $args['options'][ $section_id . '_options' ]['inner-options'];

      $this->current_values = $this->mod_values;
      $this->compile_from_options( $options, $selector );
    }

    return $this->styles;
  }

  /**
   * Compile all the "css" arguments from each Header / Footer item
   * 
   * @param $item_options (array)
   * @param $type (string) - 'header' or 'footer'
   * 
   * @return array - the compiled CSS variables
   */
  function compile_from_items( $item_options, $type = 'header' ) {
    // get the placement mod
    $placements = $this->mod_values[ $type . '_placements' ];
    
    // get the selected section
    $item_values = [];
    foreach( $placements['sections'] as $s ) {
      if( $s['id'] === $placements['current_section'] ) {
        $item_values = $s['items'];
        break;
      }
    }

    // loop all selected items
    foreach( $item_values as $val ) {

      $item = $item_options[ $val['id'] ] ?? null;
      if( empty( $item ) ) { continue; }  // if item doesn't exist

      $options = $item['options'] ?? null;
      if( empty( $options ) ) { continue; } // if item doesn't have options

      $selector = $item['css_selector'] ?? ':root';
      $this->current_values = $val['values'];
      $this->compile_from_options( $options, $selector );
    }

    return $this->styles;
  }

  /**
   * Compile all the "css" arguments from each option
   * 
   * Format:
   * 
   *   'selector' => [
   *     '--cssVar1' => 'value1',
   *     '--cssVar2' => 'value2',
   *   ]
   */
  private function compile_from_options( $options, $parent_selector = ':root', $all_values = [] ) {
    // loop all options to find "css" arg
    foreach( $options as $option_id => $args ) {
      $selector = $args['css_selector'] ?? $parent_selector;

      // skip if has inner options
      if( isset( $args['options'] ) || isset( $args['inner-options'] ) ) {
        $this->compile_from_inner_options( $args, $selector, $all_values );
        continue;
      }

      // skip if has no "css" arg
      if( !isset( $args['css'] ) ) {
        continue;
      }

      // initiate empty selector
      $this->styles[ $selector ] = $this->styles[ $selector ] ?? [];

      // get value
      $value = $this->current_values[ $option_id ] ?? trigger_error( 'Default value not set: ' . $option_id, E_USER_ERROR );

      // if single value
      if( is_string( $args['css'] ) ) {
        $this->styles[ $selector ][ $args['css'] ] = $value;
      }
      // if multi values
      elseif( is_array( $args['css'] ) ) {
        foreach( $args['css'] as $prop => $index ) {
          $this->styles[ $selector ][ $prop ] = $this->parse_multi_value( $value, $index );
        }
      }
    }
  }

  /**
   * Get inner options
   */
  private function compile_from_inner_options( $args, $parent_selector = ':root', $all_values = [] ) {
    $selector = $args['css_selector'] ?? $parent_selector;

    switch( $args['type'] ) {
      case 'tab':
      case 'ct-condition':
        $this->compile_from_options( $args['options'], $selector, $all_values );
        break;
      case 'ct-panel':
        $this->compile_from_options( $args['inner-options'], $selector, $all_values );
        break;
    }
  }

  /**
   * Get value from theme mods
   */
  private function get_mod_value( $option_id ) {
    if( !isset( $this->theme_mods[ $option_id ] ) ) {
      trigger_error( 'Default value not set: ' . $option_id, E_USER_ERROR );
    }

    return $this->theme_mods[ $option_id ];
  }

  /**
   * Get a value from associative array using dot notation.
   * Example: if the index is "hover.color", it will return $value['hover']['color']
   * 
   * @param $value (mixed) - Array value
   * @param $index (string) - Index key to get the value
   * 
   * @return mixed
   */
  private function parse_multi_value( $value, $index ) {
    $indexes = explode( '.', $index );

    // dig down until last index
    foreach( $indexes as $i ) {
      $value = $value[ $i ];
    }

    return $value;
  }
}