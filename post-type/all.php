<?php
require_once 'post-type.php';
require_once 'taxonomy.php';

// admin
if(is_admin() ) {
  require_once 'post-column.php';
  require_once 'post-filter.php';
  require_once 'post-action.php';
}
