<?php
/*
  Add extra functions to Twig module
*/
class H_Twig {

  function __construct() {
    add_filter('get_twig', array($this, 'add_to_twig') );

    // enable password-protected post
    add_filter('timber/post/content/show_password_form_for_protected', function( $maybe_show ) {
      return true;
    });
  }

  /*
    Add extra filter to Twig

    @filter get_twig
  */
  function add_to_twig( $twig ) {
    // Parse Markdown
    // {{ post.content | markdown }}
    $twig->addFilter( new Twig_SimpleFilter( 'markdown', function($text) {
      $pd = new Parsedown();
      $text_compiled = $pd->text($text);
      return do_shortcode( $text_compiled );
    } ) );

    // only if set to Debug mode
    if( defined('WP_DEBUG') && WP_DEBUG === true ) {
      // Dump the object
      $twig->addFilter( new Twig_SimpleFilter( 'dump', function( $object ) {
        var_dump( $object );
      }) );

      // Dump all methods available in the object
      $twig->addFilter( new Twig_SimpleFilter( 'methods', function( $object ) {
        var_dump( get_class_methods( $object ) );
      }) );
    }

    return $twig;
  }

}
