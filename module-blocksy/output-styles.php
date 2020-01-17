<?php

class H_Customizer_OutputStyles {

  public $theme_mods = [];
  public $styles = [];

  function __construct() {
    add_action( 'wp_head', [$this, 'render_mods'], 0 );
    add_action( 'admin_print_styles', [$this, 'render_admin_mods'], 0 );
  }

  /**
   * Output the theme mods for Frontend page
   * 
   * @action wp_head
   */
  function render_mods() {
    $this->theme_mods = wp_parse_args( get_theme_mods(), Custy::get_default_values() );
    
    // get all css value from options data
    $sections = _h_customizer_get_options();
    $this->compile_from_sections( $sections );

    $fs = new H_Customizer_FormatValues( $this->styles );
    $formatted_styles = $fs->format();

    $this->output( $formatted_styles );
  }


  /**
   * Output theme mods for Customizer page
   * 
   * @action admin_print_styles
   */
  function render_admin_mods() {
    $current_screen = get_current_screen()->id;
    if( !in_array( $current_screen, ['customize'] ) ) {
      return;
    }

    $mods = wp_parse_args( get_theme_mods(), Custy::get_default_values() );
    $admin_styles = [
      ':root' => [
        '--main'      => $mods['colorPalette']['color1']['color'],
        '--mainDark'  => $mods['colorPalette']['color2']['color'],
        '--mainLight' => $mods['colorPalette']['color3']['color'],
        '--sub'       => $mods['colorPalette']['color4']['color'],
        '--subLight'  => $mods['colorPalette']['color5']['color'],
        '--text'      => $mods['textColor']['default']['color'],
        '--textInvert' => $mods['textColor']['invert']['color'],
      ],
    ];

    $fs = new H_Customizer_FormatValues( $admin_styles );
    $formatted_styles = $fs->format();

    $this->output( $formatted_styles );
  }


  /////

  /**
   * Output the styles
   */
  private function output( $styles ) {
    $mobile_media = h_get_mod( 'mobile_media' );
    $tablet_media = h_get_mod( 'tablet_media' );

    $output = '';
    $medias = [
      'css' => [
        'attr' => '',
        'id' => 'ct-main-styles-inline-css',
      ],
      'tablet_css' => [
        'attr' => "media='(max-width: $tablet_media)'",
        'id' => 'ct-main-styles-tablet-inline-css',
      ],
      'mobile_css' => [
        'attr' => "media='(max-width: $mobile_media)'",
        'id' => 'ct-main-styles-mobile-inline-css',
      ],
    ];
    
    foreach( $medias as $key => $args ):
      if( count($styles[ $key ]) <= 0 ) { continue; }

      // add <style> tag
      $output .= "<style type='text/css' id='{$args['id']}' {$args['attr']}>";
      
      // add css properties
      foreach( $styles[ $key ] as $selector => $css ):
        $output .= " $selector { ";

        foreach( $css as $prop => $value ) {
          $output .= " $prop: $value; ";
        }

        $output .= " } ";
      endforeach;

      $output .= "</style>";
    endforeach;

    echo '<!-- Customizer -->';
    echo $output;
    echo '<!-- /Customizer -->';
  }

  /**
   * Compile all the "css" arguments from each section
   */
  private function compile_from_sections( $sections ) { 
    foreach( $sections as $section_id => $s ) {
      $selector = $s['css_selector'] ?? ':root';

      if( !isset( $s['options'] ) ) { continue; }

      $options = $s['options'][ $section_id . '_options' ]['inner-options'];

      $this->compile_from_options( $options, $selector );
    }
  }

  /**
   * Compile all the "css" arguments from each option
   * 
   * Format:
   * 
   *   $selector => [
   *     $option_id => [
   *       '--cssVar1' => 'value.key',
   *       '--cssVar2' => 'value.key2,
   *     ],
   *   ]
   */
  private function compile_from_options( $options, $parent_selector = ':root' ) {
    $styles = [];

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


new H_Customizer_OutputStyles();