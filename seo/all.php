<?php
if(is_admin() ) {
  require_once 'h-metabox.php';
  require_once 'h-profile.php';
} else {
  require_once 'h-metatags.php';
  require_once 'h-microdata.php';
}
