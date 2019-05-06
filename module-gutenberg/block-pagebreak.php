<?php namespace h;

/**
 * This module is ABANDONED
 * Very hard implementation with almost no real use case
 */
class Block_Pagebreak {
  function __construct() {
    add_filter( 'the_content', [$this, 'add_pagination'] );
  }

  /**
   * When "Pagebreak Block" is used, split the content and add pagination
   * @filter the_content
   */
  function add_pagination() {
    
  }
}