<?php
/*
  Add new settings to Customizer
*/

new H_Customizer();

class H_Customizer {
  private $option;

  function __construct() {
    $this->option = get_option('h');

    add_action('customize_register', array($this, 'head_footer_code') );
    $this->add_code();
  }

  /*
    Create the setting that adds extra code to Head and Footer

    @action customize_register
    @param obj $wp_customize
  */
  function head_footer_code($wp_customize) {
    $wp_customize->add_section('h_head_footer', array(
      'title' => __('Head and Footer Code', 'h'),
      'description' => __('Add custom code for Head and Footer area', 'h'),
      'priority' => 160,
      'capability' => 'edit_theme_options',
    ) );

    $wp_customize->add_setting('h[head_code]', array(
      'type' => 'option',
    ));

    $wp_customize->add_setting('h[footer_code]', array(
      'type' => 'option',
    ));

    $wp_customize->add_control('h[head_code]', array(
      'label' => __('HEAD code', 'h'),
      'type' => 'textarea',
      'input_attrs' => array(
        'class' => 'code',
      ),
      'section' => 'h_head_footer',
    ) );

    $wp_customize->add_control('h[footer_code]', array(
      'label' => __('FOOTER code', 'h'),
      'type' => 'textarea',
      'input_attrs' => array(
        'class' => 'code',
      ),
      'section' => 'h_head_footer',
    ) );
  }

  /*
    Add extra code to HEAD and FOOTER
  */
  private function add_code() {
    if(isset($this->option['head_code']) ) {
      add_action('wp_head', array($this, 'add_head_code'), 100);
    }

    if(isset($this->option['footer_code']) ) {
      add_action('wp_footer', array($this, 'add_footer_code'), 100);
    }
  }

  function add_head_code() { echo $this->option['head_code']; }
  function add_footer_code() { echo $this->option['footer_code']; }
}
