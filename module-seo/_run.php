<?php
/*
  Search Engine Optimization module
  - Handle meta tags, profile page, etc.
*/

if( is_admin() ) {
  // require_once H_PATH . '/module-seo/metabox.php';
  require_once H_PATH . '/module-seo/user-profile.php';
  // new \h\SEO_Metabox();
  new \h\SEO_Profile();
}
else {
  require_once H_PATH . '/module-seo/metatags.php';
  // require_once H_PATH . '/module-seo/microdata.php';
  new \h\SEO_Meta();
  // new \h\SEO_Microdata();
}
