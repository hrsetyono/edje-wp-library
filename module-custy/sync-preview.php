<?php
/**
 * Get the values to be localized for Preview
 */
class Custy_SyncPreview {
  public $vars = [];
  public $typography_vars = [];
  public $background_vars = [];
  public $header_vars = [];
  public $footer_vars = [];

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

      $this->get_var_from_options( $options, $selector );
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
  private function format_args_old( $option_id, $args, $selector = ':root' ) {
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
  private function get_var_from_options( $options, $selector = ':root' ) {

    foreach( $options as $option_id => $args ) {
      $selector = $args['css_selector'] ?? $selector; // override, if any
        
      // if has inner options, loop it
      $inner_options = $args['options'] ?? $args['inner-options'] ?? false;
  
      if( $inner_options ) {
        $this->get_var_from_options( $inner_options, $selector );
      } else {
        $var = $this->format_var( $option_id, $args, $selector );
        $this->assign_var_to_class( $var, $args );
      }
    }
  }

  /**
   * Format option args to be accepted by Sync.js
   */
  private function format_var( $option_id, $args, $selector = ':root' ) {
    $var = [];
    
    // abandon if has no "css" arg
    if( !isset( $args['css'] ) ) { return null; }

    // add var depending on the type
    switch( $args['type'] ) {

      // Skip color picker
      case 'ct-color-palettes-picker':
        return null; // do nothing and return

      
      // special type that can have prefix
      case 'ct-typography':
      case 'ct-background':
        $var['id'] = $option_id;
        $var['selector'] = $selector;

        if( preg_match( '/--(\w+)/', $args['css'], $match ) ) {
          $var['prefix'] = $match[1];
        }
        break;


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

    return $var;
  }

  /**
   * Assign to class variable depending on the type
   * 
   * @param $var (array)
   * @param $args (array)
   * @param $type (string) - normal | header | footer
   */
  private function assign_var_to_class( $var, $args, $type = 'normal' ) {

    switch( $args['type'] ) {
      case 'ct-typography':
        $this->typography_vars[] = $var;
        break;
      
      case 'ct-background':
        $this->background_vars[] = $var;
        break;
      
      default:
        $this->vars[] = $var;
        break;
    }
  }

} // class