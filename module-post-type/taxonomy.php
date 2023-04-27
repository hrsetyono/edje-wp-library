<?php
/**
 * Create Custom Taxonomy
 * 
 * @deprecated 6.2.0 - use ACF instead
 */
class H_Taxonomy {
  private $taxonomy;
  private $post_type;
  private $args;

  public function __construct(string $taxonomy, string $post_type='post', array $args = []) {
    $this->taxonomy = $taxonomy;
    $this->post_type = $post_type;

    $args['labels'] = $this->_create_labels($this->taxonomy, $args['label'] ?? '');
    $this->args = $this->_parse_args($this->taxonomy, $args);
  }

  /**
   * Create taxonomy and the Post table filter
   */
  public function register() {
    register_taxonomy($this->taxonomy, $this->post_type, $this->args);

    // add taxonomy filter
    if (is_admin()) {
      $pf = new H_PostFilter($this->post_type, $this->taxonomy);
      $pf->add();
    }
  }

  //////////

  /**
   * Create the Arguments that is compatible with the WP function
   */
  private function _parse_args(string $taxonomy, array $args) : array {
    $parsed_args = wp_parse_args($args, [
      'show_ui'   => true,
      'query_var' => true,
      'show_admin_column' => true,
      'show_in_rest' => true,
      'hierarchical' => true,
      'rewrite' => [
        'slug' => $args['slug'] ?? $taxonomy,
        'with_front' => false
      ]
    ]);

    return $parsed_args;
  }

    /**
   * Create text labels for Taxonomy.
   */
  private function _create_labels(string $taxonomy, string $label='') : array {
    $title = _H::to_title($taxonomy);
    $title_plural = Inflector::pluralize($title);

    // check if label is defined
    $label = $label ? $label : $title;
    $label_plural = $label ? Inflector::pluralize($label) : $title_plural;

    $labels = [
      'name' => $title_plural,
      'singular_name' => $title,
      'menu_name' => $label_plural,
      'all_items' => 'All ' . $label_plural,
      'edit_item' => 'Edit ' . $label,
      'view_item' => 'View ' . $label,
      'update_item' => 'Update ' . $label,
      'add_new_item' => 'Add New ' . $label,
      'parent_item' => 'Parent ' . $label,
      'search_items' => 'Search ' . $label_plural,
      'popular_items' => NULL,
      'add_or_remove_items' => 'Add or remove ' . strtolower($label_plural),
      'choose_from_most_used' => 'Choose from the most used ' . strtolower($label_plural),
      'not_found' => 'No ' . strtolower($label_plural) . ' found'
    ];

    return $labels;
  }
}
