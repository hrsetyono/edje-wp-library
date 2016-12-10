<?php
/*
  Customize TinyMCE Editor

  http://archive.tinymce.com/wiki.php/TinyMCE3x:Buttons/controls
*/

new H_Editor();

class H_Editor {
  function __construct() {
    add_action('admin_init', array($this, 'add_editor_style') );
  }

  /*
    Add custom CSS to editor area
  */
  function add_editor_style() {
    add_editor_style(H_URL . '/assets/css/h-editor.css');
  }
}
