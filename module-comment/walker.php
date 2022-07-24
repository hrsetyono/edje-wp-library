<?php
/**
 * Slightly customize the comment HTML markup to make styling easier
 */
class H_WalkerComment extends Walker_Comment {
  /**
   * Ref: https://developer.wordpress.org/reference/classes/walker_comment/
   */
  protected function html5_comment($comment, $depth, $args) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    $commenter = wp_get_current_commenter();
    $comment_author = get_comment_author($comment);
    $avatar = $args['avatar_size'] != 0 ? get_avatar($comment, $args['avatar_size']) : '';
    $comment_date = human_time_diff( 
      get_comment_date('U', $comment), 
      current_time('timestamp') 
    );

    $show_pending_links = ! empty($commenter['comment_author']);

    if ($commenter['comment_author_email']) {
      $moderation_note = __('Your comment is awaiting moderation.');
    } else {
      $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
    }
    ?>
    <<?= $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
      <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
          <?= $avatar; ?>
          <b>
            <?= $comment_author; ?>
          </b>
          <time>
            <?= $comment_date . ' ' . __('ago'); ?>
          </time>
          <br>
          <?php
          if ('1' == $comment->comment_approved || $show_pending_links) {
            comment_reply_link(array_merge(
              $args,
              [
                'add_below' => 'div-comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
              ]
            ));
          }
          ?>
          <?= edit_comment_link( __( 'Edit' )); ?>
        </footer>
        
        <?php if ('0' == $comment->comment_approved): ?>
          <p class="comment-awaiting-moderation">
            <?= $moderation_note; ?>
          </p>
        <?php endif; ?>

        <div class="comment-content">
          <?php comment_text(); ?>
        </div>
      </article>
    <?php
  }
}