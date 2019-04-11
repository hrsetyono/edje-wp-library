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
      'icon' => 'dashicons-admin-post',
      'post_types' => ['page'],
      'description' => '',
    ], $args );

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
      'title' => \_H::to_title( $name ) . '-',
      'description' => $args['description'],
      'render_callback' => [$this, '_render'],
      'category' => 'formatting',
      'icon' => $args['icon'],
      'align' => 'wide',
      'mode' => 'edit',
      'post_types' =>  $args['post_types']
    ] );
  }

  /**
   * Find Twig file that matches the block name and render it
   */
  function _render( array $block ) {
    $slug = str_replace( 'acf/', '', $block['name'] );

    $context['block'] = new \Timber\Block( $block );
    $context = apply_filters( "h/block/context_$slug" , $context );

    \Timber::render( "/blocks/_$slug.twig", $context );
  }
}