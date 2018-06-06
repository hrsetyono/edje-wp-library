<?php
/*
  Function wrapper for creating Custom Post Type, Taxonomy, Post Table columns, etc.
*/

add_action( 'init', '_run_h_posttype' );
add_action( 'admin_init', '_run_admin_h_posttype' );

function _run_h_posttype() {
  require_once H_PATH . '/module-post-type/post-type.php';
  require_once H_PATH . '/module-post-type/taxonomy.php';

  // todo should only run in admin
  require_once H_PATH . '/module-post-type/post-column.php';
  require_once H_PATH . '/module-post-type/post-filter.php';
  require_once H_PATH . '/module-post-type/post-action.php';
}

function _run_admin_h_posttype() {
}
