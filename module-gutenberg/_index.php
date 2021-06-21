<?php

add_action( 'plugins_loaded' , function() {
  require_once __DIR__ . '/block-styles.php';

  if( is_admin() ) { 
    add_action( 'enqueue_block_editor_assets', '_h_enqueue_editor', 20 );
    add_action( 'admin_init', '_h_enqueue_classic_editor' );
  }
} );

if( is_admin() ) {
  add_filter( 'safe_style_css', '_h_gutenberg_safe_style' );
}


/**
 * @action wp_enqueue_scripts
 */
function _h_enqueue_editor() {
  $disallowed_blocks = apply_filters( 'h_disallowed_blocks', [
    'core/nextpage',
    'core/more',
  ] );

  $assets = plugin_dir_url(__FILE__);
  wp_enqueue_style( 'h-editor', $assets . 'css/h-editor.css', [], H_VERSION );
  wp_enqueue_script( 'h-editor', $assets . 'js/h-editor.js', [], H_VERSION, true );

  wp_localize_script( 'h-editor', 'localizeH', [ 'disallowedBlocks' => $disallowed_blocks ] );
}

/**
 * Add custom CSS to Classic Editor
 * 
 * @action admin_init
 */
function _h_enqueue_classic_editor() {
  $assets = plugin_dir_url(__FILE__) . 'css';
  add_editor_style( $assets . '/h-classic-editor.css' );
}

/**
 * Allow this CSS Var to be saved in database
 * 
 * @filter safe_style_css
 */
function _h_gutenberg_safe_style( $attr ) {
  $attr[] = '--textColor';
  $attr[] = '--bgColor';
  $attr[] = '--iconColor';
  $attr[] = '--faqTitleBg';
  $attr[] = '--faqTitleColor';
  return $attr;
}


/**
 * Create classes for Gutenberg colors
 * @action wp_head
 * 
 * @deprecated 5.2.0 - Generate this in theme instead
 */
function _h_output_editor_palette() {
  // abort if in Admin but not inside Gutenberg editor
  if( is_admin() ) {
    global $current_screen;
    $in_editor = method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor();
    if( !$in_editor ) { return; }
  }

  $palette = get_theme_support( 'editor-color-palette' );
  
  // abort if no palette
  if( !$palette ) { return; }
  
  // format styles
  $styles = '';
  foreach( $palette[0] as $name => $value ) {
    $slug = $value['slug'];
    $color = $value['color'];

    // if value is a CSS var
    if( strpos( $color, 'var' ) > -1 ) {
      // create the RGB name
      preg_match( '/\((.+)\)/', $color, $matches );
      $color_rgb = 'var(' . $matches[1] . 'RGB)';

      $styles .= ".has-{$slug}-background-color { --bgColor: {$color}; --bgColorRGB: {$color_rgb} }";
      $styles .= ".has-{$slug}-color { --textColor: {$color}; --textColorRGB: {$color_rgb} }";
    }
    // else, it's a normal CSS
    else {
      $styles .= ".has-{$slug}-background-color { background-color: {$color}; }";
      $styles .= ".has-{$slug}-color { color: {$color}; }";
    }
  }

  echo "<style> $styles </style>";
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
 * @deprecated - No need to use function for this 
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