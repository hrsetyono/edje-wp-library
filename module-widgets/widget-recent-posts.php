<?php

/**
 * 
 */
class H_WidgetRecentPosts extends H_Widget { 
  function __construct() {
    parent::__construct('h_recent_posts', __('- Recent Posts'), [
      'description' => __('Show latest posts')
    ]);
  }

  function widget($args, $instance) {
    $widget_id = 'widget_' . $args['widget_id'];
    $data = [
      'widget_id' => $widget_id,
      'number_of_posts' => get_field('number_of_posts', $widget_id),
      'style' => get_field('style', $widget_id),
      'posts' => [],

      'before_title' => $args['before_title'],
      'after_title' => $args['after_title'],
      'title' => get_field('title', $widget_id),
    ];

    // get posts
    $posts = get_posts([
      'posts_per_page' => $data['number_of_posts'],
      'suppress_filters' => false, // WPML support
    ]);

    $style = $data['style'];

    // loop through posts to append data
    $data['posts'] = array_map(function($p) use ($style) {
      $p->permalink = get_permalink($p);

      if (in_array('show_thumbnail', $style)) {
        $thumbnail_src = get_the_post_thumbnail_url($p, 'thumbnail');
        $p->thumbnail_src = $thumbnail_src ? $thumbnail_src : null;
      }

      if (in_array('show_date', $style)) {
        $p->date = get_the_date('', $p);
      }

      if (in_array('show_author', $style)) {
        $p->author_name = get_the_author_meta('display_name', $p->post_author);
      }

      return $p;
    }, $posts);

    $custom_render = apply_filters('h_widget_recent_posts', '', $data);

    echo $args['before_widget'];
    echo $custom_render ? $custom_render : $this->render_widget($data);
    echo $args['after_widget'];
  }

  function render_widget($data) {
    [
      'posts' => $posts,
      'before_title' => $before_title,
      'after_title' => $after_title,
      'title' => $title,
    ] = $data;
    ob_start(); ?>

    <ul class="wp-block-latest-posts__list columns-1 wp-block-latest-posts">
      <?php if ($title): ?>
        <?= $before_title ?>
          <?= $title ?>
        <?= $after_title ?>  
      <?php endif; ?>
      
      <?php foreach ($posts as $p): ?>
        <li>
          <?php if ($p->thumbnail_src): ?>
            <div class='wp-block-latest-posts__featured-image alignright'>
              <a href="<?= $p->permalink ?>">
                <img src="<?= $p->thumbnail_src ?>">
              </a>
            </div>
          <?php endif; ?>

          <a href="<?= $p->permalink ?>">
            <?= $p->post_title ?>
          </a>
          
          <?php if ($p->author_name ): ?>
            <div class="wp-block-latest-posts__post-author">
              <?= $p->author_name ?>
            </div>
          <?php endif; ?>

          <?php if ($p->date): ?>
            <time class="wp-block-latest-posts__post-date">
              <?= $p->date ?>
            </time>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php return ob_get_clean();
  }
}