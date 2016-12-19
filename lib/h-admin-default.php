<?php

new H_Admin_Default();
class H_Admin_Default {

  function __construct() {
    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );
    add_action('admin_init', array($this, 'add_editor_style') );
  }

  /*
    Add CSS and JS to admin area

    @action admin_enqueu_scripts
  */
  function admin_enqueue_scripts() {
    wp_enqueue_style('h-admin', H_URL . '/assets/css/h-admin.css');
  }

  /*
    Add custom CSS to editor area

    @action admin_init
  */
  function add_editor_style() {
    add_editor_style(H_URL . '/assets/css/h-editor.css');
  }
}
