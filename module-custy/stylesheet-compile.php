<?php

/**
 * Collect all the CSS Variables from sections
 */
class Custy_CompileStyles {
  private $theme_mods = [];
  private $styles = [];

  function __construct( $theme_mods ) {
    $this->theme_mods = $theme_mods;
  }

  /**
   * Compile all the "css" arguments from each section
   * 
   * @return array - the compiled css variables
   */
  function compile( $sections ) { 
    foreach( $sections as $section_id => $s ) {
      $selector = $s['css_selector'] ?? ':root';

      if( !isset( $s['options'] ) ) { continue; }

      $options = $s['options'][ $section_id . '_options' ]['inner-options'];

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
  private function compile_from_options( $options, $parent_selector = ':root' ) {
    // loop all options to find "css" arg
    foreach( $options as $opt_id => $args ) {

      $selector = $args['css_selector'] ?? $parent_selector;

      // if has inner options
      if( isset( $args['options'] ) || isset( $args['inner-options'] ) ) {
        $this->compile_from_inner_options( $args, $selector );
        continue;
      }
   
      if( !isset( $args['css'] ) ) { continue; }
    
      // initiate empty selector
      $this->styles[ $selector ] = $this->styles[ $selector ] ?? [];

      $value = $this->get_mod_value( $opt_id );

      // if single css
      if( is_string( $args['css'] ) ) {
        $this->styles[ $selector ][ $args['css'] ] = $value;
      }
      // if multi css
      elseif( is_array( $args['css'] ) ) {
        foreach( $args['css'] as $prop => $index ) {
          $this->styles[ $selector ][ $prop ] = $this->get_indexed_value( $value, $index );
        }
      }
    }
  }

  /**
   * Get inner options
   */
  private function compile_from_inner_options( $args, $parent_selector = ':root' ) {
    $selector = $args['css_selector'] ?? $parent_selector;

    switch( $args['type'] ) {
      case 'tab':
      case 'ct-condition':
        $this->compile_from_options( $args['options'], $selector );
        break;
      case 'ct-panel':
        $this->compile_from_options( $args['inner-options'], $selector );
        break;
    }
  }

  /**
   * Get value from theme mods
   */
  private function get_mod_value( $opt_id ) {
    if( !isset( $this->theme_mods[ $opt_id ] ) ) {
      trigger_error( 'Default value not set: ' . $opt_id, E_USER_ERROR );
    }

    return $this->theme_mods[ $opt_id ];
  }

  /**
   * Get value from associative array
   * 
   * @param $value (mixed) - Array value
   * @param $index (string) - Index key to get the value
   * 
   * @return mixed
   */
  private function get_indexed_value( $value, $index ) {
    $indexes = explode( '.', $index );

    // dig down until last index
    foreach( $indexes as $i ) {
      $value = $value[ $i ];
    }

    return $value;
  }
}