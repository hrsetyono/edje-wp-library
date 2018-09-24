<?php
/*
  Function wrapper for creating Custom Post Type, Taxonomy, Post Table columns, etc.
*/

add_action( 'init', '_h_post_type' );

function _h_post_type() {
  require_once H_PATH . '/module-post-type/post-type.php';
  require_once H_PATH . '/module-post-type/taxonomy.php';

  // TODO: careful might broke the app
  if( is_admin() ) {
    require_once H_PATH . '/module-post-type/post-column.php';
    require_once H_PATH . '/module-post-type/post-filter.php';
    require_once H_PATH . '/module-post-type/post-action.php';
  }
}
