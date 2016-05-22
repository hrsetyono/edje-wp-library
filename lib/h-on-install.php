<?php

class H_Install {

  function __construct() {
    register_activation_hook(H_PLUGIN_DIR, array($this, 'activation_hook') );
  }

  function activation_hook() {
    $options = get_option('h_options');

    // if haven't been initialized
    if(! isset($options['init']) ) {
      $this->_create_default_page();
      $this->_set_default_setting();

      add_option('h_options', array('init' => true) );
    }
  }

  /*
    Create default page for HOME and BLOG
  */
  function _create_default_page() {
    $frontpage_id = get_option('page_on_front');
    $blogpage_id = get_option('page_for_posts');

    // if already exists, just change the title
    if($frontpage_id) {
      $args = array(
        'ID' => $frontpage_id,
        'post_title' => get_bloginfo()
      );

      wp_update_post($args);
    }
    // if not exists, create it
    else {
      $home = array(
        'post_title' => get_bloginfo(),
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_author' => 1,
      );

      $home_id = wp_insert_post($home);
      update_option('show_on_front', 'page');
      update_option('page_on_front', $home_id);
    }

    // create posts page if not set
    if(!$blogpage_id) {
      $blog = array(
        'post_title' => 'Blog',
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_author' => 1,
      );

      $blog_id = wp_insert_post($blog);
      update_option('page_for_posts', $blog_id);
    }
  }

  /*
    Default setting for Standard website
  */
  function _set_default_setting() {
    // general
    update_option('use_smiles', 0);

    // discussion
    update_option('default_comment_status', 'closed');

    // media
    update_option('medium_size_w', 0);
    update_option('medium_size_h', 0);

    update_option('large_size_w', 0);
    update_option('large_size_h', 0);

    update_option('medium_large_size_w', 0);
    update_option('medium_large_size_h', 0);
  }

}
