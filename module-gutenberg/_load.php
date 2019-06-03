<?php

/**
 * @action plugins_loaded
 */
function _h_load_gutenberg() {
  require_once __DIR__ . '/mod.php';

  new \h\Modify_Gutenberg();
}

/**
 * Register ACF Block, only usable in action "acf/init"
 * - After that, you need to set a Field Group to be displayed when Block is equal to this.
 */
function h_register_block( $slug, $args ) {
  if( !function_exists('acf_register_block') ) { return; }

  require_once __DIR__ . '/acf-blocks.php';

  $block = new \h\ACF_Block( $slug, $args );
  $block->register();
}

/**
 * Register ACF Block for Post Listing
 * - You need to create a TWIG file in views/blocks named `h-$pt-list.twig`. Replace $pt with post type
 * - In the template, you can use `posts` object to loop through.
 */
function h_register_post_block( string $post_type, array $args = [] ) {
  if( !function_exists('acf_register_block') ) { return; }
  
  require_once __DIR__ . '/block-acf-post-list.php';

  $block = new \h\Block_Post_List( $post_type, $args );
  $block->register();
}


/**
 * Output CSS classes for Gutenberg palette
 * 
 * @return array - Formatted colors array suitable for theme_support.
 */
function h_register_colors( array $colors ) : array {
  // output the style in head
  add_action( 'wp_head', function() use ( $colors ) {
    $styles = '<style>';
    foreach( $colors as $c ) {
      $styles .= ".has-$c-background-color { --bgColor: var(--$c); }";
      $styles .= ".has-$c-color { --textColor: var(--$c); }";
    }
    $styles .= '</style>';
    
    echo $styles;
  } );

  // format the array
  $parsed_colors = [];
  foreach( $colors as $label => $slug ) {
    $parsed_colors[] = [
      'name' => $label,
      'slug' => $slug,
      'color' => "var(--$slug)"
    ];
  }

  return $parsed_colors;
}