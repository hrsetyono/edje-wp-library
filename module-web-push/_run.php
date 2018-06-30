<?php
/*
  Function wrapper for creating Web Push
  https://github.com/Minishlink/web-push-php-example
*/

if( version_compare(phpversion(), '7.1.0', '>=') ) {
  add_action( 'init', '_run_h_webpush' );
  add_action( 'admin_init', '_run_admin_h_webpush');
}

function _run_h_webpush() {

}

function _run_admin_h_webpush() {
  // require_once H_PATH . '/module-web-push/web-push.php';

  // $push = new \h\Web_Push();
  // $push->send_test();
}
