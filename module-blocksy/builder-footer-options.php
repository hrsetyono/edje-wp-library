<?php
/**
 * Get the list of options for theme mods
 */
function _h_get_footer_sections() {
  global $h_footer_sections; // cache

  if( empty( $h_footer_sections ) ) {
    $h_footer_sections = apply_filters( 'h_footer_sections', [] );
  }

  return $h_footer_sections;
}


/**
 * 
 */
add_filter( 'h_footer_sections', function( $items ) {
  return wp_parse_args( [

    

  ], $items );
}, 10 );