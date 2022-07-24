<?php
/**
 * Send email whenever someone reply to your comment
 */

if (!class_exists('H_CommentReply')) {

class H_CommentReply {
  private $settings;

  function __construct() {
    $this->settings = apply_filters('h_reply_email_settings', [
      'label' => __('Notify me of follow-up comments by email.'),
      'checked' => true,

      'mail_subject' => 'Your comment at {{site_title}} has a new reply!',
      'mail_body' => 'Hi {{author}},

      There\'s a new reply to your comment over on <a href="{{post_url}}">"{{post_title}}"</a>.
      
      As a reminder, here\'s your original comment on the post:
      
      <blockquote>{{content}}</blockquote>

      And here\'s the new reply from {{reply_author}}:

      <blockquote>{{reply_content}}</blockquote>

      <a href="{{post_url}}">Visit the article</a> to continue the conversation.

      Regards,
      - {{site_title}} Admin',
    ]);
    
    add_filter('comment_form_defaults', [$this, 'add_notification_option']);

    add_action('comment_post', [$this, 'save_notification_option'], 10, 3);
    add_action('comment_post', [$this, 'send_notification'], 10, 3);
  }


  /**
   * Add a checkbox to have email notification on reply
   * 
   * @filter comment_form_defaults
   */
  function add_notification_option($defaults) {
    $label = $this->settings['label'];
    $is_checked = $this->settings['checked'] ? 'checked' : '';

    $checkbox = "<p class='h-comment-notification-consent'><input id='wp-notification-consent' name='wp-notification-consent' type='checkbox' $is_checked><label for='wp-notification-consent'> $label </label></p>";

    $defaults['comment_notes_after'] .= $checkbox;
    return $defaults;
  }


  /**
   * Add option to disable/enable notification. Will be saved into comment_karma column (1 means they accept).
   * 
   * @action comment_post
   */
  function save_notification_option($comment_id, $comment_approved, $comment_data) {
    if ($comment_approved === 'spam') { return; }
    
    if (isset( $_POST['wp-notification-consent']) && $_POST['wp-notification-consent'] === 'on')  {
      wp_update_comment([
        'comment_ID' => $comment_id,
        'comment_karma' => 1
      ]);
    }
  }


  /**
   * Send notification to the parent comment if notification is enabled.
   * 
   * @action comment_post
   */
  function send_notification($comment_id, $comment_approved, $comment_data) {
    if ($comment_approved === 'spam') { return; }

    // if posting a child comment
    if ($comment_data['comment_parent'] > 0) {
      $parent = (array) get_comment( $comment_data['comment_parent'] );

      // if notification is enabled, send email
      if ($parent['comment_karma'] === '1') {
        
        $to = $parent['comment_author_email'];
        $subject = $this->get_mail_subject($parent, $comment_data);
        $body = $this->get_mail_body($parent, $comment_data);

        // create From & Reply-to
        $sender = $comment_data['comment_author'];
        $sender_email = $comment_data['comment_author_email'];
        preg_match('/[^\.\/]+\.[^\.\/]+$/', $_SERVER['SERVER_NAME'], $domain );

        $headers = [
          'Content-Type: text/html; charset=UTF-8',
          "From: no-reply@{$domain[0]}",
          "Reply-To: $sender <$sender_email>"
        ];

        wp_mail($to, $subject, wpautop($body), $headers);
      }
    }
  }


  /////


  /**
   * Create the email subject for reply notification
   * 
   * @param array $parent - Comment replied to
   * @param array $reply - The reply comment
   * 
   * @return string
   */
  private function get_mail_subject($parent, $reply) {
    $template = $this->settings['mail_subject'];

    $subject = str_replace([
      '{{site_title}}',
      '{{post_title}}'
    ], [
      get_bloginfo('name'),
      get_the_title($reply['comment_post_ID'])
    ] , $template);

    return $subject;
  }


  /**
   * Create the mail message for reply notification
   * 
   * @param array $parent - Comment replied to
   * @param WP_Comment $reply - The reply comment
   * 
   * @return string
   */
  private function get_mail_body($parent, $reply) {
    $template = $this->settings['mail_body'];
    $date_format = get_option('date_format');

    $body = str_replace([
      '{{site_title}}',
      '{{site_url}}',

      '{{post_title}}',
      '{{post_url}}',

      '{{date}}',
      '{{content}}',
      '{{author}}',

      '{{reply_date}}',
      '{{reply_content}}',
      '{{reply_author}}'
    ], [
      get_bloginfo('name'),
      get_bloginfo('url'),

      get_the_title($reply['comment_post_ID']),
      get_the_permalink($reply['comment_post_ID']),

      mysql2date($date_format, $parent['comment_date']),
      $parent['comment_content'],
      $parent['comment_author'],

      mysql2date($date_format, $reply['comment_date']),
      $reply['comment_content'],
      $reply['comment_author'],
    ], $template);

    return $body;
  }
}


new H_CommentReply();
}