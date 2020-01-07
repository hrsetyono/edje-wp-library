<?php namespace h;
/**
 * Helper class for editing WP Customizer
 */
class Customizer {
  private $wp; // $wp_customize object
  private $section;

  function __construct( $wp_customize ) {
    $this->wp = $wp_customize;
  }


  /**
   * Create section in Customizer.
   * 
   * @param string $name - Name of the section.
   * @param array $args - (optional) Extra configuration: https://github.com/hrsetyono/wp-edje/wiki/Customizer#extra-configuration---section
   */
  public function add_section( $name, $args = [] ) {
    // create args and replace default with passed one, if any.
    $default_args = [
      'title' => \_H::to_title( $name ),
    ];
    $args = array_merge( $default_args, $args );

    $this->wp->add_section( $name, $args );
  }


  /**
   * Check for function "add_settings_to_x"
   */
  public function __call( $name, $args ) {
    preg_match( '/add_settings_to_(.+)/', $name, $is_add_to_settings );

    if( $is_add_to_settings ) {
      $section = $is_add_to_settings[1];
      $this->_add_settings( $section, $args[0] );
    }
  }

  //////

  /**
   * 
   */
  private function _add_settings( $section, $settings ) {
    foreach( $settings as $name => $s ) {
      // parse setting args
      $setting_args = [
        'type' => $s['setting_type'] ?? 'theme_mod', // override to "option" so the setting is bound to site
        'transport' => ($s['type'] == 'visual_editor') ? 'postMessage' : 'refresh', // disable auto refresh because it's annoying

        'default' => $s['default'] ?? ''
      ];

      // parse control args
      $default_control_args = [
        'label' => \_H::to_title( $name ),
        'type' => 'text',
        'section' => $section,
        'settings' => $name,
      ];
      $control_args = array_merge( $default_control_args, $s );
      

      // add the setting
      $this->wp->add_setting( $name, $setting_args );
      $this->_add_control( $name, $control_args );


      // add pencil icon next to the element that has the same ID as the setting
      $this->wp->selective_refresh->add_partial( $name, array(
        'selector' => '#' . \_H::to_param( $name ),
        'render_callback' => '__return_false',
      ) );
    }
  }


  /**
   * Add control to the customizer
   * 
   * @param string $name - Name of the setting
   * @param array $args - (optional) Extra configuration: https://github.com/hrsetyono/wp-edje/wiki/Customizer#extra-configuration---setting
   */
  private function _add_control( $name, $args ) {
    $control = false;

    // Check if the input type is complex
    switch( $args['type'] ) {
      case 'code_editor':
        $args['editor_settings'] = array(
          'codemirror' => array(
            'mode' => $args['code_language'] ?? 'default'
          ),
        );
        $control = new \WP_Customize_Code_Editor_Control( $this->wp, $name, $args );
        break;

      case 'image':
        $control = new \WP_Customize_Image_Control( $this->wp, $name, $args );
        break;

      case 'cropped_image':
        $control = new \WP_Customize_Cropped_Image_Control( $this->wp, $name, $args );
        break;

      case 'color':
        $control = new \WP_Customize_Color_Control( $this->wp, $name, $args );
        break;

      case 'upload':
        $control = new \WP_Customize_Upload_Control( $this->wp, $name, $args );
        break;

      case 'background_image':
        $control = new \WP_Customize_Background_Image_Control( $this->wp, $name, $args );
        break;

      case 'header_image':
        $control = new \WP_Customize_Header_Image_Control( $this->wp, $name, $args );
        break;

      // custom
      case 'visual_editor':
        require_once __DIR__ . '/customizer-tinymce.php';
        $control = new Customize_TinyMCE_Control( $this->wp, $name, $args );
        break;

      default:
        break;
    }

    // if has complex control
    if( $control ) {
      $this->wp->add_control( $control );
    } else {
      $this->wp->add_control( $name, $args );
    }
    
  }



  /**
   * Cache the section name, so all the following add_option is inside this section.
   * @deprecated 3.7.0 - Replaced by add_settings_to_x()
   * 
   * @param string $name - Name of the section.
   */
  public function set_section( $name ) {
    $this->section = $name;
  }

  /**
   * Wrapper to add option setting and control
   * @deprecated 3.7.0 - Replaced by add_settings_to_x()
   * 
   * @param string $name
   * @param string $control_type - Keyword for input type: https://github.com/hrsetyono/wp-edje/wiki/Customizer#control-types
   * @param array $args - Arguments for control
   */
  public function add_option( $name, $control_type, $args = array() ) {
    if( !$this->section ) { return false; } // abort if section not set

    $this->_add_setting( 'option', $name, $control_type );
    $this->_add_control( $name, $control_type, $args );
  }

  /**
   * Wrapper to add theme_mod setting and control
   * @deprecated 3.7.0 - Replaced by add_settings_to_x()
   * 
   * @param string $name
   * @param string $control_type - Keyword for input type: https://github.com/hrsetyono/wp-edje/wiki/Customizer#control-types
   * @param array $args - Arguments for control
   */
  public function add_theme_mod( $name, $control_type, $args = array() ) {
    if( !$this->section ) { return false; } // abort if section not set

    $this->_add_setting( 'theme_mod', $name, $control_type );
    $this->_add_control( $name, $control_type, $args );
  }


  /**
   * Add setting
   * 
   * @param string $setting_type - Either 'theme_mod' or 'option'
   * @param string $name
   * @param string $control_type - Keyword for input type: https://github.com/hrsetyono/wp-edje/wiki/Customizer#control-types
   */
  private function _add_setting( $setting_type, $name, $control_type ) {

    $transport = 'refresh'; // auto refresh by default
    switch( $control_type ) {
      // if visual editor, disable auto refresh because it's annoying
      case 'visual_editor':
        $transport = 'postMessage';
        break;
    }

    $args = array(
      'type' => $setting_type,
      'transport' => $transport,
    );

    $this->wp->add_setting( $name, $args );

    // add pencil button
    $this->wp->selective_refresh->add_partial( $name, array(
      'selector' => '#' . \_H::to_param( $name ),
      'render_callback' => '__return_false',
    ) );
  }
}
