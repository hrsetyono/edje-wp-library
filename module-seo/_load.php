<?php

/**
 * @action plugins_loaded
 */
function load_hmodule_seo() {
  if( !is_admin() ) {
		require_once __DIR__ . '/structured-faq.php';
		
		new \h\StructuredData_FAQ();
  }
}