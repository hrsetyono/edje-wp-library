<?php

/**
 * Render the CSS variables for Frontend
 * 
 * @filter wp_head 0
 */
function _custy_render_stylesheet() {
  $theme_mods = Custy::get_mods();
  $sections = Custy::get_sections();

  $compiler = new Custy_CompileStyles( $theme_mods );
  $styles = $compiler->compile( $sections );

  $formatter = new Custy_FormatValues();
  $styles = $formatter->format_for_css( $styles );

  $outputter = new Custy_OutputStyles();
  $outputter->echo_css( $styles );
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

  $mods = wp_parse_args( get_theme_mods(), Custy::get_default_values() );
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

  $formatter = new Custy_FormatValues();
  $styles = $formatter->format_for_css( $styles );

  $outputter = new Custy_OutputStyles();
  $outputter->echo_css( $styles );
}
