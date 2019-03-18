<?php namespace h;
/*
  Crate custom post type
*/
class Post_Type {
  private $name;
  private $args;
  private $wp_args;
  private $labels;

  public function __construct( $name, $args = [] ) {
    // convert given name to all lower-case and no space
    $this->name = \_H::to_slug( $name );

    // default args
    $this->args = array_merge( [
      'icon' => 'dashicons-admin-post',
      'slug' => $this->name,
      'menu_position' => 30,
      'supports' => [],
    ], $args );

    $this->labels = $this->_create_labels( $this->name );
    $this->wp_args = $this->_create_wp_args();
  }

  /*
    Register CPT (Custom Post Type)
  */
  public function register() {
    register_post_type( $this->name, $this->wp_args );

    // add post count in dashboard widget
    add_action( 'dashboard_glance_items', array( $this, 'add_custom_post_glance' ) );
  }


  /*
    Add new item on At-a-Glance dashboard widgets

    @action dashboard_glance_items
  */
  function add_custom_post_glance() {
    $pt = $this->name;
    $wp_args = $this->wp_args;

    if(!post_type_exists( $pt ) ) { return false; };
    
    $icon = $wp_args['menu_icon'];

    $num_posts = wp_count_posts( $pt );
    $num = number_format_i18n( $num_posts->publish );
    $text = _n( $wp_args['labels']['singular_name'], $wp_args['labels']['name'], intval( $num_posts->publish ) );

    echo "<li class='$icon dashicons-before'><a href='edit.php?post_type=$pt>$num $text</a></li>";
  }

  //////////

  /*
    Create all the labels for CPT text

    @param string $slug
    @return array
  */
  private function _create_labels( $slug ) {
    $name = \_H::to_title( $slug );
    $plural = \Inflector::pluralize( $name );
    $singular = $name;

    $labels = array(
      'name' => $plural,
      'singular_name' => $singular,
      'all_items' => 'All ' . $plural,
      'add_new_item' => 'Add New ' . $singular,
      'edit_item' => 'Edit ' . $singular,
      'new_item' => 'New ' . $singular,
      'view_item' => 'View ' . $singular,
      'search_items' => 'Search ' . $plural,
      'not_found' => 'No ' . strtolower( $plural ) . ' found',
      'not_found_in_trash' => 'No ' . strtolower( $plural ) . ' found in Trash',
      'parent_item_colon' => 'Parent ' . $singular . ':',
    );

    return $labels;
  }

  /*
    Create the Arguments that is compatible with the WP function
    
    @return array
  */
  private function _create_wp_args() {
    $name = $this->name;
    $args = $this->args;
    $slug = $args['slug'];

    // Merge supports with the default one
    $default_supports = array( 'title', 'editor', 'thumbnail', 'excerpt' );
    $supports = array_merge( $default_supports, $args['supports'] );


    $wp_args = array(
      'public' => true,
      'labels' => $this->labels,
      'capability_type' => 'post',
      'supports' => $supports,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => $slug,
        'with_front' => false
      ),
      'menu_position' => $args['menu_position'],
    );

    // add icon
    $icon = str_replace('dashicons-', '', $args['icon'] );
    $wp_args['menu_icon'] = 'dashicons-' . $icon;


    // SUPPORTS

    // Allow CPT to be accessed by REST API
    if( in_array('rest-api', $args['supports'] ) ) {
      $wp_args['show_in_rest'] = true;
    }

    // Set behavior to be like Page
    if( in_array('page-attributes', $args['supports'] ) ) {
      $wp_args['hierarchical'] = true;
    }

    // Remove single page view
    if( in_array('hidden', $args['supports'] ) ) {
      $wp_args['publicly_queryable']  = false;
    }

    return $wp_args;
  }
}
