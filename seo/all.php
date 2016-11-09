<?php
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if(!is_admin() ) {
  require_once 'meta-tags.php';
  require_once 'microdata.php';
}
