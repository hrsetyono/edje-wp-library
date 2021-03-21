<?php
/**
 * Module to transform PULLQUOTE block into FAQ 
 */

add_action( 'init' , function() {
  // if Gutenberg is not active
  if ( !function_exists( 'register_block_type' ) ) { return; }

  if( current_theme_supports( 'h-faq-block' ) ) {
    require_once __DIR__ . '/custom-faq.php';
  } else {
    require_once __DIR__ . '/pullquote-faq.php';
  }
} );