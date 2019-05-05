<?php namespace h;

class Block_More {
  function __construct() {
    add_filter( 'the_content', [$this, 'add_readmore_button'] );
  }

  /**
   * WHen "More" Block is used, replace it with a button
   * @filter the_content
   */
  function add_readmore_button( $content ) {
    $has_readmore = strpos( $content, '<!--more-->' );

    if( $has_readmore ) {
      $content = substr_replace( $content, "<div class='h-block-readmore'> <a class='button --passive'>Read More…</a> </div>", $has_readmore, 11 );
    }

    return $content;
  }
}