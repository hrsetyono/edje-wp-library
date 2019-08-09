<?php

/**
 * @action plugins_loaded
 */
function load_hmodule_vendor() {
  require_once __DIR__ . '/inflector.php';
  require_once __DIR__ . '/parsedown.php';
}