<?php
class H_PostAction {
  private $post_type;
  private $actions;

  private $redirect_uri;

  public function __construct($post_type, $actions) {
    $this->post_type = $post_type;
    $this->actions = $actions;
  }

  public function add() {
    if(!is_admin()) { return false; }

    add_filter('post_row_actions', array($this, '_add_row_actions'), null, 2);
    $this->_add_hooks();
  }

  public function replace() {
    if(!is_admin()) { return false; }

    add_filter('post_row_actions', array($this, '_replace_row_actions'), null, 2);
    $this->_add_hooks();
  }

  /////

  /*
    Add new row actions on top of default one.

    @param $actions (array) - Existing actions
    @param $post (wp_post)

    @return (array) - Actions with new link(s) added.
  */
  function _add_row_actions($actions, $post) {
    $valid = $post->post_type === $this->post_type && $post->post_status !== 'trash';
    if($valid) {
      $args = $this->_parse_for_actions($actions, $post);

      foreach($args as $slug => $value) {
        $actions[$slug] = $value['content'];
      }
    }

    return $actions;
  }

  /*
    Replace row actions

    @param $actions (array) - Existing actions
    @param $post (wp_post)

    @return (array) - New replaced actions
  */
  function _replace_row_actions($actions, $post) {
    $valid = $post->post_type === $this->post_type && $post->post_status !== 'trash';
    if($valid) {
      $args = $this->_parse_for_actions($actions, $post);

      // since it's replacing, start from clean array
      $actions = array();
      foreach($args as $slug => $value) {
        $actions[$slug] = $value['content'];
      }
    }

    return $actions;
  }


  private function _add_hooks() {
    $args = $this->_parse_for_hooks();
    foreach($args as $name => $callback) {

      // admin_action_xxx can be called by passing in admin_url with the param ?action=xxx
      add_action('admin_action_' . $name, function() use ($callback) {
        $post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post'];
        $redirect_uri = isset($_GET['redirect_uri']) ? $_GET['redirect_uri'] : '';

        $callback($post_id);
        wp_redirect(admin_url($redirect_uri, 'http'), 301);
      });
    }
  }

  /*
    Format the arguments for Hooks creation
  */
  private function _parse_for_hooks() {
    $args = array();
    $actions = $this->actions;

    foreach($actions as $key => $value) {
      if(is_callable($value) && is_null($value(null)) ) {
        $name = 'h_action_' . $key;
        $args[$name] = $value;
      }
    }

    return $args;
  }

  /*
    Format the passed arguments for Row action creation.
  */
  private function _parse_for_actions($actions, $post) {
    $args = array();
    $new_actions = $this->actions;

    foreach($new_actions as $key => $value) {
      $slug = is_int($key) ? $value : $key;
      $title = H_Elper::to_title($slug);

      switch($slug) {
        case 'view':
        case 'edit':
        case 'trash':
          $content = $actions[$slug];
          break;

        case 'quickedit':
        case 'quick_edit':
          $content = $actions['inline hide-if-no-js'];
          break;

        default:
          // if a function AND return null
          if(is_callable($value) && is_null($value(null)) ) {
            $redirect_uri = $this->_get_redirect_uri();

            $action_name = "h_action_{$slug}";
            $href = admin_url("?action={$action_name}&post={$post->ID}&redirect_uri={$redirect_uri}");

            $content = "<a href='{$href}'>{$title}</a>";
          }
          else {
            $href = $value($post->ID);
            $content = "<a href='{$href}'>{$title}</a>";
          }
      }

      $args[$slug] = array('title' => $title, 'content' => $content);
    }

    return $args;
  }

  /*
    Get redirect URI after clicking
  */
  private function _get_redirect_uri() {
    $paged = isset($_GET['paged']) ? $_GET['paged'] : '';
    $uri = "edit.php?post_type={$this->post_type}";

    if($paged) {
      $uri .= "&paged={$paged}";
    }

    return $uri;
  }
} // class
