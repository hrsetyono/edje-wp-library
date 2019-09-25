<?php namespace h;
/**
 * Create ACF Gutenberg blocks
 */
class ACF_Block {
  private $args;

  function __construct( string $slug, array $args = [] ) {
    $this->args = array_merge( [
      'title' => \_H::to_title( $slug ),
      'name' => $slug,
      'icon' => 'admin-post',
      'post_types' => ['page'],
      'description' => "Rendered to '/views/acf-blocks/{$slug}.twig'",
      'context_filter' => function( $block ) { return $block; },
    ], $args );
    
    // remove 'dashicons-' prefix, if any
    $this->args['icon'] = str_replace('dashicons-', '', $this->args['icon'] );

    // add filter to context value
    add_filter( "h/block_context/$slug", $this->args['context_filter'] );
  }

  /**
   * Register ACF Block
   */
  function register() {
    $args = $this->args;

    acf_register_block_type( [
      'name' => $args['name'],
      'title' => $args['title'] . '-',
      'description' => $args['description'],
      'render_callback' => [$this, '_render_callback'],
      'category' => 'formatting',
      'icon' => $args['icon'],
      'mode' => 'edit',
      'post_types' =>  $args['post_types']
    ] );
  }

  /**
   * Find Twig file that matches the block name and render it
   */
  function _render_callback( array $context ) {
    $slug = str_replace( 'acf/', '', $context['name'] );

    $context = $this->_get_fields( $context );
    $context = apply_filters( "h/block_context/$slug" , $context );

    // Render the template
    if( class_exists( 'Timber' ) ) {
      \Timber::render( [ "acf-blocks/$slug.twig" ], $context );
    } else {
      set_query_var( 'block', $context );
      get_template_part( "acf-blocks/$slug", '' );
    }
  }


  /**
   * Reform the data from ACF Block to only include the Fields data
   */
  private function _get_fields( array $block ) : array {
    $data = [
      'block' => $block
    ];

    foreach( $block['data'] as $key => $value ) {
      // If start with underscore, continue
      if( substr( $key, 0, 1 ) === '_' ) { continue; }

      $name = $key;
      
      // If start with "field", get the field name
      if( substr( $key, 0, 6 ) === 'field_' ) {
        $field_object = get_field_object( $key );
        $name = $field_object['name'];
      }

      $data[ $name ] = get_field( $key );
    }

    return $data;
  }
}