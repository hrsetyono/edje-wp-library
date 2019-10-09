<?php

add_action( 'plugins_loaded' , '_h_load_post_type' );


/**
 * @action plugins_loaded
 */
function _h_load_post_type() {
  // if( is_admin() ) {
  //   require_once __DIR__ . '/post-action.php';
  // }
}

/////

/**
 * Register Custom Post Type (CPT)
 */
function h_register_post_type( string $name, array $args = [] ) {
  require_once __DIR__ . '/post-type.php';

  $pt = new \h\Post_Type( $name, $args );
  $pt->register();
}

/**
 * Register Custom Taxonomy
 */
function h_register_taxonomy( string $name, array $args ) {
  require_once __DIR__ . '/taxonomy.php';
  require_once __DIR__ . '/post-filter.php';

  $tx = new \h\Taxonomy( $name, $args );
  $tx->register();
}


//// POST TABLE

/**
 * Override all columns in the Post Type table with this one.
 */
function h_override_columns( string $post_type, array $args ) {
  if( !is_admin() ) { return; }

  require_once __DIR__ . '/post-column.php';

  $pc = new \h\Post_Column();
  $pc->override( $post_type, $args );
}

/**
 * Alias for h_override_columns
 */
function h_register_columns( string $post_type, array $args ) {
  h_override_columns( $post_type, $args );
}


/**
 * Append a column to the Post Type table
 * 
 * @param string $post_type
 * @param $args - Column keywords or arguments with callable
 */
function h_add_column( string $post_type, $args ) {
  if( !is_admin() ) { return; }

  require_once __DIR__ . '/post-column.php';

  $pc = new \h\Post_Column();
  $pc->add( $post_type, $args );
}


/// POST ACTIONS - TODO: still not working


function h_add_actions( $post_type, $actions ) {
  if( !is_admin() ) { return; }

  $pa = new \h\Post_Action( $post_type, $actions );
  $pa->add();
}


function h_replace_actions( $post_type, $actions ) {
  if( !is_admin() ) { return; }

  $pa = new \h\Post_Action( $post_type, $actions );
  $pa->replace();
}
