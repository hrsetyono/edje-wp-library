<?php
/**
 * Add or Remove item from WP-Admin sidenav
 */
class H_Sidenav {
  private $args;

  function __construct($args) {
    $this->args = $args;
  }

  /*
    Add new menu items
  */
  public function add() {
    if (!is_admin()) { return false; }

    add_action('admin_menu', [$this, '_add']);
  }

  /*
    Remove the admin menu by specifying the display text (case sensitive)
  */
  public function remove() {
    if (!is_admin()) { return false; }

    add_action('admin_menu', [$this, '_remove']);
  }

  /////////

  public function _add() {
    global $menu;
    end($menu);

    $args = $this->args;

    foreach ($args as $title => $value):
      $position = null;
      $icon = null;

      // get position if specified
      if (isset($value['position'])) {
        $position = $this->get_position($menu, $value['position']);
      }

      if (isset($value['icon'])) {
        $icon = _H::to_icon($value['icon']);
      }

      // add top level menu if slug is specified
      if (isset($value['slug'])) {
        add_menu_page(
          $title,
          $title,
          'manage_options',
          $value['slug'],
          null,
          $icon,
          $position
        );
      }

      // if has submenu
      if (isset($value['submenu'])) {
        $parent_slug = isset($value['slug']) ? $value['slug'] : $menu[$position][2];

        $smenu = new H_SidenavSub($parent_slug, $value['submenu']);
        $smenu->add();
      }

      // If has counter
      if (isset($value['counter'])) {
        $menu[$position][0] .= $this->add_counter($value['counter']);
      }

    endforeach;
  }

  public function _remove() {
    global $menu;
    end($menu);

    $args = $this->args;

    foreach ($menu as $index => $value):
      if ($value[0]) {
        $i = explode(' <', $value[0]); // sometimes has <span> HTML, so take the first one

        if (in_array($i[0], $args)) {
          unset($menu[$index]);
        }
      }
    endforeach;
  }

  /////////////

  /*
    Add a Counter to the menu item

    @param $count_cb (function) - A callback that returns integer
  */
  private function add_counter($count_cb) {
    $count = $count_cb();
    return " <span class='update-plugins count-$count'><span class='plugin-count'>$count</span></span>";
  }


  /*
    Look for available position based on anchor

    @param array $menu - The global $menu variable
    @param array $raw_position - The stringified position, ex: 'below Posts'.

    @return int - The position of anchor
  */
  private function get_position($menu, $raw_position) {
    // parse the string
    preg_match('/(\w+)\s(\D+)/', $raw_position, $anchor);
    $placement = $anchor[1];
    $title = $anchor[2];

    $position = 0;
    $increment = 0;

    // Look for the base position
    foreach ($menu as $key => $value) {
      if ($value[0] == $title) {
        $position = $key;
        break;
      }
    }

    // Set for increment or decrement
    switch ($placement) {
      case 'above':
        $increment = -1;
        break;
      case 'below':
        $increment = 1;
        break;
      case 'on':
        return $position; // no need for increment
    }

    // If position already occupied, add one
    do {
      $position += $increment;
    } while(isset($menu[$position]));

    return $position;
  }
}
