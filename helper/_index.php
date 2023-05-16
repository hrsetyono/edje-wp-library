<?php

require_once __DIR__ . '/utilities.php';
require_once __DIR__ . '/utilities-gutenberg.php';
require_once __DIR__ . '/utilities-private.php';
require_once __DIR__ . '/utilities-deprecated.php';
require_once __DIR__ . '/Pagination.php';
require_once __DIR__ . '/Markdown.php';


add_action('plugins_loaded' , function() {
  require_once __DIR__ . '/shortcode.php';
});