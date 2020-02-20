<?php

/**
 * Collect  the CSS Variables from sections
 */
class Custy_CompileStyles {
  private $mod_values = [];
  private $current_values = [];
  private $styles = [];

  function __construct() {
    $this->mod_values = Custy::get_mods();
  }

  function get_styles() : array {
    return $this->styles;
  }

  /**
   * Compile all the "css" arguments from each section
   */
  function compile_from_sections( $sections ) { 
    foreach( $sections as $section_id => $args ) {
      $selector = $args['css_selector'] ?? ':root';

      if( !isset( $args['options'] ) ) { continue; }

      $options = $args['options'][ $section_id . '_options' ]['inner-options'];

      $this->current_values = $this->mod_values;
      $this->compile_from_options( $options, $selector );
    }
  }

  /**
   * Compile all the "css" arguments from each Header / Footer item
   * 
   * @param $item_options (array)
   * @param $type (string) - 'header' or 'footer'
   */
  function compile_from_items( $item_options, $type = 'header' ) {
    $data = [];

    switch( $type ) {
      case 'header':
        $data = CustyBuilder::get_header();
        break;
      case 'footer':
        $data = CustyBuilder::get_footer();
        break;
    }

    // search for css args
    foreach( $data['items'] as $item_id => $values ) {
      
      $item = $item_options[ $item_id ] ?? null;
      if( empty( $item ) ) { continue; }  // if item doesn't exist

      $options = $item_options[ $item_id ]['options'] ?? null;
      if( empty( $options ) ) { continue; } // if item doesn't have options

      $selector = $item['css_selector'] ?? ':root';

      $this->current_values = $values;
      $this->compile_from_options( $options, $selector );
    }
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
  private function compile_from_options( $options, $parent_selector = ':root' ) {
    // loop all options to find "css" arg
    foreach( $options as $option_id => $args ) {
      $selector = $args['css_selector'] ?? $parent_selector;

      // skip if has inner options
      if( isset( $args['options'] ) || isset( $args['inner-options'] ) ) {
        $this->compile_from_inner_options( $args, $selector );
        continue;
      }

      if( !isset( $args['css'] ) ) { continue; }

      // initiate empty selector
      $this->styles[ $selector ] = $this->styles[ $selector ] ?? [];

      // get value
      $value = $this->current_values[ $option_id ] ?? null;

      // if single value
      if( is_string( $args['css'] ) ) {
        $this->styles[ $selector ][ $args['css'] ] = $value;
      }
      // if Color picker which is multi value
      elseif( is_array( $args['css'] ) ) {

        foreach( $args['css'] as $prop => $index ) {
          $this->styles[ $selector ][ $prop ] = $this->compile_from_color_picker( $index, $value, $option_id );
        }
      }
    }
  }

  /**
   * Get inner options
   */
  private function compile_from_inner_options( $args, $parent_selector = ':root' ) {
    $selector = $args['css_selector'] ?? $parent_selector;

    $inner_options = $args['options'] ?? $args['inner-options'] ?? [];
    if( !empty( $inner_options ) ) {
      $this->compile_from_options( $inner_options, $selector );
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
   * Example: if the key is "hover", it will return $value['hover']['color']
   * 
   * @param $index (string) - Index key to get the value
   * @param $value (mixed) - Array value
   * @param $option_id (sting) - For error message
   * 
   * @return mixed
   */
  private function compile_from_color_picker( $index, $value, $option_id ) {

    foreach( $value as $color_id => &$color_value ) {
      switch( $color_id ) {
        case 'desktop':
        case 'tablet':
        case 'mobile':
          $color_value = $color_value[ $index ]['color'];
          break;

        default:
          if( $color_id == $index ) {
            return $color_value['color'];
          }
      }
    }

    return $value;
  }
}