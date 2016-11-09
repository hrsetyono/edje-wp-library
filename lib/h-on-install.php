<?php

new H_Install();
class H_Install {

  function __construct() {
    register_activation_hook(H_DIR, array($this, 'activation_hook') );
  }

  function activation_hook() {
    $options = get_option('h_options');

    // create empty option if doesn't exist
    if(!$options) { add_option('h_options', array() ); }

    // if page not initialized
    if(!isset($options['init']) ) {
      $this->_create_default_page();
      // $this->_create_default_post();
      $this->_set_default_setting();

      $options['init'] = true;
    }

    // if post not initialized
    if(!isset($options['post_init']) ) {
      $this->_create_default_post();

      $options['post_init'] = true;
    }

    update_option('h_options', $options);
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
      );

      $blog_id = wp_insert_post($blog);
      update_option('page_for_posts', $blog_id);
    }
  }

  /*
    Create sample post that also acts as guide to WordPress
  */
  function _create_default_post() {
    $args = array(
      'post_title' => 'Welcome to WordPress',
      'post_name' => 'welcome-to-wordpress',
      'post_type' => 'post',
      'post_content' => $this->sample_content,
      'post_status' => 'publish'
    );

    // if post ID 1 exist
    if(is_string(get_post_status(1)) ) {
      $args['ID'] = 1;
      wp_update_post($args);
    }
    else {
      $args['import_id'] = 1;
      wp_insert_post($args);
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
    update_option('medium_size_w', 480);
    update_option('medium_size_h', 480);

    update_option('large_size_w', 1280);
    update_option('large_size_h', 1280);

    update_option('medium_large_size_w', 0);
    update_option('medium_large_size_h', 0);
  }


  /*
    Sample Blog post
  */
  private $sample_content = <<<EOD
  You're live! Nice. We've put together a little post to introduce you to the WordPress and get you started. You can manage your content by signing in to the admin area at "your-site.com/wp-admin/". When you arrive, you can go to Posts to either add new post or edit existing one from the list.
<h2>Getting Started</h2>
WordPress uses a text editor which is similar to the one in MS Word. Essentially, it's a user-friendly way to manage your post formatting as you write!

Writing in the editor is really easy. In the panel above, you will see a row of buttons that can be used to format the content. Where appropriate, you can use <i>CTRL+I</i> or <strong>CTRL+B</strong> as formatting shortcut.

There's a list feature too. For example:
<ul>
 	<li>Item number one</li>
 	<li>Item number two
<ul>
 	<li>Press Tab to create nested list</li>
</ul>
</li>
 	<li>A final item</li>
</ul>
or with numbers!
<ol>
 	<li>Remember to buy some milk</li>
 	<li>Drink the milk
<ol>
 	<li>Make sure it's not expired</li>
 	<li>Finish in one gulp</li>
</ol>
</li>
 	<li>Tweet that I remembered to buy the milk, and drank it</li>
</ol>
<h3>Links</h3>
Want to link to a source? No problem. Paste in url, like <a href="http://wordpress.org/">http://wordpress.org</a> then click the Link button - it'll automatically be linked up. But if you want to customise your anchor text, you can do that too! Here's a link to <a href="http://wordpress.org/">the WordPress website</a>. Neat.
<h3>What about Images?</h3>
Images work too! Click "Add Media" button which is above the buttons row. Simply drag-and-drop the image from your PC to the popup box.

Want to add <strong>caption</strong>? That's easy too. Click on the image then click the Pencil icon, you'll find the Caption field in the popup box.

[caption id="" align="alignnone" width="800"]<img src="http://cdn.setyono.net/edjewp/sample-image.jpg" alt="Help Google recognize what this image is" width="800" height="400" /> This is a caption![/caption]
<h3>Quoting</h3>
<blockquote>Wisdomous - it's definitely a word.</blockquote>
Sometimes a link isn't enough, you want to quote someone on what they've said. It was probably very wisdomous. Is wisdomous a word? Find out in a future release when we introduce spellcheck! For now - it's definitely a word.
<h3>Ready for a Break?</h3>
Click the Line (-) button and you've got yourself a fancy new divider. Aw yeah.

<hr />

<h3>Advanced Usage</h3>
Coming Soon...

That should be enough to get you started. Have fun - and let us know what you think :)
EOD;

}
