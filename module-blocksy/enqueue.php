<?php

add_action( 'wp_enqueue_scripts', '_h_enqueue_blocksy' );
add_action(	'enqueue_block_editor_assets', '_h_enqueue_blocksy_gutenberg' );

add_action( 'customize_preview_init', '_h_enqueue_customizer_preview' );
add_action( 'customize_controls_enqueue_scripts', '_h_enqueue_customizer_control' );

add_action(	'admin_enqueue_scripts', '_h_enqueue_blocksy_admin' );


/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_blocksy() {
  $css_dir = plugin_dir_url(__FILE__) . 'css';
  $js_dir = plugin_dir_url(__FILE__) . 'js';

	// $m = new Blocksy_Fonts_Manager();
	// $m->load_fonts();

  wp_register_script( 'ct-events', $js_dir . '/events.js', [], H_VERSION,	true );
}


/**
 * @action enqueue_block_editor_assets
 */
function _h_enqueue_blocksy_gutenberg() {
  $css_dir = plugin_dir_url(__FILE__) . 'css';
  $js_dir = plugin_dir_url(__FILE__) . 'js';

  wp_enqueue_style( 'ct-main-editor-styles', $css_dir . '/editor.css', [], '' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 * 
 * @action customize_preview_init
 */
function _h_enqueue_customizer_preview() {
  $css_dir = plugin_dir_url(__FILE__) . 'css';
  $js_dir = plugin_dir_url(__FILE__) . 'js';
  $builder = new Blocksy_Customizer_Builder();

  wp_enqueue_script( 'ct-customizer', $js_dir . '/sync.js',
    ['customize-preview', 'wp-date', 'ct-events'], H_VERSION, true
  );


  wp_localize_script( 'ct-customizer', 'ct_customizer_localizations', [
    'static_public_url' => BLOCKSY_URL . '/',
    'header_builder_data' => $builder->get_data_for_customizer(),
  ] );

  wp_localize_script( 'ct-customizer', 'ct_localizations', [
    'customizer_sync' => blocksy_customizer_sync_data(),
  ] );

  wp_enqueue_media();
}


/**
 * Customizer control assets
 * 
 * @action customize_controls_enqueue_scripts
 */
function _h_enqueue_customizer_control() {
  $css_dir = plugin_dir_url(__FILE__) . 'css';
  $js_dir = plugin_dir_url(__FILE__) . 'js';

  wp_enqueue_style( 'h-blocksy', $css_dir . '/h-blocksy.css', [], H_VERSION );

  wp_enqueue_style( 'ct-customizer-controls-styles',
    $css_dir . '/customizer-controls.css', [], H_VERSION
  );

  wp_register_script( 'ct-events',
    $js_dir . '/events.js', [], H_VERSION, true
  );

  $deps = apply_filters('blocksy-options-scripts-dependencies', [
    'underscore',
    'wp-color-picker',
    'react',
    'react-dom',
    'wp-element',
    'wp-components',
    'wp-date',
    'wp-i18n',
    'customize-controls',
    'ct-events'
  ]);

  wp_enqueue_script( 'ct-customizer-controls',
    $js_dir . '/customizer-controls.js', $deps, H_VERSION, true
  );

  $builder = new Blocksy_Customizer_Builder();

  wp_localize_script( 'ct-customizer-controls', 'ct_customizer_localizations', [
    'customizer_reset_none' => wp_create_nonce( 'ct-customizer-reset' ),
    'static_public_url' => BLOCKSY_URL . '/',
    'header_builder_data' => $builder->get_data_for_customizer(),
    'all_mods' => get_theme_mods()
  ] );

}



/**
 * Enqueue assets for Admin area
 * 
 * @action admin_enqueue_scripts
 */
function _h_enqueue_blocksy_admin() {
  $css_dir = plugin_dir_url(__FILE__) . 'css';
  $js_dir = plugin_dir_url(__FILE__) . 'js';

  wp_enqueue_media();

  wp_register_script( 'ct-events', $js_dir . '/events.js', [], H_VERSION, true );

  $deps = apply_filters('blocksy-options-scripts-dependencies', [
    'underscore',
    'wp-color-picker',
    'react',
    'react-dom',
    'wp-element',
    'wp-components',
    'wp-date',
    'wp-i18n',
    'ct-events'
    // 'wp-polyfill'
  ]);

  global $wp_customize;

  if ( ! isset( $wp_customize ) ) {
    wp_enqueue_script(
      'ct-options-scripts', $js_dir . '/options.js', $deps, H_VERSION, true
    );
  }

  $locale_data_ct = blocksy_get_jed_locale_data( 'blocksy' );

  wp_add_inline_script( 'wp-i18n',
    'wp.i18n.setLocaleData( ' . wp_json_encode( $locale_data_ct ) . ', "blocksy" );'
  );

  wp_enqueue_style( 'ct-options-styles',
    $css_dir . '/options.css', ['wp-color-picker'], H_VERSION
  );

  wp_localize_script( 'ct-options-scripts', 'ct_localizations', [
    'is_dev_mode' => !!(defined('BLOCKSY_DEVELOPMENT_MODE') && BLOCKSY_DEVELOPMENT_MODE),
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce( 'ct-ajax-nonce' ),
    'public_url' => BLOCKSY_URL . '/',
    'static_public_url' => BLOCKSY_URL . '/',
    'rest_url' => get_rest_url(),
    'customizer_url' => admin_url('/customize.php?autofocus'),
  ] );
}