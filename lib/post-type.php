<?php
$h_menu_position = 30;

class H_PostType {
  private $name;
  private $args;

  public function __construct($name, $args) {
    $this->name = H_Util::to_slug($name);
    $this->args = $args;
  }

  /*
    Initiate adding Custom Post Type (CPT)
  */
  public function init() {
    $name = $this->name;
    $args = $this->args;

    $wp_args = $this->parse_args($name, $args);

    register_post_type($name, $wp_args);

    // if column ordering is given
    if(isset($args["columns"]) ) {
      $pc = new H_PostColumn($name, $args["columns"]);
      $pc->init();
    }

    // If taxonomy is given
    if(isset($args["taxonomy"]) ) {
      $tax = new H_Taxonomy($name, $args["taxonomy"]);
      $tax->init();
    }
  }

  //////////

  /*
    Parse the passed arguments into WP compatible one

    @param string $name
    @param array $args
    @return array
  */
  private function parse_args($name, $args) {
    $labels = $this->create_labels($name);
    $menu_position = $this->get_menu_position();

    $wp_args = array(
      "public" => true,
      "labels" => $labels,
      "capability_type" => "post",
      "supports" => array(
        "title",
        "editor",
        "custom-fields",
        "thumbnail",
      ),
      "rewrite" => array(
        "with_front" => false
      ),
      "menu_position" => $menu_position
    );

    // add icon if given
    if(isset($args["icon"]) ) {
      $icon = str_replace("dashicons-", "", $args["icon"] );
      $wp_args["menu_icon"] = "dashicons-" . $icon;
    }

    return $wp_args;
  }

  /*
    Create all the labels for CPT text

    @param string $name - Singular name of the CPT
    @return array
  */
  private function create_labels($name) {
    $name = ucfirst($name);
    $plural = Inflector::pluralize($name);
    $singular = $name;

    $labels = array(
      "name" => $plural,
      "singular_name" => $singular,
      "all_items" => "All " . $plural,
      "add_new_item" => "Add New " . $singular,
      "edit_item" => "Edit " . $singular,
      "new_item" => "New " . $singular,
      "view_item" => "View " . $singular,
      "search_items" => "Search " . $plural,
      "not_found" => "No " . strtolower($plural) . " found",
      "not_found_in_trash" => "No " . strtolower($plural) . " found in Trash",
      "parent_item_colon" => "Parent " . $singular . ":",
    );

    return $labels;
  }

  /*
    Look for available menu position

    @return int
  */
  private function get_menu_position() {
    global $h_menu_position;

    $mp = $h_menu_position; // cache
    $h_menu_position += 5;

    return $mp;
  }
}
