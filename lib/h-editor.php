<?php
/*
  Customize TinyMCE Editor

  http://archive.tinymce.com/wiki.php/TinyMCE3x:Buttons/controls
*/

new H_Editor();

class H_Editor {
  function __construct() {
    add_action('admin_init', array($this, 'add_editor_style') );

    add_filter('mce_buttons', array($this, 'mce_buttons') );
    add_filter('mce_buttons_2', array($this, 'mce_buttons_2') );
  }

  /*
    Add custom CSS to editor area
  */
  function add_editor_style() {
    add_editor_style(H_URL . '/assets/css/editor.css');
  }

  /*
    Customize the first row of buttons
  */
  function mce_buttons($buttons) {
    // strike, unlink, more, fullscreen
    foreach(array(2, 11, 12, 14) as $i) {
      unset($buttons[$i]);
    }

    array_unshift($buttons, 'formatselect');

    return $buttons;
  }

  /*
    Customize the second row of buttons
  */
  function mce_buttons_2($buttons) {
    unset($buttons[0]); // formatselect

    array_unshift($buttons, 'strikethrough');
    $buttons[] = 'wp_more';

    return $buttons;
  }
}
