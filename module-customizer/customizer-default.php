<?php namespace h;
/**
 * Add default customizer option
 */
class Customizer_Default {
  private $option;

  function __construct() {
    $this->option = get_option( 'h' );

    add_action( 'customize_register', [$this, 'head_footer_code'] );
    add_action( 'customize_register', [$this, 'site_identity'] );

    // add the custom code to Head or Footer
    add_action( 'wp_head', [$this, 'add_head_code'], 100 );
    add_action( 'wp_footer', [$this, 'add_footer_code'], 100 );
  }


  /**
   * Create the setting that adds extra code to Head and Footer
   * 
   * @action customize_register
   */
  function head_footer_code( $wp_customize ) {
    $c = h_customizer( $wp_customize );

    $c->add_section( 'h_head_footer', [
      'title' => __( 'Head & Footer Code' ),
      'description' => __( 'Add custom code for Head and Footer area' ),
     ] );

    $c->add_option( 'h[head_code]', 'code_editor htmlmixed', [
      'label' => __( 'HEAD code' ),
     ] );

    $c->add_option( 'h[footer_code]', 'code_editor htmlmixed', [
      'label' => __( 'FOOTER code' ),
    ] );
  }


  /**
   * Add Theme Color and Mobile Logo
   */
  function site_identity( $wp_customize ) {
    $c = h_customizer( $wp_customize );

    $c->set_section( 'title_tagline' );

    if( current_theme_supports('h-logo-mobile') ) {
      $c->add_option( 'logo_mobile', 'image', [
        'priority' => 9,
      ] );
    }

    $c->add_theme_mod( 'background_color', 'color', [
      'label' => __('Theme Color'),
      'description' => __('Used for taskbar color in Mobile browser')
    ] );
  }

  ////

  /**
   * Add custom code to wp_head() section.
   * @action wp_head 100
   */
  function add_head_code() {
    // Add Theme color tag
    $color = get_background_color();
    if( $color ) {
      echo "<meta name='theme-color' content='#$color'>";
    }

    // Add custom HEAD code
    if( isset( $this->option['head_code'] ) ) {
      echo $this->option['head_code'];
    }
  }

  /*
    Add custom code to wp_footer() section.
    @action wp_footer 100
  */
  function add_footer_code() {
    if( isset( $this->option['footer_code'] ) ) {
      echo $this->option['footer_code'];
    }
  }

}
