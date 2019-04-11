<?php namespace h;
/**
 * Create Custom Taxonomy
 */
class Taxonomy {
  private $tax_name;
  private $args;
  private $labels;
  private $wp_args;
  private $post_type;

  public function __construct( $name, $args = [] ) {
    $this->tax_name = \_H::to_slug( $name );
    
    $this->args = array_merge( [
      'post_type' => 'post',
      'display_name' => $args['label'] ?? \_H::to_title( $name ),
      'slug' => $this->tax_name,
    ], $args );

    $this->post_type = $this->args['post_type'];
    $this->labels = $this->_create_labels( $this->tax_name, $this->args['display_name'] );
    $this->wp_args = $this->_create_wp_args();
  }

  /**
   * Create taxonomy and the Post table filter
   */
  public function register() {
    register_taxonomy( $this->tax_name, $this->post_type, $this->wp_args );

    // add taxonomy filter
    if( is_admin() ) {
      $pf = new Post_Filter( $this->post_type, $this->tax_name );
      $pf->add();
    }
  }

  //////////

  /**
   * Create text labels for Taxonomy.
   */
  private function _create_labels( string $name, string $display_name ) : array {
    $plural = \Inflector::pluralize( $display_name );
    $singular = $display_name;

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

  /**
   * Create the Arguments that is compatible with the WP function
   */
  private function _create_wp_args() : array {
    $name = $this->tax_name;
    $args = $this->args;

    $wp_args = array(
      'name' => $name,
      'labels' => $this->labels,
      'slug' => $name,
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
}
