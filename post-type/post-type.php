<?php
$h_menu_position = 30;

class H_PostType {
  private $name;
  private $args;
  private $wp_args;

  public function __construct($name, $args) {
    $this->name = H_Elper::to_param($name);
    $this->args = $args;
  }

  /*
    Initiate adding Custom Post Type (CPT)
  */
  public function init() {
    $name = $this->name;
    $args = $this->args;

    $wp_args = $this->parse_args($name, $args);
    $this->wp_args = $wp_args;

    // Check Support
    if(isset($args['supports']) ) {
      // Add this post type to Jetpack's sitemap
      if(in_array('jetpack-sitemap', $args['supports']) ) {
        add_filter('jetpack_sitemap_post_types', array($this, 'jetpack_add_cpt') );
      }

      // Allow REST API access
      if(in_array('jetpack-api', $args['supports']) ) {
        add_filter('rest_api_allowed_post_types', array($this, 'jetpack_add_cpt') );
      }

      // if behave like Page
      if(in_array('page-attributes', $args['supports']) ) {
        $wp_args['hierarchical'] = true;
      }
    }

    // register
    register_post_type($name, $wp_args);

    // if column ordering is given
    if(is_admin() && isset($args['columns']) ) {
      $pc = new H_PostColumn($name, $args['columns']);
      $pc->init();
    }

    // If taxonomy is given
    if(isset($args['taxonomy']) ) {
      $tax = new H_Taxonomy($name, $args['taxonomy']);
      $tax->init();
    }
  }

  /*
    Add CPT to Jetpack list

    @filter jetpack_sitemap_post_types
  */
  function jetpack_add_cpt($types) {
    $types[] = $this->name;
    return $types;
  }

  /*
    Add new item on At-a-Glance dashboard widgets

    @action dashboard_glance_items
  */
  function add_custom_post_glance() {
    $pt = $this->name;
    if(!post_type_exists($pt) ) { return false; };

    $wp_args = $this->wp_args;
    $icon = $wp_args['menu_icon'];

    $num_posts = wp_count_posts($pt);
    $num = number_format_i18n($num_posts->publish);
    $text = _n($wp_args['labels']['singular_name'], $wp_args['labels']['name'], intval($num_posts->publish) );

    echo '<li class="'.$icon.' dashicons-before"><a href="edit.php?post_type='.$pt.'">'.$num.' '.$text.'</a></li>';
  }

  //////////

  /*
    Parse the passed arguments into WP compatible one

    @param string $name
    @param array $args
    @return array
  */
  private function parse_args($name, $args) {
    $slug = H_Elper::to_slug($name);
    $labels = $this->create_labels($name);
    $menu_position = $this->get_menu_position();

    // if slug is defined
    if(isset($args['slug'] )) {
      $slug = $args['slug'];
    }

    // init support and merge if any
    $supports = array('title', 'editor', 'thumbnail', 'excerpt', 'revisions');
    if(isset($args['supports'] )) {
      $supports = array_merge($supports, $args['supports']);
    }

    $wp_args = array(
      'public' => true,
      'labels' => $labels,
      'capability_type' => 'post',
      'supports' => $supports,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => $slug,
        'with_front' => false
      ),
      'menu_position' => $menu_position,
    );

    // add icon if given
    if(isset($args['icon']) ) {
      $icon = str_replace('dashicons-', '', $args['icon'] );
      $wp_args['menu_icon'] = 'dashicons-' . $icon;
    }

    return $wp_args;
  }

  /*
    Create all the labels for CPT text

    @param string $raw_name - Parameterized name of the CPT
    @return array
  */
  private function create_labels($raw_name) {
    $name = H_Elper::to_title($raw_name);
    $plural = Inflector::pluralize($name);
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
      'not_found' => 'No ' . strtolower($plural) . ' found',
      'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in Trash',
      'parent_item_colon' => 'Parent ' . $singular . ':',
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
