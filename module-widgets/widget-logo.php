<?php

/**
 * Show the logo that is set in Customizer or allow overriding with own image.
 */
class H_Widget_Logo extends H_Widget { 
  function __construct() {
    parent::__construct('h_logo', __('- Logo'), [
      'description' => __('Show logo from Customizer')
    ]);
  }

  function widget($args, $instance) {
    $content = '';
    $id = $args['widget_id'];
    
    $logo = get_field('logo', "widget_$id");
    $tagline = get_field('tagline', "widget_$id");
    $tagline = $tagline ? "<span>{$tagline}</span>" : '';

    // if replace logo
    if ($logo) {
      $home_url = get_home_url();
      $image_src = $logo['sizes']['medium'];

      $logo = "<a href='{$home_url}' class='custom-logo-link' rel='home'> <img src={$image_src}> </a>";
    }
    elseif (function_exists('the_custom_logo')) {
      $logo = get_custom_logo();
    }

    // format content
    $content = $args['before_widget'] .
      "<div class='wp-block-site-logo'> {$logo} {$tagline} </div>" .
    $args['after_widget'];

    $content = apply_filters('h_widget_logo', $content, $args);
    echo $content;
  }
}