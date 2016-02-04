<?php
class H_Menu {
  private $args;

  public function __construct($args) {
    $this->args = $args;
  }

  /*
    Add new menu items
  */
  public function add() {
    add_action("admin_menu", array($this, "_add_menu") );
  }

  /*
    Remove the admin menu by specifying the display text (case sensitive)
  */
  public function remove() {
    add_action("admin_menu", array($this, "_remove_menu") );
  }

  public function counter() {
    add_action("admin_menu", array($this, "_add_menu_counter") );
  }

  /////////

  public function _add_menu() {
    $args = $this->args;

    global $menu;
    end($menu);

    foreach($args as $title => $value):
      $anchor = $this->get_anchor($menu, $value["position"]);
      $position = $this->get_position($menu, $anchor);

      // if slug is specified, it's either menu or submenu
      if(isset( $value["slug"]) ) {
        switch($anchor[1]):
          // sub menu
          case "inside":
            $parent_slug = $menu[$position][2];
            $submenu = array($title => $value["slug"]);
            $this->add_submenu($parent_slug, $submenu);
            break;

          // top menu
          case "below":
          case "above":
            // if has icon
            if($value["icon"]) {
              $icon = "dashicons-" . str_replace("dashicons-", "", $value["icon"]);
            }

            add_menu_page($title, $title, "manage_options",
              $value["slug"], null, $icon, $position
            );
            break;
        endswitch;
      }

      // if has submenu
      if(isset( $value["submenu"]) ) {
        $this->add_submenu($value["slug"], $value["submenu"]);
      }

      // If has counter
      if(isset( $value["counter"]) ) {
        $menu[$position][0] .= $this->add_counter($value["counter"]);
      }
    endforeach;
  }

  public function _remove_menu() {
    $args = $this->args;

    global $menu;
    end($menu);

    foreach($menu as $index => $value):
      if($value[0]) {
        $i = explode(" <", $value[0]); // sometimes has <span> HTML, so take the first one

        if(in_array($i[0], $args) ) {
          unset($menu[$index]);
        }
      }
    endforeach;
  }

  /////////////

  /*
    Get the position of the specified anchor

    @param string $raw_position - The string that explicitly says the position
    @return array - [0] the placement [1] the anchor item
  */
  private function get_anchor($menu, $raw_position) {
    preg_match("/(\w+)\s(\D+)/", $raw_position, $anchor);
    return $anchor;
  }

  /*
    Look for specified position

    @param array $menu - The global $menu variable
    @param array $anchor - The anchor position

    @return int - The position in integer
  */
  private function get_position($menu, $anchor) {
    $position = 0;
    $increment = 0;

    // Look for the anchor position
    foreach($menu as $key => $m) {
      if($m[0] == $anchor[2]) {
        $position = $key;
        break;
      }
    }

    // immediately return the position is INSIDE
    if($anchor[1] == "inside") { return $position; }

    // Set for increment or decrement
    switch($anchor[1]) {
      case "above":
        $increment = -1;
        break;
      case "below":
        $increment = 1;
        break;
    }

    // If position already occupied, add one
    do {
      $position += $increment;
    } while(isset( $menu[$position]) );

    return $position;
  }

  /*
    Add submenu page to a parent menu

    @param string $parent_slug
    @param array $args - List of submenu in this format: array(name, slug)
  */
  private function add_submenu($parent_slug, $args) {
    foreach($args as $title => $slug):
      add_submenu_page($parent_slug, $title, $title,
        "manage_options", $slug
      );
    endforeach;
  }

  /*
    Add a Counter to the menu item

    @param array $menu_item - A single item from global $menu
    @param function $count_function - A callback that returns integer
  */
  private function add_counter($count_function) {
    $count = $count_function();
    return " <span class='update-plugins count-{$count}'><span class='plugin-count'>{$count}</span></span>";
  }
}
