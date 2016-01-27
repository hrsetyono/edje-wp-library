<?php

class H_Taxonomy {
  private $args;
  private $post_type;

  public function __construct($args, $post_type) {
    $this->args = $args;
    $this->post_type = $post_type;
  }

  // Create taxonomy and it's filter
  public function init() {
    $args = $this->args;
    $post_type = $this->post_type;

    $wp_args = $this->parse_args($args);

    register_taxonomy($wp_args["slug"], $post_type, $wp_args);

    // add taxonomy filter
    $pf = new H_PostFilter($post_type, $wp_args["slug"]);
    $pf->init();
  }

  //////////

  /*
    Parse the passed arguments into WP compatible one

    @param string $name
    @param array $args
    @return array
  */
  private function parse_args($args) {
    // if plain text, form the array format
    if(is_string($args) ) {
      $args = array(
        "label" => H_Util::to_title($name),
        "slug" => H_Util::to_slug($name)
      );
    }

    $labels = $this->create_labels($args["label"]);

    $wp_args = array(
      "labels" => $labels,
      "slug" => $args["slug"],
      "show_ui" => true,
      "query_var" => true,
      "show_admin_column" => false,
      "hierarchical" => true,
    );

    return $wp_args;
  }

  /*
    Create all the labels for Taxonomy text

    @param string $name - Singular name of the CPT
    @return array
  */
  private function create_labels($label) {
    $plural = Inflector::pluralize($label);
    $singular = $label;

    $labels = array(
      "name" => $plural,
      "singular_name" => $singular,
      "all_items" => "All " . $plural,
      "edit_item" => "Edit " . $singular,
      "view_item" => "View " . $singular,
      "update_item" => "Update " . $singular,
      "add_new_item" => "Add New " . $singular,
      "parent_item" => "Parent " . $singular,
      "search_items" => "Search " . $plural,
      "popular_items" => NULL,
      "add_or_remove_items" => "Add or remove " . strtolower($plural),
      "choose_from_most_used" => "Choose from the most used " . strtolower($plural),
      "not_found" => "No " . strtolower($plural) . " found"
    );

    return $labels;
  }


}
