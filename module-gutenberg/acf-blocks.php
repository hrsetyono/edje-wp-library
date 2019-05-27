<?php namespace h;
/**
 * Create ACF Gutenberg blocks
 */
class ACF_Block {
  private $name;
  private $args;

  function __construct( string $name, array $args = [] ) {
    $this->name = $name;

    $this->args = array_merge( [
      'title' => \_H::to_title( $name ),
      'icon' => 'admin-post',
      'post_types' => ['page'],
      'description' => '',
    ], $args );
    
    // remove 'dashicons-' prefix, if any
    $this->args['icon'] = str_replace('dashicons-', '', $this->args['icon'] );

    // extra context to be made available in the rendered Twig template
    if( isset( $args['context'] ) ) {
      add_filter( "h/block/context_$name", $args['context'] );
    }
  }

  /**
   * Register ACF Block
   */
  function register() {
    $name = $this->name;
    $args = $this->args;

    acf_register_block( [
      'name' => $name,
      'title' => $args['title'] . '-',
      'description' => $args['description'],
      'render_callback' => [$this, '_render'],
      'category' => 'formatting',
      'icon' => $args['icon'],
      'mode' => 'edit',
      'post_types' =>  $args['post_types']
    ] );
  }

  /**
   * Find Twig file that matches the block name and render it
   */
  function _render( array $block ) {
    $slug = str_replace( 'acf/', '', $block['name'] );

    $block = $this->_get_fields( $block );
    $block = apply_filters( "h/block_value/$slug" , $block );
    
    // Render the template
    if( class_exists( 'Timber' ) ) {
      \Timber::render( [ "/acf-blocks/$slug.twig", '/acf-blocks/h-post-list.twig' ], $block );
    } else {
      set_query_var( 'block', $block );
      get_template_part( "acf-blocks/$slug", '' );
    }
  }


  /**
   * Reform the data from ACF Block to only include the Fields data
   */
  private function _get_fields( array $block ) : array {
    $data = array_filter( $block['data'], function( $key ) {
      return substr( $key, 0, 1 ) !== '_';
    }, ARRAY_FILTER_USE_KEY );

    foreach( $data as $key => &$value ) {
      $value = get_field( $key );
    }

    return $data;
  }
}