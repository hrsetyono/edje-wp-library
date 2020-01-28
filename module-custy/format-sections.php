<?php

/**
 * @filter custy_sections 99999
 */
function _custy_format_sections( $sections ) {
  $fs = new Custy_FormatSections();
  return $fs->format_all( $sections );
}


/**
 * Format the simplified option args into complete one that's accepted by Blocksy
 */
class Custy_FormatSections {
  function __construct() {
  }

  /**
   * Format all sections
   */
  function format_all( $sections ) : array {
    foreach( $sections as $section_id => &$s ) {
      if( !isset( $s['options'] ) ) { continue; }
      
      // add selector notice
      if( isset( $s['css_selector'] ) ) {
        $s['options'] = $this->add_css_selector_notice( $s['css_selector'], $s['options'] );
      }

      $formatted_options = $this->format( $s['options'] );
      
      $s['options'] = [
        $section_id . '_options' => [
          'type' => 'ct-options',
          'setting' => [ 'transport' => 'postMessage' ],
          'inner-options' => $formatted_options
        ]
      ];

      // If core section, add this options to prevent JS error
      if( $section_id === 'cores' ) {
        $s['options']['customizer_color_scheme'] = [
          'label' => __( 'Color scheme' ),
          'type' => 'hidden',
          'label' => '',
          'value' => 'no',
          'setting' => [ 'transport' => 'postMessage' ],
        ];
      }
    }

    return $sections;
  }

  /**
   * Format one section
   * 
   * @param $options (array) - List of customizer options
   * @param $defaults (bool) - List of default values using options ID as it's key
   * 
   * @return array - The formatted options
   */
  function format( $options, $defaults = null ) {
    $defaults = $defaults ?? Custy::get_default_values();
   
    foreach( $options as $id => &$args ):
      // set default value
      if( isset( $defaults[ $id ] ) ) {
        $args['value'] = $defaults[ $id ];
      }

      if( !isset( $args['type'] ) ) {
        trigger_error( 'Option type not set: ' . $id , E_USER_ERROR );
      }

      switch( $args['type'] ):
        case 'tab':
        case 'ct-condition':
          $args['options'] = $this->format( $args['options'] );

          if( isset($args['css_selector']) ) {
            $args['options'] = $this->add_css_selector_notice( $args['css_selector'], $args['options'] );
          }
          continue;
       
        case 'ct-panel':
          $args['inner-options'] = $this->format( $args['inner-options'] );
          
          if( isset($args['css_selector']) ) {
            $args['inner-options'] = $this->add_css_selector_notice( $args['css_selector'], $args['inner-options'] );
          }
          continue;
        
        case 'ct-color-palettes-picker':
          $args['predefined'] = true;
          $args['value'] = $this->format_color_palettes( $args['value'] );
          break;

        case 'ct-color-picker':
          $args['skipEditPalette'] = true;
          $args['pickers'] = $this->format_pickers( $args['pickers'] );
          break;

        case 'ct-slider':
          $args['units'] = $this->format_units( $args['units'] );
          break;

        // RADIO
        case 'ct-radio/alignment':
        case 'ct-radio/align':
          $args['type'] = 'ct-radio';
          $args['attr'] = [ 'data-type' => 'alignment' ];
          $args['choices'] = [ 'left' => '', 'center' => '', 'right' => '' ];
          break;

        // SELECT
        case 'ct-select':
          $args['choices'] = blocksy_ordered_keys( $args['choices'] );
          break;

        case 'ct-select/shadow':
          $args['type'] = 'ct-select';
          $args['view'] = 'text';
          $args['choices'] = $this->get_shadow_choices();
          break;

        case 'ct-select/heading':
          $args['type'] = 'ct-select';
          $args['view'] = 'text';
          $args['choices'] = $this->get_heading_choices();
          break;

        case 'ct-select/text':
        case 'ct-select/text-size':
          $args['type'] = 'ct-select';
          $args['view'] = 'text';
          $args['choices'] = $this->get_text_size_choices();
          break;

        case 'ct-visibility':
          $args['choices'] = blocksy_ordered_keys([
            'desktop' => __( 'Desktop' ),
						'tablet' => __( 'Tablet' ),
						'mobile' => __( 'Mobile' ),
          ]);
          break;

        case 'ct-title':
        case 'ct-divider':
          continue;
      endswitch;


      $args['setting'] = $args['setting'] ?? [ 'transport' => 'postMessage' ];
      $args['design'] = $args['design'] ?? $this->get_default_design( $args['type'] );

      // add css variable
      if( isset( $args['css'] ) ) {
        $args['desc'] = $args['desc'] ?? '';
        $args['desc'] .= $this->format_css_desc( $args );
      }
      
    endforeach;

    return $options;    
  }

  /////

  /**
   * Convert pickers to be ordered array
   */
  private function format_pickers( $pickers_arg ) {
    $pickers = [];
    foreach( $pickers_arg as $id => $title ) {
      $pickers[] = [
        'id' => $id,
        'title' => $title,
      ];
    }
    
    return $pickers;
  }

  /**
   * Add palette selection
   */
  private function format_color_palettes( $value ) {
    return wp_parse_args( $value, [
      'current_palette' => 'palette-1',
      'palettes' => [ [
        'id' => 'palette-1',
        'color1' => [ 'color' => $value['color1']['color'] ],
        'color2' => [	'color' => $value['color2']['color'] ],
        'color3' => [	'color' => $value['color3']['color'] ],
        'color4' => [	'color' => $value['color4']['color'] ],
        'color5' => [	'color' => $value['color5']['color'] ]
      ] ]
    ] );
  }


  /**
   * Convert units to be ordered array
   */
  private function format_units( $units_arg ) {
    $units = [];
    foreach( $units_arg as $id => $value ) {
      $units[] = [
        'unit' => $id,
        'min' => $value['min'],
        'max' => $value['max'],
      ];
    }

    return $units;
  }

  /**
   * Add a toggle button to show CSS Variables
   */
  private function format_css_desc( $args ) {
    $content = '';
    $css = $args['css'];
    $vars = [];

    switch( $args['type'] ) {
      case 'ct-typography':
        $base_vars = [
          'fontSize',
          'fontFamily',
          'fontStyle',
          'fontWeight',
          'lineHeight',
          'letterSpacing',
          'textDecoration',
          'textTransform',
        ];

        $vars = $this->format_css_desc_prefix( $base_vars, $args['css'] );
        break;

      case 'ct-background':
        $base_vars = [
          'background',
          'backgroundColor',
        ];

        $vars = $this->format_css_desc_prefix( $base_vars, $args['css'] );
        break;

      default:
        $vars = is_array( $css ) ? array_keys( $css ) : [ $css ];
    }


    // wrap each vars with <code>...</code>
    if( count( $vars ) > 0 ) {
      $content = '<code>' . implode( '</code><code>', $vars ) . '</code>';
    }

    // if has its own selector
    $selector_override = $args['css_selector'] ?? false;
    if( $selector_override ) {
      $content .= "<br> CSS Selector: <code>$selector_override</code>";
    }
  
    return "<details> <summary>CSS</summary>
      $content
    </details>";
  }

  /**
   * Add prefix to all the CSS vars
   */
  function format_css_desc_prefix( $vars, $prefix = '--$' ) {
    $prefix = str_replace( '$', '', $prefix );

    foreach( $vars as &$v ) {
      if( $prefix !== '--' ) {
        $v = ucfirst( $v );
      }

      $v = $prefix . $v;
    }

    return $vars;
  }


  /**
   * Get choices of shadow
   */
  private function get_shadow_choices() {
    return blocksy_ordered_keys([
      'none' => __( 'None' ),
      'var(--shadow0)' => __( 'Depth 0' ),
      'var(--shadow1)' => __( 'Depth 1' ),
      'var(--shadow2)' => __( 'Depth 2' ),
      'var(--shadow3)' => __( 'Depth 3' ),
      'var(--shadow4)' => __( 'Depth 4' ),
    ]);
  }

  
  /**
   * Return array for Title size selection
   */
  private function get_heading_choices() {
    return blocksy_ordered_keys([
      'var(--h1Size)' => __( 'Heading 1' ),
      'var(--h2Size)' => __( 'Heading 2' ),
      'var(--h3Size)' => __( 'Heading 3' ),
      'var(--h4Size)' => __( 'Heading 4' ),
      'var(--h5Size)' => __( 'Heading 5' ),
      'var(--h6Size)' => __( 'Heading 6' ),	
    ]);
  }

  /**
   * Return array for Text size selection
   */
  private function get_text_size_choices() {
    return blocksy_ordered_keys([
      'var(--fontSize)' => __( 'Normal' ),
      'var(--smallFontSize)' => __( 'Small' ),
      'var(--mediumFontSize)' => __( 'Medium' ),
      'var(--largeFontSize)' => __( 'Large' ),
      'var(--hugeFontSize)' => __( 'Huge' ),
      'inherit' => __( 'Inherit' ),
    ]);
  }


  /**
   * Get either "inline" or "block" depending on the type
   */
  private function get_default_design( $type ) {
    switch( $type ) {
      case 'ct-color-picker':
      case 'ct-background':
      case 'ct-select':
      case 'ct-border':
      case 'ct-number':
      case 'ct-text':
        return 'inline';

      case 'ct-color-palettes-picker':
      case 'ct-radio':
      case 'ct-visibility':
      case 'text':
      case 'ct-checkboxes':
        return 'block';

      default:
        return '';
    }
  }

  /**
   * Add a notice containing the CSS selector
   */
  private function add_css_selector_notice( $selector, $options ) {
    return array_merge( [
      blocksy_rand_md5() => [
        'type' => 'ct-title',
        'variation' => 'notice',
        'desc' => "<div class='notice'> <p>CSS selector: <code>$selector</code></p> </div>",
      ],
    ] , $options );
  }


}