<?php
/**
 * Modify the Admin Bar on both front-end and admin pages
 */


add_action( 'admin_bar_menu', '_h_hide_avatar', 0 );
add_action( 'admin_bar_menu', '_h_hide_avatar', 10 );


/**
 * Remove gravatar in admin bar (cause it loads slowly)
 * @action admin_bar_menu 0
 * @action admin_bar_menu 10
 */
function _h_hide_avatar() {
  add_filter( 'pre_option_show_avatars', '__return_zero' );
}