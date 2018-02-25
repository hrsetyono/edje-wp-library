<?php
/*
  Wrapper for WP Customizer

  https://github.com/hrsetyono/wp-edje/wiki/Customizer
*/
class H_Customizer {
  private $wp; // $wp_customize object
  private $section;

  function __construct( $wp ) {
    $this->wp = $wp;
  }

  /*
    Create section in Customizer.

    @param string $name - Name of the section.
    @param array $args - (optional) Arguments as specified in https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
  */
  public function add_section( $name, $args = array() ) {
    // create args and replace default with passed one, if any.
    $default_args = array(
      'title' => _H::to_title( $name ),
    );
    $args = array_merge( $default_args, $args );

    $this->wp->add_section( $name, $args );

    // cache the section name
    $this->section = $name;
  }

  /*
    Cache the section name, so all the following add_option is inside this section.

    @param string $name - Name of the section.
  */
  public function set_section( $name ) {
    $this->section = $name;
  }

  /*
    Add setting to site, value is kept when changing theme
  */
  public function add_option( $name, $control_type, $args = array() ) {
    if( !$this->section ) { return false; } // abort if section not set

    $this->wp->add_setting( $name, array(
      'type' => 'option',
    ) );

    $this->add_control( $name, $control_type, $args );
  }

  /*
    Add setting to theme, value is not kept when changing theme
  */
  public function add_theme_mod( $name, $control_type, $args = array() ) {
    if( !$this->section ) { return false; } // abort if section not set

    $this->wp->add_setting( $name, array(
      'type' => 'theme_mod',
    ) );

    $this->add_control( $name, $control_type, $args );
  }


  /////


  /*
    Add control to the customizer

    @param string $name - Name of the setting
    @param string $control_type - Keyword for type of control
    @param array $args - (optional) Arguments as specified in https://codex.wordpress.org/Class_Reference%5CWP_Customize_Manager%5Cadd_control
  */
  private function add_control( $name, $control_type, $args ) {
    // create args and replace default with passed one, if any.
    $default_args = array(
      'label' => _H::to_title( $name ),
      'section' => $this->section,
      'settings' => $name,
    );
    $args = array_merge( $default_args, $args );

    // parse control type
    $types = explode( ' ', $control_type );

    // get control based on type
    $control = false;
    switch( $types[0] ) {
      case 'code_editor':
        $args['editor_settings'] = array(
          'codemirror' => array(
            'mode' => isset( $types[1] ) ? $types[1] : 'default'
          ),
        );

        $control = new WP_Customize_Code_Editor_Control( $this->wp, $name, $args );
        break;

      case 'image':
        $control = new WP_Customize_Image_Control( $this->wp, $name, $args );
        break;

      case 'color':
        $control = new WP_Customize_Color_Control( $this->wp, $name, $args );
        break;

      case 'upload':
        $control = new WP_Customize_Upload_Control( $this->wp, $name, $args );
        break;

      case 'background_image':
        $control = new WP_Customize_Background_Image_Control( $this->wp, $name, $args );
        break;

      case 'header_image':
        $control = new WP_Customize_Header_Image_Control( $this->wp, $name, $args );
        break;

      //  text, checkbox, radio, select, textarea, dropdown-pages, email, url, number, hidden, date.
      default:
        $args['type'] = $types[0];
        $this->wp->add_control( $name, $args );
        return true; // to skip the other add_control
    }

    $this->wp->add_control( $control );
  }
}
