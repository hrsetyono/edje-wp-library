<?php
/*
  Function wrapper for modifiying Customizer panel
*/

require_once H_PATH . '/module-customizer/customizer.php';
require_once H_PATH . '/module-customizer/customizer-default.php';
require_once H_PATH . '/module-customizer/customizer-tinymce.php';

new \h\Customizer_Default();
