<?php

new H_Shortcode();

///// SHORTCODE /////

class H_Shortcode {

  function __construct() {
    add_shortcode('row', array($this, 'row') );
    add_shortcode('column', array($this, 'column') );

    // remove empty <p> on shortcode
    remove_filter('the_content', 'wpautop');
    add_filter('the_content', 'wpautop', 5);
    add_filter('the_content', array($this, 'shortcode_unautop'), 10);

    remove_filter('acf_the_content', 'wpautop');
    add_filter('acf_the_content', 'wpautop');
    add_filter('acf_the_content', array($this, 'shortcode_unautop'));
  }

  /*
    Wrap the content with Edje Row syntaxt, used together with [column] shortcode.
    - Don't add line spacing between shortcode to avoid the <h-row> getting wrapped with <p>. See example below.

    [row][column size="8"]
      Content
    [/column][column size="4"]
      Content
    [/column][/row]
  */
  function row($atts, $content = null) {
    return '<h-row>' . do_shortcode($content) . '</h-row>';
  }

  function column($atts, $content = null) {
    $a = shortcode_atts( array(
      'size' => null,
      'large' => null,
      'small' => null,
      'class' => null
    ), $atts);

    $class = $a['class'];

    // if class not specified
    if(is_null($class) ) {
      $class = 'large-' . (isset($a['large']) ? $a['large'] : $a['size'] );
      if(isset($a['small']) ) {
        $class .= ' small-' . $a['small'];
      }
    }

    return '<h-column class="column-shortcode ' . $class . '">' . do_shortcode($content) . '</h-column>';
  }


  function shortcode_unautop($content) {
    return strtr($content, [
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']',
      '<p>[/' => '[/'
    ]);
  }
}
