<?php

/*
  When this plugin is activated, run this function
*/
register_activation_hook(H_PLUGIN_DIR, '_h_activate');
function _h_activate() {
  if(!get_option('h_initialized') ) {
    add_option('h_initialized', false);

    _h_create_default_page();
    _h_set_default_setting();

    update_option('h_initialized', true);
  }
}

/*
  Create default page for HOME and BLOG
*/
function _h_create_default_page() {
  $home = array(
    'post_title' => 'Home',
    'post_type' => 'page',
    'post_status' => 'publish',
    'post_author' => 1,
  );

  $blog = array(
    'post_title' => 'Blog',
    'post_type' => 'page',
    'post_status' => 'publish',
    'post_author' => 1,
  );

  $home_id = wp_insert_post($home);
  $blog_id = wp_insert_post($blog);

  // change page setting
  update_option('show_on_front', 'page');
  update_option('page_on_front', $home_id);
  update_option('page_for_posts', $blog_id);
}

/*
  Default setting for Standard website
*/
function _h_set_default_setting() {
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
