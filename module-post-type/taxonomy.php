<?php namespace h;
/*
  Create custom taxonomy
*/
class Taxonomy {
  private $post_type;
  private $args;

  public function __construct( $post_type, $args ) {
    $this->post_type = $post_type;
    $this->args = $args;
  }

  // Create taxonomy and it's filter
  public function init() {
    $args = $this->args;
    $post_type = $this->post_type;

    $wp_args = $this->parse_args( $args );

    register_taxonomy( $wp_args['name'], $post_type, $wp_args );

    // add taxonomy filter
    if( is_admin() ) {
      $pf = new Post_Filter( $post_type, $wp_args['name'] );
      $pf->init();
    }
  }

  //////////

  /*
    Parse the passed arguments into WP compatible one

    @param string $name
    @param array $raw - The raw arguments
    @return array
  */
  private function parse_args( $raw ) {
    $args = $this->check_raw_args( $raw );
    $labels = $this->create_labels( $args['label'], $args['name'] );

    $wp_args = array(
      'name' => $args['name'],
      'labels' => $labels,
      'slug' => $args['name'],
      'show_ui' => true,
      'query_var' => true,
      'show_admin_column' => true,
      'show_in_rest' => true,
      'hierarchical' => true,
      'rewrite' => array(
        'slug' => \_H::to_slug( $args['slug'] ),
        'with_front' => 'false'
      )
    );

    return $wp_args;
  }

  /*
    Make sure the args is complete, also parameterize or titleize each of them
    @param array $args - The taxonomy args

    @return array - The complete and formatted args
  */
  function check_raw_args( $args ) {
    // if plain text, form the array format
    if( is_string( $args ) ) {
      $args = array(
        'name' => $args, 'label' => $args, 'slug' => $args
      );
    }
    else {
      // complete the args by adding the missing one
      $args['name'] = isset( $args['name'] ) ? $args['name'] : $args['slug'];
      $args['slug'] = isset( $args['slug'] ) ? $args['slug'] : $args['name'];
    }

    // format the args
    $new_args = array(
      'name' => \_H::to_param( $args['name'] ),
      'label' => \_H::to_title( $args['label'] ),
      'slug' => \_H::to_param( $args['slug'] )
    );

    return $new_args;
  }

  /*
    Create all the labels for Taxonomy text

    @param string $name - Singular name of the CPT
    @param string $name - The taxonomy name
    @return array
  */
  private function create_labels( $label, $name ) {
    $plural = \Inflector::pluralize( $label );
    $singular = $label;

    $title = \_H::to_title( $name );
    $title_plural = \Inflector::pluralize( $title );

    $labels = array(
      'name' => $title_plural,
      'singular_name' => $title,
      'menu_name' => $plural,
      'all_items' => 'All ' . $plural,
      'edit_item' => 'Edit ' . $singular,
      'view_item' => 'View ' . $singular,
      'update_item' => 'Update ' . $singular,
      'add_new_item' => 'Add New ' . $singular,
      'parent_item' => 'Parent ' . $singular,
      'search_items' => 'Search ' . $plural,
      'popular_items' => NULL,
      'add_or_remove_items' => 'Add or remove ' . strtolower( $plural ),
      'choose_from_most_used' => 'Choose from the most used ' . strtolower( $plural ),
      'not_found' => 'No ' . strtolower( $plural ) . ' found'
    );

    return $labels;
  }
}
