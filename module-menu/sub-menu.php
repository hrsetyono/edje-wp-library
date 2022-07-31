<?php

add_filter('nav_menu_submenu_css_class', '_h_submenu_classes', 10, 3);

/**
 * Add depth to the submenu class
 * 
 * @filter nav_menu_submenu_css_class
 */
function _h_submenu_classes($classes, $args, $depth) {
  // shorten the sub-menu class
  if ($classes[0] === 'sub-menu') {
    $classes[0] = 'submenu';
  }

  $depth += 1;
  $classes[] = "submenu-depth-{$depth}";
  return $classes;
}