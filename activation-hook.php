<?php

class H_ActivationHook {
  /**
   * Run when the plugin is activated
   */
  function on_activation() {
    $options = get_option('h_options');

    // create empty option if doesn't exist
    if (!$options) {
      add_option('h_options', []);
    }

    // If first time activation
    if (!isset($options['init'])) {
      $this->_create_frontpage();
      $this->_create_blogpage();
      $this->_set_default_setting();

      $options['init'] = true;
    }

    update_option('h_options', $options);
  }

  /**
   * Run when the plugin is deactivated
   */
  function deactivation_hook() {

  }

  /////

  /**
   * Create default Frontpage
   */
  private function _create_frontpage() {
    $frontpage_id = get_option('page_on_front');

    // if already exists, just change the title
    if ($frontpage_id) {
      $args = [
        'ID' => $frontpage_id,
        'post_title' => get_bloginfo()
      ];

      wp_update_post($args);
    }
    // if does not exists, create it
    else {
      $home = [
        'post_title' => get_bloginfo(),
        'post_type' => 'page',
        'post_status' => 'publish',
      ];

      $home_id = wp_insert_post($home);
      update_option('show_on_front', 'page');
      update_option('page_on_front', $home_id);
    }
  }

  /**
   * Create default Blog page
   */
  private function _create_blogpage() {
    $blogpage_id = get_option('page_for_posts');

    // If does not exists, create one
    if (!$blogpage_id) {
      $blog = [
        'post_title' => 'Blog',
        'post_type' => 'page',
        'post_status' => 'publish',
      ];

      $blog_id = wp_insert_post($blog);
      update_option('page_for_posts', $blog_id);
    }
  }

  /**
   * Default setting for Standard website
   */
  private function _set_default_setting() {
    // general
    update_option('use_smiles', 0);

    // discussion
    update_option('default_comment_status', 'closed');
    update_option('thread_comments_depth', 2);

    // media
    update_option('medium_size_w', 480);
    update_option('medium_size_h', 480);

    update_option('large_size_w', 1120);
    update_option('large_size_h', 800);

    update_option('medium_large_size_w', 0);
    update_option('medium_large_size_h', 0);
  }
}
