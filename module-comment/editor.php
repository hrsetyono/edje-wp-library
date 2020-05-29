<?php

if( !class_exists( 'H_CommentEditor' ) ) {
/**
 * Add toolbar to Comment Form and parse the markdown
 */
class H_CommentEditor {
  function __construct() {
    add_action( 'wp', [$this, 'init'] ); 
    add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
  }


  /**
   * @action after_setup_theme
   */
  function init() {
    if( !get_theme_support( 'h-comment-editor' ) ) { return; }

    remove_filter( 'comment_text', 'wptexturize', 10 );
    remove_filter( 'comment_text', 'make_clickable', 9 );
    remove_filter( 'comment_text', 'wpautop', 30 );
    add_filter( 'comment_text', [$this, 'parse_markdown' ] );
  }

  /**
   * @action wp_enqueue_scripts
   */
  function enqueue_scripts() {
    global $post;
    $is_comment_open = isset( $post->comment_status ) && $post->comment_status == 'open';

    // Enable comment's reply form
    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    // If supported, add the editor
    if( get_theme_support( 'h-comment-editor' ) && $is_comment_open ) {
      $css_dir = plugin_dir_url(__FILE__) . 'assets';
      $js_dir = plugin_dir_url(__FILE__) . 'assets';

      wp_enqueue_style( 'h-editor', $css_dir . '/h-editor.css', [], '1.1.2' );
      wp_enqueue_script( 'h-editor', $js_dir . '/h-editor.js', [], '1.1.2', true );
    }
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

new H_CommentEditor();
}