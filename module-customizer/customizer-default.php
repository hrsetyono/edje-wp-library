<?php namespace h;
/*
  Add default customizer option
*/
class Customizer_Default {
  private $option;

  function __construct() {
    $this->option = get_option( 'h' );

    add_action( 'customize_register', array($this, 'head_footer_code') );
    add_action( 'customize_register', array($this, 'site_identity') );

    $this->add_code();
  }

  /*
    Create the setting that adds extra code to Head and Footer
    @action customize_register

    @param obj $wp_customize
  */
  function head_footer_code( $wp_customize ) {
    $c = \H::customizer( $wp_customize );

    $c->add_section( 'h_head_footer', array(
      'title' => __( 'Head & Footer Code', 'h' ),
      'description' => __( 'Add custom code for Head and Footer area', 'h' ),
    ) );

    $c->add_option( 'h[head_code]', 'code_editor htmlmixed', array(
      'label' => __( 'HEAD code', 'h' ),
    ) );

    $c->add_option( 'h[footer_code]', 'code_editor htmlmixed', array(
      'label' => __( 'FOOTER code', 'h' ),
    ) );
  }


  /*
    Add Theme Color and Mobile Logo
  */
  function site_identity( $wp_customize ) {
    $c = \H::customizer( $wp_customize );

    $c->set_section( 'title_tagline' );

    if( current_theme_supports('h-logo-mobile') ) {
      $c->add_option( 'logo_mobile', 'image', array(
        'priority' => 9,
      ) );
    }

    $c->add_theme_mod( 'background_color', 'color', array(
      'label' => 'Theme Color',
      'description' => 'Used for taskbar color in Mobile browser'
    ) );
  }

  /////

  /*
    Add extra code to HEAD and FOOTER
  */
  private function add_code() {
    if( isset( $this->option['head_code'] ) ) {
      add_action( 'wp_head', array($this, 'add_head_code'), 100 );
    }

    if( isset( $this->option['footer_code'] ) ) {
      add_action( 'wp_footer', array($this, 'add_footer_code'), 100 );
    }
  }

  function add_head_code() { echo $this->option['head_code']; }
  function add_footer_code() { echo $this->option['footer_code']; }
}
