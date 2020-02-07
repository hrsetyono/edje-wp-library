<?php
/**
 * Get the values to be localized for Preview
 */
class Custy_SyncPreview {
  public $vars = [];
  public $typography_vars = [];
  public $background_vars = [];

  function __construct() {}

  /**
   * Return all the sync vars
   */
  function get_sync_vars() : array {
    return [
      'background' => $this->background_vars,
      'typography' => $this->typography_vars,
      'other' => $this->vars,
    ];
  }

  /**
   * Compile and format the CSS arguments to be accepted by Blocksy sync.js
   */
  function compile_from_sections( $sections ) {
    foreach( $sections as $section_id => $s ) {

      if( !isset( $s['options'] ) ) { continue; }

      $selector = $s['css_selector'] ?? ':root';
      $options = $s['options'][ $section_id . '_options' ]['inner-options'];

      foreach( $options as $option_id => $args ) {
        $this->format_args( $option_id, $args, $selector );
      }
    }
  }

  /**
   * Compile and format the CSS arguments to be accepted by Blocksy sync.js
   * 
   * @param $items (array) - Header or Footer list of items
   */
  function compile_from_items( $items, $type = 'header' ) {
    foreach( $items as $item_id => $i ) {

      if( !isset( $i['options'] ) ) { continue; }

      $selector = $i['css_selector'] ?? ':root';
      $options = $i['options'];
      
      foreach( $options as $option_id => $args ) {
        $this->format_args( $option_id, $args, $selector );
      }
    }
  }


  /**
   * 
   */
  private function format_args( $option_id, $args, $selector = ':root' ) {
    $var = [];
    $selector = $args['css_selector'] ?? $selector; // override
    $inner_options = $args['options'] ?? $args['inner-options'] ?? false;

    // if has inner options, loop it
    if( $inner_options ) {
      foreach( $inner_options as $inner_id => $inner_args  ) {
        $this->format_args( $inner_id, $inner_args, $selector );
      }
      return;
    }
    // abandon if has no "css" arg
    elseif( !isset( $args['css'] ) ) {
      return;
    }

    // add var depending on the type
    switch( $args['type'] ) {
      case 'ct-color-palettes-picker':
        return; // do nothing and return

      
      // special type that can have prefix
      case 'ct-typography':
      case 'ct-background':
        $var['id'] = $option_id;
        $var['selector'] = $selector;

        if( preg_match( '/--(\w+)/', $args['css'], $match ) ) {
          $var['prefix'] = $match[1];
        }

        if( $args['type'] == 'ct-typography' ) {
          $this->typography_vars[] = $var;
        } else {
          $this->background_vars[] = $var;
        }
        return;


      case 'ct-color-picker':
        foreach( $args['css'] as $prop => $value ) {
          preg_match('/(\w+)./', $value, $type ); // get the first key

          $var[] = [
            'selector' => $selector,
            'variable' => preg_replace( '/^--/', '', $prop ),
            'type' => 'color:' . $type[1],
          ];
        }
        break;


      case 'ct-border':
      case 'ct-box-shadow':
      case 'ct-spacing':
        $var['type'] = str_replace( 'ct-', '', $args['type'] );
        // intentionally without break


      default:
        $var['selector'] = $selector;
        $var['variable'] = preg_replace( '/^--/', '', $args['css'] );
        
        if( isset( $args['responsive'] ) ) {
          $var['responsive'] = $args['responsive'];
        }
        break;
    }

    $this->vars[ $option_id ] = $var;
  }

  /**
   * 
   */
  private function format_args_new( $args, $selector = ':root' ) {
    $var = [];
    $selector = $args['css_selector'] ?? $selector; // override
    $inner_options = $args['options'] ?? $args['inner-options'] ?? false;

    // abandon if has no "css" arg
    if( !isset( $args['css'] ) ) { return; }

    // add var depending on the type
    switch( $args['type'] ) {
      case 'ct-color-palettes-picker':
        return; // do nothing and return

      
      // special type that can have prefix
      case 'ct-typography':
      case 'ct-background':
        $var['id'] = $option_id;
        $var['selector'] = $selector;

        if( preg_match( '/--(\w+)/', $args['css'], $match ) ) {
          $var['prefix'] = $match[1];
        }

        if( $args['type'] == 'ct-typography' ) {
          $this->typography_vars[] = $var;
        } else {
          $this->background_vars[] = $var;
        }
        return;


      case 'ct-color-picker':
        foreach( $args['css'] as $prop => $value ) {
          preg_match('/(\w+)./', $value, $type ); // get the first key

          $var[] = [
            'selector' => $selector,
            'variable' => preg_replace( '/^--/', '', $prop ),
            'type' => 'color:' . $type[1],
          ];
        }
        break;


      case 'ct-border':
      case 'ct-box-shadow':
      case 'ct-spacing':
        $var['type'] = str_replace( 'ct-', '', $args['type'] );
        // intentionally without break

      default:
        $var['selector'] = $selector;
        $var['variable'] = preg_replace( '/^--/', '', $args['css'] );
        
        if( isset( $args['responsive'] ) ) {
          $var['responsive'] = $args['responsive'];
        }
        break;
    }

    $this->vars[ $option_id ] = $var;
  }
}