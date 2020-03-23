<?php namespace h;
/**
 * Modify the Admin Bar on both front-end and admin pages
 */
class Modify_Adminbar {
  function __construct() {
    add_action( 'admin_bar_menu', [$this, 'hide_avatar'], 0 );
    add_action( 'admin_bar_menu', [$this, 'hide_avatar'], 10 );
  }

  /**
   * Remove gravatar in admin bar (cause it loads slowly)
   * @action admin_bar_menu 0
   * @action admin_bar_menu 10
   */
  function hide_avatar() {
    add_filter( 'pre_option_show_avatars', '__return_zero' );
  }
}

new Modify_Adminbar();