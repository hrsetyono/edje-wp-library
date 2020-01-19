<?php
/**
 * Get the list of options for theme mods
 */
function _custy_get_footer_sections() {
  global $custy_footer_sections; // cache

  if( empty( $custy_footer_sections ) ) {
    $custy_footer_sections = apply_filters( 'custy_footer_sections', [] );
  }

  return $custy_footer_sections;
}


/**
 * 
 */
add_filter( 'custy_footer_sections', function( $items ) {
  return wp_parse_args( [

    

  ], $items );
}, 10 );