<?php
/**
 * Add or Remove sub-item from WP-Admin sidenav
 */
class H_SidenavSub {
  private $parent_slug;
  private $args;

  public function __construct($parent_slug, $args) {
    $this->parent_slug = $parent_slug;
    $this->args = $args;
  }

  /*
    Add submenu page to a parent menu

    @param string $parent_slug
    @param array $args - List of submenu in this format: array(name, slug)
  */
  public function add() {
    if (!is_admin()) { return false; }

    $parent_slug = $this->parent_slug;
    $args = $this->args;

    foreach ($args as $title => $slug) {
      add_submenu_page(
        $parent_slug,
        $title,
        $title,
        'manage_options',
        $slug
      );
    }
  }

}
