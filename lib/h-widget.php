<?php
/*
  Widget Modifier
*/

new H_Widget();
class H_Widget {
  function __construct() {
    add_filter('widget_text', array($this, 'text_use_markdown'), 10, 2);
  }

  /*
    Apply markdown if "auto-add paragraph" is not checked

    @filter widget_text

    @param string $text - The body text
    @param array $instance - The widget setting
    @return string - Modified text
  */
  function text_use_markdown($text, $instance) {
    // if not auto-add paragraph
    if($instance['filter'] === false ) {
      $pd = new Parsedown();
      $text = $pd->text($text);
    }

    return $text;
  }

}
