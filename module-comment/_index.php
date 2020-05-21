<?php

add_action( 'after_setup_theme', function() {
  if( get_theme_support( 'h-comment' ) ) {
    new H_Comment();
  }
}, 9999 );


/**
 * Add toolbar to Comment Form and parse the markdown
 */
class H_Comment {
  function __construct() {
    add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );

    remove_filter( 'comment_text', 'make_clickable', 9 );
    remove_filter( 'comment_text', 'wptexturize', 10 );

    if( !is_admin() ) {
      remove_filter( 'comment_text', 'wpautop', 30 );
      add_filter( 'comment_text', [$this, 'parse_markdown' ] );
    }
  }

  /**
   * @action wp_enqueue_scripts
   */
  function enqueue_scripts() {
    $css_dir = plugin_dir_url(__FILE__) . 'assets';
    $js_dir = plugin_dir_url(__FILE__) . 'assets';

    wp_enqueue_style( 'h-editor', $css_dir . '/h-editor.css', [], '1.1.1' );
    wp_enqueue_script( 'h-editor', $js_dir . '/h-editor.js', [], '1.1.1', true );
  }

  /**
   * @filter comment_text
   */
  function parse_markdown( $text ) {
    $pd = new \Parsedown();
    $text_parsed = $pd->text( $text );
    return $text_parsed;
  }
}

