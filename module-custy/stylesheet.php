<?php

/**
 * Render the CSS variables for Frontend
 * 
 * @filter wp_head 0
 */
function _custy_render_stylesheet() {
  $sections = Custy::get_sections();
  $header_items = Custy::get_builder_items( 'header', 'all', true, false );
  $footer_items = Custy::get_builder_items( 'footer', 'all', true, false );

  $compiler = new Custy_CompileStyles();
  $compiler->compile_from_sections( $sections );
  $compiler->compile_from_items( $header_items, 'header' );
  $compiler->compile_from_items( $footer_items, 'footer' );
  $styles = $compiler->get_styles();

  _custy_format_then_echo_css( $styles );
}


/**
 * Render the CSS variables for Customizer page
 * 
 * @action admin_print_styles 0
 */
function _custy_render_admin_stylesheet() {
  $current_screen = get_current_screen()->id;
  if( !in_array( $current_screen, ['customize'] ) ) {
    return;
  }

  $mods = Custy::get_mods();
  $styles = [
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

  _custy_format_then_echo_css( $styles );
}


/**
 * Format the CSS then echo it
 */
function _custy_format_then_echo_css( $styles ) {
  $formatter = new Custy_FormatValues();
  $styles = $formatter->format_for_css( $styles );

  $outputter = new Custy_OutputStyles();
  $outputter->echo_css( $styles );
}