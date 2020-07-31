<?php

/**
 * 
 */
class H_Widget_Recent_Posts extends H_Widget { 
  function __construct() {
    parent::__construct( 'h_recent_posts', __( 'Recent Posts' ), [
      'description' => __( 'Show latest posts' )
    ] );
  }

  function widget( $args, $instance ) {
    $content = '';
    $id = $args['widget_id'];

    $title = get_field( 'title', "widget_$id" );
    $number_of_posts = get_field( 'number_of_posts', "widget_$id" );
    $option = get_field( 'option', "widget_$id" );

    // get posts
    $posts = get_posts([
      'posts_per_page' => $number_of_posts,
    ]);

    // output title
    $content .= $args['before_title'] . $title . $args['after_title'];

    // output posts
    $content_posts = '';
    foreach( $posts as $p ) {
      $link = get_permalink( $p );
      $title = $p->post_title;
      $thumbnail = in_array( 'thumbnail', $option )
        ? get_the_post_thumbnail( $p, 'thumbnail' ) : '';
      $date = in_array( 'date', $option )
        ? '<span class="post-date">' . get_the_date( '', $p ) . '</span>' : '';

      $content_posts .= "<li>
        <a href='{$link}'>
          {$thumbnail}
          <h6>{$title}</h6>
        </a>
        {$date}
      </li>";
    }

    $content .= "<ul> $content_posts </ul>";

    $content = apply_filters( 'h_widget_recent_posts', $content, $args );
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  function add_acf_fields() {
    acf_add_local_field_group(array(
      'key' => 'group_5f23cb23b8652',
      'title' => 'Edje Widget - Recent Posts',
      'fields' => array(
        array(
          'key' => 'field_5f23cb2e2e2a6',
          'label' => 'Title',
          'name' => 'title',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 'Recent Posts',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5f23cb372e2a7',
          'label' => 'Number of Posts',
          'name' => 'number_of_posts',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 5,
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'min' => 1,
          'max' => '',
          'step' => 1,
        ),
        array(
          'key' => 'field_5f23cb532e2a8',
          'label' => 'Option',
          'name' => 'option',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'date' => 'Show Date?',
            'thumbnail' => 'Show Thumbnail?',
          ),
          'allow_custom' => 0,
          'default_value' => array(
            0 => 'thumbnail',
          ),
          'layout' => 'vertical',
          'toggle' => 0,
          'return_format' => 'value',
          'save_custom' => 0,
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'widget',
            'operator' => '==',
            'value' => 'h_recent_posts',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
    ));
  }
}