<?php namespace h;

/**
 * Show Posts in Grid view
 * - Auto-generated when creating Post Type
 */
class Block_Post_list {
  private $post_type;
  private $taxonomy;
  private $label;
  private $menu_icon;

  function __construct( string $post_type = 'post' ) {
    $this->post_type = $post_type;
    $pt_object = get_post_type_object( $post_type );

    $this->label = $pt_object->labels->singular_name;
    $this->menu_icon = $pt_object->menu_icon ?? 'dashicons-admin-post';

    $taxonomies = get_object_taxonomies( $post_type );
    $this->taxonomy = $taxonomies[0] ?? null;
  }

  function register() {
    add_action( 'acf/init', [$this, 'create_fields'] );
    add_action( 'acf/init', [$this, 'create_block'] );
    add_filter( "h/block_context/h-{$this->post_type}-list", [$this, 'format_context'] );
  }

  /**
   * 
   */
  function create_fields() {
    if( !function_exists('acf_add_local_field_group') ) { return; }

    $pt = $this->post_type;
    $label = $this->label;
    $fields = $this->_get_fields_args( $pt, $label );

    acf_add_local_field_group( [
      'key' => "hgroup_{$pt}_list",
      'title' => "Block - {$label} List",
      'fields' => $fields,
      'location' => [[
        [
          'param' => 'block',
          'operator' => '==',
          'value' => "acf/h-{$pt}-list",
        ],
      ]],
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
    ] );
  }


  /**
   * @action acf/init
   */
  function create_block() {
    $block_name = "h-{$this->post_type}-list";

    \H::register_block( $block_name, [
      'title' => "{$this->label} List",
      'icon' => $this->menu_icon,
      'post_types' => [ 'post', 'page', $this->post_type ],
      'description' => __( "Show list of {$this->label}. You need to create template file named: _{$block_name}.twig in /views/blocks/." ),
    ] );
  }


  /**
   * Format the variable that is accessible in the template
   * @filter h/block_context/post_list
   */
  function format_context( array $context ) : array {
    $posts = [];
    $post_type = $this->post_type;
    $taxonomy = $this->taxonomy;
    $post_term = $context['block']->post_term;
    $post_ids = $context['block']->post_ids;
    $post_amount = $context['block']->amount;

    // if category
    if( $post_term ) {
      $posts = \Timber::get_posts([
        'post_type' => $post_type,
        'posts_per_page' => $post_amount,
        'tax_query' => [[
          'taxonomy' => $taxonomy,
          'field' => 'term_id',
          'terms' => $post_term
        ]]
      ]);

      // make 'term' object available
      $context['term'] = new \Timber\Term( $post_term );
    }
    // if specific item
    else if( $post_ids ) {
      $posts = \Timber::get_posts([
        'post_type' => $post_type,
        'post__in' => $post_ids
      ]);
    }
    // if both empty, get latest posts
    else {
      $posts = \Timber::get_posts([
        'post_type' => $post_type,
        'posts_per_page' => $post_amount,
      ]);
    }

    $context['posts'] = $posts;
    return $context;
  }


  /**
   * Format the fields argument for acf_add_local_field_group()
   */
  function _get_fields_args() : array {
    $fields = [];

    $pt = $this->post_type;
    $label = $this->label;
    $menu_icon = $this->menu_icon;
    $taxonomy = $this->taxonomy;

    // Title
    $fields[] = [
      'key' => "h_{$pt}_title",
      'label' => '',
      'name' => '',
      'type' => 'message',
      'message' => "<i class='dashicons-before {$menu_icon}'></i> {$label} List",
      'new_lines' => 'wpautop',
      'esc_html' => 0,
    ];

    if( $taxonomy ) {
      // Filter
      $fields[] = [
        'key' => "h_{$pt}_filter",
        'label' => 'Filter',
        'name' => 'filter',
        'type' => 'radio',
        'wrapper' => [ 'width' => '50' ],
        'choices' => [
          'by-term' => 'By category',
          'by-post-id' => 'By specific item',
        ],
        'allow_null' => 0,
        'layout' => 'vertical',
        'return_format' => 'value'
      ];
    }

    // Amount
    $fields[] = array(
      'key' => "h_{$pt}_amount",
      'label' => 'Amount',
      'name' => 'amount',
      'type' => 'range',
      'conditional_logic' => [[
        [
          'field' => "h_{$pt}_ids",
          'operator' => '==empty',
        ],
      ]],
      'wrapper' => [ 'width' => '50' ],
      'default_value' => 6,
      'min' => 2,
      'max' => 12,
      'step' => '',
    );

    if( $taxonomy ) {
      // Post Term
      $fields[] = [
        'key' => "h_{$pt}_term",
        'label' => '',
        'name' => 'post_term',
        'type' => 'taxonomy',
        'conditional_logic' => [[
          [
            'field' => "h_{$pt}_filter",
            'operator' => '==',
            'value' => 'by-term',
          ],
        ]],
        'taxonomy' => $taxonomy,
        'field_type' => 'select',
        'allow_null' => 1,
        'add_term' => 0,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'id',
        'multiple' => 0,
      ];
    }

    // Post IDs
    $post_ids_conditional_logic = is_null( $taxonomy ) ? 0 : [[
      [ 'field' => "h_{$pt}_filter", 'operator' => '==', 'value' => 'by-post-id' ],
    ]];

    $fields[] = [
      'key' => "h_{$pt}_ids",
      'label' => '',
      'name' => 'post_ids',
      'type' => 'post_object',
      'conditional_logic' => $post_ids_conditional_logic,
      'post_type' => array(
        0 => $pt,
      ),
      'taxonomy' => '',
      'allow_null' => 1,
      'multiple' => 1,
      'return_format' => 'id',
      'ui' => 1,
    ];

    return $fields;
  }
}


