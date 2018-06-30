<?php
/*
  Search Engine Optimization module
  - Handle meta tags, profile page, etc.
*/
add_action( 'init', '_run_h_seo' );
add_action( 'admin_init', '_run_admin_h_seo' );

function _run_h_seo() {
  if( is_admin() ) { return false; }

  require_once H_PATH . '/module-seo/metatags.php';
  require_once H_PATH . '/module-seo/microdata.php';
  new \h\SEO_Meta();
  // new \h\SEO_Microdata();
}

function _run_admin_h_seo() {
  require_once H_PATH . '/module-seo/metabox.php';
  require_once H_PATH . '/module-seo/user-profile.php';
  new \h\SEO_Metabox();
  new \h\SEO_Profile();
}
