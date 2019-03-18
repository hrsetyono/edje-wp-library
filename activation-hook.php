<?php
/*
  Functions to run after plugin is activated

  You need to define EDJE variable to true in WP Config

      define( 'EDJE', true );
*/
class H_ActivationHook {
  function __construct() {
    if( defined( 'EDJE' ) ) {
      register_activation_hook( H_BASE, array($this, 'activation_hook') );
    }
  }

  function activation_hook() {
    $options = get_option('h_options');

    // create empty option if doesn't exist
    if(!$options) { add_option('h_options', array() ); }

    // if page not initialized
    if(!isset($options['init']) ) {
      $this->_create_default_page();
      $this->_create_default_post();
      $this->_set_default_setting();

      $this->_create_default_nav();

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
    Create default navigation menu
  */
  function _create_default_nav() {
    $navs = array(
      // MAIN
      array(
        'name' => 'Main Nav',
        'location' => 'main-nav',
        'items' => array(
          array(
            'menu-item-title' => 'Home',
            'menu-item-url' => home_url(),
            'menu-item-status' => 'publish'
          )
        )
      ),

      // SOCIAL
      array(
        'name' => 'Social Nav',
        'location' => 'social-nav',
        'items' => array(
          array(
            'menu-item-title' => 'facebook',
            'menu-item-url' => 'https://www.facebook.com/username',
            'menu-item-status' => 'publish'
          ),
          array(
            'menu-item-title' => 'twitter',
            'menu-item-url' => 'https://twitter.com/username',
            'menu-item-status' => 'publish'
          ),
          array(
            'menu-item-title' => 'google-plus',
            'menu-item-url' => 'https://plus.google.com/+username',
            'menu-item-status' => 'publish'
          )
        )
      ),
    );

    $locations = get_theme_mod('nav_menu_locations');

    foreach($navs as $nav):
      // var_dump($nav);
      // exit();
      // if doesn't exist AND the location isn't occupied
      if(! wp_get_nav_menu_object($nav['name'] && !has_nav_menu($nav['location'])) ) {
        // create empty menu
        $menu_id = wp_create_nav_menu($nav['name']);

        // add menu items
        foreach($nav['items'] as $item) {
          wp_update_nav_menu_item($menu_id, 0, $item);
        }

        // set the menu location
        $locations[$nav['location']] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
      }
    endforeach;

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
    update_option('thread_comments_depth', 2);

    // media
    update_option('medium_size_w', 480);
    update_option('medium_size_h', 480);

    update_option('large_size_w', 1280);
    update_option('large_size_h', 800);

    update_option('medium_large_size_w', 0);
    update_option('medium_large_size_h', 0);
  }


  /*
    Sample Blog post
  */
  private $sample_content = <<<EOD
<!-- wp:paragraph -->
<p>

You're live! Nice. We've put together a little post to introduce you to the WordPress and get you started. You can manage your content by signing in to the admin area at "your-site.com/wp-admin/". When you arrive, you can go to Posts to&nbsp;either add new post or edit existing one from the list.

</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Getting Started </h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>WordPress uses blocks to create website content. Click the (+) button and you will see available blocks. Go ahead and experiment it yourself.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Writing in the editor is really easy. In paragraph block, you will see a row of buttons above that can be used to format the content. Where appropriate, you can use <em>CTRL+I</em>&nbsp;or&nbsp;<strong>CTRL+B</strong>&nbsp;as formatting shortcut.</p>
<!-- /wp:paragraph -->

<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link" href="https://pixelstudio.id">This is a Button block</a></div>
<!-- /wp:button -->

<!-- wp:paragraph -->
<p>There's&nbsp;a List block too. For example:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul><li>Item number one</li><li>Item number two <ul><li>Press the Indent button to create nested list </li></ul></li><li>A final item</li></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Or with numbers!</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol><li>Remember to buy some milk</li><li>Drink the milk <ol><li>Make sure it's not expired</li><li>Finish in one gulp </li></ol></li><li>Tweet that I remembered to buy the milk and drank it</li></ol>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Links</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Want to link to a source? No problem. Paste in url, like <a href="https://wordpress.com/">https://wordpress.com/</a> then select it and click the Link button - it'll automatically be linked up.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You can also customise your anchor text. Here's a link to <a href="http://wordpress.org/">the WordPress website</a>. Neat.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>What about Images?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can simply drag and drop the image to this editor. Or select Image block and choose how you want to add it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Want to add <strong>caption</strong>? That's easy too. Click on the Image block and you will see "Write Caption" field below.</p>
<!-- /wp:paragraph -->

<!-- wp:image -->
<figure class="wp-block-image"><img src="https://picsum.photos/800/400" alt=""/><figcaption>This is a caption</figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3>Quoting</h3>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>Wisdomous - it's definitely a word.</p></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p>Sometimes a link isn't enough, you want to quote someone on what they've said. It was probably very wisdomous. Is wisdomous a word? Find out in a future release when we introduce spellcheck! For now - it's definitely a word.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Ready for a Break?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Select Separator block and you've got yourself a fancy new divider. Aw yeah.</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2>Gallery</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Select Gallery block and choose the images. Then click the block and you can configure it from the sidebar</p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"columns":3,"linkTo":"media"} -->
<ul class="wp-block-gallery columns-3 is-cropped"><li class="blocks-gallery-item"><figure><a href="https://picsum.photos/800/600?image=1037"><img src="https://picsum.photos/600/400?image=1037" alt="" data-id="504"  class="wp-image-504"/></a></figure></li><li class="blocks-gallery-item"><figure><a href="https://picsum.photos/800/600?image=1061"><img src="https://picsum.photos/600/400?image=1061" alt="" data-id="506" class="wp-image-506"/></a></figure></li><li class="blocks-gallery-item"><figure><a href="https://picsum.photos/800/600?image=1036"><img src="https://picsum.photos/600/400?image=1036" alt="" data-id="507" class="wp-image-507"/></a></figure></li><li class="blocks-gallery-item"><figure><a href="https://picsum.photos/800/600?image=1043"><img src="https://picsum.photos/600/400?image=1043" alt="" data-id="505" class="wp-image-505"/></a></figure></li></ul>
<!-- /wp:gallery -->

<!-- wp:heading -->
<h2>Columns Layout</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns has-2-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image -->
<figure class="wp-block-image"><img src="https://picsum.photos/300/400" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p>Columns is a tidy way to place image on the left or right.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Currently it only supports same size column, but you can kinda customize it by adding CSS Class in Advanced tab.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>

That should be enough to get you started. Have fun - and let us know what you think :)

</p>
<!-- /wp:paragraph -->
EOD;

}
