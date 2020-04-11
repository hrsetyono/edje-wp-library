<?php

add_action( 'plugins_loaded' , function() {
  require_once __DIR__ . '/block-styles.php';

  if( is_admin() ) { 
    add_action( 'enqueue_block_editor_assets', '_h_enqueue_editor', 20 );
    add_action( 'admin_init', '_h_enqueue_classic_editor' );
  }
} );

/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_editor() {
  $assets = plugin_dir_url(__FILE__) . 'assets';
  wp_enqueue_style( 'h-editor', $assets . '/h-editor.css', [], H_VERSION );
  wp_enqueue_script( 'h-editor', $assets . '/h-editor.js', [], H_VERSION, true );
}

/**
 * Add custom CSS to Classic Editor
 * 
 * @action admin_init
 */
function _h_enqueue_classic_editor() {
  $assets = plugin_dir_url(__FILE__) . 'assets';
  add_editor_style( $assets . '/h-classic-editor.css' );
}


/////

/**
 * Register ACF Block for Post Listing
 * - You need to create a TWIG file in views/blocks named `h-$pt-list.twig`. Replace $pt with post type
 * - In the template, you can use `posts` object to loop through.
 * 
 * @deprecated - too complicated to use, let them create their own ACF Block
 */
function h_register_post_type_block( string $post_type, array $args = [] ) {
  if( !function_exists('acf_register_block') ) { return; }
  
  require_once __DIR__ . '/block-acf-post-list.php';

  $block = new \h\Block_Post_List( $post_type, $args );
  $block->register();
}


/**
 * Format array for Gutenberg's palette theme_suport. Also output CSS classes at HEAD.
 * 
 * @return array - Formatted colors array suitable for theme_support.
 */
function h_color_palette( array $raw_colors ) {
  // parse raw colors
  $colors = [];
  foreach( $raw_colors as $name => $value ) {
    $slug = _H::to_slug( $name, '-' );
    
    // if color name is 'text' (which will clash with gutenberg class)
    if( $slug == 'text' ) {
      $slug = 'text-base';
    }
    
    $colors[ $name ] = [
      'color' => $value,
      'slug' => $slug
    ];
  }

  // format styles
  $styles = '';
  foreach( $colors as $name => $value ) {
    $slug = $value['slug'];
    $color = $value['color'];

    // if value is a CSS var
    if( strpos( $color, 'var' ) > -1 ) {
      $styles .= ".has-{$slug}-background-color { --bgColor: {$color}; --bgColorRGB: {$color}RGB }";
      $styles .= ".has-{$slug}-color { --textColor: {$color}; --textColorRGB: {$color}RGB }";
    }
    // else, it's a normal CSS
    else {
      $styles .= ".has-{$slug}-background-color { background-color: {$color}; }";
      $styles .= ".has-{$slug}-color { color: {$color}; }";
    }
  }

  // output the style in head
  add_action( 'wp_head', function() use ( $styles ) {
    echo "<style> $styles </style>";
  } );

  // format the array
  $parsed_colors = [];
  foreach( $colors as $name => $value ) {

    $parsed_colors[] = [
      'name' => $name,
      'slug' => $value['slug'],
      'color' => $value['color']
    ];
  }

  return $parsed_colors;
}