<?php namespace h;
/**
 * Add default customizer option
 */
class Customizer_Default {
  private $option;

  function __construct() {
    $this->option = get_option( 'h' );

    add_action( 'customize_register', [$this, 'head_footer_code'] );

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

    $c->add_settings_to_h_head_footer( [
      'h[head_code]' => [
        'type' => 'code_editor',
        'setting_type' => 'option',
        'code_language' => 'htmlmixed',
        'label' => __( 'HEAD code' ),
      ],
      'h[footer_code]' => [
        'type' => 'code_editor',
        'setting_type' => 'option',
        'code_language' => 'htmlmixed',
        'label' => __( 'FOOTER code' ),
      ],
    ] );
  }

  ////

  /**
   * Add custom code to wp_head() section.
   * @action wp_head 100
   */
  function add_head_code() {
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
