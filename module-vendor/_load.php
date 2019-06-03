<?php

/**
 * @action plugins_loaded
 */
function _h_load_vendor() {
  require_once __DIR__ . '/inflector.php';
  require_once __DIR__ . '/parsedown.php';
}