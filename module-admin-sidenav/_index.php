<?php

add_action('plugins_loaded' , '_h_load_sidenav');

/**
 * @action plugins_loaded
 */
function _h_load_sidenav() {
  if (is_admin()) {
    require_once __DIR__ . '/sidenav.php';
    require_once __DIR__ . '/sidenav-sub.php';
  }
}

/////

/**
 * Remove sidenav link
 * 
 * @deprecated Needs rework to be easier to use
 */
function h_remove_menu(array $args) {
  if (!is_admin()) { return; }

  $menu = new H_Sidenav($args);
  $menu->remove();
}

/**
 * Add menu links in sidebar
 * 
 * @deprecated Needs rework to be easier to use
 */
function h_add_menus(array $args) {
  if (!is_admin()) { return;}

  $menu = new H_Sidenav($args);
  $menu->add();
}

/**
 * Add a menu link in sidebar. Alias for H::add_menus but only for 1 link.
 */
function h_add_menu(string $title, array $args) {
  h_add_menus([
    $title => $args
  ]);
}

/**
 * Add a submenu in sidebar
 * 
 * @deprecated Needs rework to be easier to use
 */
function h_add_submenu(string $parent_title, array $args) {
  h_add_menus([
    $parent_title => [
      'position' => "on $parent_title",
      'submenu' => $args
    ]
  ]);
}

/**
 * Add a number counter beside the sidebar's menu link
 * 
 * @param Callable():int $get_number
 */
function h_add_menu_counter(string $parent_title, Callable $get_number) {
  h_add_menus([
    $parent_title => [
      'position' => "on $parent_title",
      'counter' => $get_number,
    ]
  ]);
}