<?php
/**
 * Create CPT (Custom Post Type)
 * 
 * @deprecated 6.2.0 - use ACF instead
 */
class H_PostType {
  private $post_type;
  private $args;

  public function __construct(string $post_type, array $args = []) {
    $this->post_type = $post_type;

    $args['labels'] = $this->_create_labels($this->post_type);
    $args['supports'] = array_merge(
      ['title', 'editor', 'thumbnail', 'excerpt'],
      $args['supports'] ?? []
    );
    $this->args = $this->_parse_args($this->post_type, $args);
  }


  /**
   * Register CPT (Custom Post Type)
   */
  public function register() {
    register_post_type($this->post_type, $this->args);

    // add post count in dashboard widget
    add_action('dashboard_glance_items', [$this, 'add_custom_post_glance']);
  }

  
  /**
   * Add new item on At-a-Glance dashboard widgets
   * @action dashboard_glance_items
   */
  function add_custom_post_glance() {
    $pt = $this->post_type;
    $args = $this->args;

    if (!post_type_exists($pt)) { return; };
    
    $icon = $args['menu_icon'];

    $num_posts = wp_count_posts($pt);
    $num = number_format_i18n($num_posts->publish);
    $text = _n($args['labels']['singular_name'], $args['labels']['name'], intval($num_posts->publish));

    echo "<li class='$icon dashicons-before'><a href='edit.php?post_type=$pt'>$num $text</a></li>";
  }
  
  
  //////////

  /**
   * Create the arguments for register_post_type()
   */
  private function _parse_args(string $post_type, array $args) : array {
    $slug = $args['slug'] ?? $post_type;

    $parsed_args = wp_parse_args( $args, [
      'menu_icon' => 'dashicons-admin-post',
      'menu_position' => 30,
      'public' => true,
      'capability_type' => 'post',
      'rewrite' => [
        'slug' => $args['slug'] ?? $post_type,
        'with_front' => false
      ],
      
      'has_archive' => in_array('no-archive', $args['supports']) ? false : true,
      'show_in_rest' => in_array('no-api', $args['supports']) ? false : true,
      'hierarchical' => in_array('page-attributes', $args['supports']) ? true : false,
      'publicly_queryable' => in_array('no-single', $args['supports']) ? false : true,
    ] );

    return $parsed_args;
  }

  /**
   * Create all the labels for CPT text
   */
  private function _create_labels(string $post_type) : array {
    $title = _H::to_title($post_type);
    $plural = Inflector::pluralize($title);
    $singular = $title;

    $labels = [
      'name' => $plural,
      'singular_name' => $singular,
      'all_items' => 'All ' . $plural,
      'add_new_item' => 'Add New ' . $singular,
      'edit_item' => 'Edit ' . $singular,
      'new_item' => 'New ' . $singular,
      'view_item' => 'View ' . $singular,
      'search_items' => 'Search ' . $plural,
      'not_found' => 'No ' . strtolower($plural) . ' found',
      'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in Trash',
      'parent_item_colon' => 'Parent ' . $singular . ':',
    ];

    return $labels;
  }
}
