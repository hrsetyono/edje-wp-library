<?php

add_filter('nav_menu_submenu_css_class', '_h_submenu_classes', 10, 3);
add_filter('wp_nav_menu', '_h_mega_submenu_classes', 10);

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

/**
 * Change the "submenu" class to fit better for Mega menu usage
 */
function _h_mega_submenu_classes($menu) {
  // replace "submenu submenu-depth-1" into "mega-menu"
  // print_r('<pre>' . htmlspecialchars($menu) . '</pre>', false);
  $menu = preg_replace('/(menu-item-has-mega-menu.+)(submenu\ssubmenu-depth-1)/Uims', '$1mega-menu', $menu);

  // remove "submenu submenu-depth-2"
  $menu = preg_replace('/(mega-menu__column.+)(submenu\ssubmenu-depth-2)/Uims', '$1', $menu);
  
  return $menu;
}