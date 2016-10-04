<?php

new H_Shortcode();

///// SHORTCODE /////

class H_Shortcode {

  function __construct() {
    add_shortcode('row', array($this, 'row') );
    add_shortcode('column', array($this, 'column') );

    add_filter('the_content', array($this, 'grid_unautop'), 100);
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
      'size' => '12', // default is 12
      'large' => null,
      'small' => null
    ), $atts);

    // format the large and small class
    $class = 'large-' . (isset($a['large']) ? $a['large'] : $a['size'] );
    if(isset($a['small']) ) {
      $class .= ' small-' . $a['small'];
    }

    return '<h-column class="column-shortcode ' . $class . '">' . do_shortcode($content) . '</h-column>';
  }

  /*
    Fix Paragraph tag wrapping the ROW and COLUMN shortcode
  */
  function grid_unautop($content) {
    $shortcodes = array('h-row', 'h-column');

    // if no h-row
    if(!strpos($content, $shortcodes[0]) ) {
      return $content;
    }

    // trim the extra <p>
    foreach($shortcodes as $sc) {
      $trim_list = array (
        '<p><' . $sc => '<' .$sc,
        '<p></' . $sc => '</' .$sc,
        $sc . '></p>' => $sc . '>',
        $sc . '><br />' => $sc . '>',
      );

      $content = strtr($content, $trim_list);

      // remove the remaining </p> after <h-column class="...">
      preg_match("/(<{$sc}[^<]+)/", $content, $matches); // get without p
      $content = preg_replace("/<{$sc}[^<]+<\/p>/", $matches[0], $content);
    }

    return $content;
  }
}
