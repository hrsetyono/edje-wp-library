<?php namespace h;
/**
 * Modify wp_head() and wp_footer() for frontend pages.
 */
class Modify_Head_Footer {
  function __construct() {
    // remove wp meta tag
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );

    // remove emoji
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // remove default js or css 
    add_action( 'wp_enqueue_scripts', [$this, 'enqueue_assets'] );

    add_action( 'customize_register', [$this, 'customize_register'] );
    add_action( 'wp_head', [$this, 'add_custom_head_code'], 100 );
    add_action( 'wp_footer', [$this, 'add_custom_footer_code'], 100 );
  }


  /**
   * Change some default CSS or JS
   * @action wp_enqueue_scripts
   */
  function enqueue_assets() {
    if ( !is_admin() ) {
      wp_deregister_script( 'jquery-ui-core' );
    }
  }


  /**
   * Create Customizer field to add extra code in Header/Footer
   * 
   * @param $wpc - WP_Customize object
   * 
   * @action customize_register
   */
  function customize_register( $wpc ) {
    $setting_args = [
      'type' => 'option',
      'transport' => 'postMessage',
      'default' => '',
    ];

    $editor_settings = [
      'codemirror' => [ 'mode' => 'htmlmixed' ],
    ];

    // Add section
    $wpc->add_section( 'h_code_section', [
      'title' => __( 'Head & Footer Code' ),
      'description' => __( 'Add custom code for Head and Footer area' ),
    ] );

    // Add options
    $wpc->add_setting( 'h[head_code]', $setting_args );
    $wpc->add_setting( 'h[footer_code]', $setting_args );

    // Add control
    $wpc->add_control( new \WP_Customize_Code_Editor_Control( $wpc, 'h[head_code]', [
      'label' => __( 'HEAD code' ),
      'editor_settings' => $editor_settings,
      'section' => 'h_code_section',
      'settings' => 'h[head_code]',
    ] ) );

    $wpc->add_control( new \WP_Customize_Code_Editor_Control( $wpc, 'h[footer_code]', [
      'label' => __( 'FOOTER code' ),
      'editor_settings' => $editor_settings,
      'section' => 'h_code_section',
      'settings' => 'h[footer_code]',
    ] ) );
  }

  /**
   * Add custom code to wp_head() section.
   * 
   * @action wp_head 100
   */
  function add_custom_head_code() {
    echo get_option( 'h' )['head_code'] ?? '';
  }

  /*
    Add custom code to wp_footer() section.

    @action wp_footer 100
  */
  function add_custom_footer_code() {
    echo get_option( 'h' )['footer_code'] ?? '';
  }
}

new Modify_Head_Footer();