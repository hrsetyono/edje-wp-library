<?php
/*
  Modify the links in WP-Admin's side panel
*/

if( is_admin() ) {
  require_once H_PATH . '/module-admin-sidenav/sidenav.php';
  require_once H_PATH . '/module-admin-sidenav/sidenav-sub.php';
}
