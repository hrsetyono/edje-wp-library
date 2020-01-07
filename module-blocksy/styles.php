<?php

add_action( 'wp_head', '_h_render_mods', 0 );
add_action( 'admin_print_styles', '_h_render_admin_mods', 0 );


/**
 * Output theme mods for Frontend
 * 
 * @action wp_head
 */
function _h_render_mods() {
  $mods = wp_parse_args( get_theme_mods(), _h_get_default_mods() );
  $styles = apply_filters( 'h_customizer_css', [], $mods );

  $cfs = new H_Customizer_FormatStyles( $styles );
  $cfs->render();
}


/**
 * Output theme mods for Customizer page
 * 
 * @action admin_print_styles
 */
function _h_render_admin_mods() {
  // Only in customizer
  $current_screen = get_current_screen()->id;
  if( !in_array( $current_screen, ['customize'] ) ) {
    return;
  }

  $mods = wp_parse_args( get_theme_mods(), _h_get_default_mods() );
  $styles = apply_filters( 'h_customizer_css_admin', [
    ':root' => [
      '--main'      => $mods['colorPalette']['color1']['color'],
      '--mainDark'  => $mods['colorPalette']['color2']['color'],
      '--mainLight' => $mods['colorPalette']['color3']['color'],
      '--sub'       => $mods['colorPalette']['color4']['color'],
      '--subLight'  => $mods['colorPalette']['color5']['color'],
      '--text'      => $mods['textColor']['default']['color'],
      '--textInvert' => $mods['textColor']['invert']['color'],
    ],
  ], $mods );

  $cfs = new H_Customizer_FormatStyles( $styles );
  $cfs->render();
}