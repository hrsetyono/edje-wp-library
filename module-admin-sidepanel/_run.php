<?php
/*
  Modify the links in WP-Admin's side panel
*/

add_action( 'init', '_run_h_sidepanel' );
add_action( 'admin_init', '_run_admin_h_sidepanel' );

function _run_h_sidepanel() {
  require_once H_PATH . '/module-admin-sidepanel/sidepanel.php';
  require_once H_PATH . '/module-admin-sidepanel/sidepanel-sub.php';
}

function _run_admin_h_sidepanel() {

}
