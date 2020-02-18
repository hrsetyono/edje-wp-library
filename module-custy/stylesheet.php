<?php

add_action( 'wp_head', '_custy_render_stylesheet', 0 );
add_action( 'admin_print_styles', '_custy_render_admin_stylesheet', 0 );


/**
 * Render the CSS variables for Frontend
 * 
 * @filter wp_head 0
 */
function _custy_render_stylesheet() {
  $sections = Custy::get_sections();
  $header_items = CustyBuilder::get_items( 'header', 'all', true, false );
  $footer_items = CustyBuilder::get_items( 'footer', 'all', true, false );

  $compiler = new Custy_CompileStyles();
  $compiler->compile_from_sections( $sections );
  $compiler->compile_from_items( $header_items, 'header' );
  $compiler->compile_from_items( $footer_items, 'footer' );
  $styles = $compiler->get_styles();

  _custy_format_then_echo_css( $styles );
}


/**
 * Render the CSS variables for Admin page
 * 
 * @action admin_print_styles 0
 */
function _custy_render_admin_stylesheet() {
  $current_screen = get_current_screen()->id;
  $only_show_in = ['customize', 'post', 'page'];

  if( !in_array( $current_screen, $only_show_in ) ) { return; }
  
  $color_palette = Custy::get_mod( 'colorPalette' );
  $text_color = Custy::get_mod( 'textColor' );
  $extra_color = Custy::get_mod( 'extraColor' );

  $palette_css = [
    '--main'      => $color_palette['color1']['color'],
    '--mainDark'  => $color_palette['color2']['color'],
    '--mainLight' => $color_palette['color3']['color'],
    '--sub'       => $color_palette['color4']['color'],
    '--subLight'  => $color_palette['color5']['color'],
    '--text'       => $text_color['default']['color'],
    '--textInvert' => $text_color['invert']['color'],
  ];

  foreach( $extra_color as $id => $value ) {
    if( $value['color'] !== 'CT_CSS_SKIP_RULE' ) {
      $palette_css[ "--{$id}" ] = $value['color'];
    }
  }

  $styles = [
    ':root' => $palette_css
  ];

  _custy_format_then_echo_css( $styles );
}


/**
 * Format the CSS then echo it
 */
function _custy_format_then_echo_css( $styles ) {
  $cv = new Custy_Values();
  $styles = $cv->format_for_css( $styles );

  $outputter = new Custy_OutputStyles();
  $outputter->echo_css( $styles );
}