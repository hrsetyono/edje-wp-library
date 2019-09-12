<?php namespace h;

/**
 * Show Posts in Grid view
 * - Auto-generated when creating Post Type
 */
class Block_Post_list {
  private $post_type;
  private $args;
  private $taxonomy;
  private $label;
  private $menu_icon;

  function __construct( string $post_type, array $args = [] ) {
    $this->post_type = $post_type;
    $this->args = array_merge( [
      'max_amount' => 12,
      'orderby_field' => false,
    ], $args );


    $pt_object = get_post_type_object( $post_type );
    $this->label = $pt_object->labels->singular_name;
    $this->menu_icon = $pt_object->menu_icon ?? 'dashicons-admin-post';

    $taxonomies = get_object_taxonomies( $post_type );
    $this->taxonomy = $taxonomies[0] ?? null;
  }

  function register() {
    add_action( 'acf/init', [$this, 'create_fields'] );
    add_action( 'acf/init', [$this, 'create_block'] );
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
      'key' => "hgroup_{$pt}list",
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

    $description = "Show list of {$this->label}. Rendered file: ";
    $description .= class_exists('Timber') ? "/views/acf-blocks/{$block_name}.twig" : "/acf-blocks/{$block_name}.php";

    \H::register_block( $block_name, [
      'title' => "{$this->label} List",
      'icon' => $this->menu_icon,
      'post_types' => [ 'post', 'page', $this->post_type ],
      'description' => $description,
      'context_filter' => [$this, '_format_value'],
    ] );
  }


  /**
   * Format the variable that is accessible in the template
   */
  function _format_value( $context ) {
    $args = [];
    $post_type = $this->post_type;
    $taxonomy = $this->taxonomy;

    $post_term = $context['post_term'] ?? false;
    $post_ids = $context['post_ids'] ?? false;
    $post_amount = $context['amount'] ?? false;
    $orderby = $context['orderby'] ?? false;
    $order = $context['order'] ?? false;

    // if category
    if( $post_term ) {
      $args = [
        'post_type' => $post_type,
        'posts_per_page' => $post_amount,
        'tax_query' => [[
          'taxonomy' => $taxonomy,
          'field' => 'term_id',
          'terms' => $post_term
        ]]
      ];

      // make 'term' object available
      if( class_exists('Timber') ) {
        $context['term'] = new \TimberTerm( $post_term );
      } else {
        $context['term'] = get_term( $post_term );
      }
    }
    // if specific item
    else if( $post_ids ) {
      $args = [
        'post_type' => $post_type,
        'post__in' => $post_ids
      ];
    }
    // if both empty, get latest posts
    else {
      $args = [
        'post_type' => $post_type,
        'posts_per_page' => $post_amount,
      ];
    }

    // If has orderby
    if( $orderby ) {
      $args['orderby'] = $orderby;
    }

    if( $order ) {
      $args['order'] = $order;
    }

    // Get Posts
    if( class_exists('Timber') ) {
      $context['posts'] = \Timber::get_posts( $args );
    } else {
      $context['posts'] = get_posts( $args );
    }

    return $context;
  }


  /**
   * Format the fields argument for acf_add_local_field_group()
   */
  function _get_fields_args() : array {
    $fields = [];

    $pt = $this->post_type;
    $args = $this->args;
    $label = $this->label;
    $menu_icon = $this->menu_icon;
    $taxonomy = $this->taxonomy;

    // Title
    $fields[] = [
      'key' => "hfield_{$pt}_title",
      'label' => "<i class='dashicons-before {$menu_icon}'></i> {$label} List",
      'name' => '',
      'type' => 'message',
      'message' => '',
      'new_lines' => 'wpautop',
      'esc_html' => 0,
    ];

    if( $taxonomy ) {
      // Filter
      $fields[] = [
        'key' => "hfield_{$pt}_filter",
        'label' => 'Filter',
        'name' => 'filter',
        'type' => 'radio',
        'wrapper' => [ 'width' => '6' ],
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
      'key' => "hfield_{$pt}_amount",
      'label' => 'Amount',
      'name' => 'amount',
      'type' => 'range',
      'conditional_logic' => [[
        [
          'field' => "hfield_{$pt}_ids",
          'operator' => '==empty',
        ],
      ]],
      'wrapper' => [ 'width' => '6' ],
      'default_value' => 6,
      'min' => 2,
      'max' => $args['max_amount'],
      'step' => '',
    );

    if( $taxonomy ) {
      // Post Term
      $fields[] = [
        'key' => "hfield_{$pt}_term",
        'label' => '',
        'name' => 'post_term',
        'type' => 'taxonomy',
        'conditional_logic' => [[
          [
            'field' => "hfield_{$pt}_filter",
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
    $post_ids_conditional_logic = is_null( $taxonomy ) ? 0 : [ [
      [ 'field' => "hfield_{$pt}_filter", 'operator' => '==', 'value' => 'by-post-id' ],
    ] ];

    $fields[] = [
      'key' => "hfield_${pt}_ids",
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

    
    // Order By
    if( $args['orderby_field'] ) {
      $fields[] = [
        'key' => "hfield_{$pt}_orderby",
        'label' => 'Order by',
        'name' => 'orderby',
        'type' => 'button_group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '6',
          'class' => '',
          'id' => '',
        ],
        'choices' => [
          'date' => 'Date',
          'title' => 'Title',
          'rand' => 'Random',
        ],
        'allow_null' => 0,
        'default_value' => 'date',
        'layout' => 'horizontal',
        'return_format' => 'value',
      ];

      $fields[] = [
        'key' => "hfield_{$pt}_order",
        'label' => '&nbsp;',
        'name' => 'order',
        'type' => 'button_group',
        'conditional_logic' => [ [
          [ 'field' => "hfield_{$pt}_orderby", 'operator' => '!=', 'value' => 'rand' ],
        ] ],
        'wrapper' => array(
          'width' => '6',
        ),
        'choices' => array(
          'DESC' => 'Descending',
          'ASC' => 'Ascending',
        ),
        'allow_null' => 0,
        'default_value' => 'DESC',
        'layout' => 'horizontal',
        'return_format' => 'value',
      ];
    }

    return $fields;
  }
}


