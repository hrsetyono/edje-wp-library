<?php
/**
 * Modify Jetpack modules
 */

// disable jetpack css
add_filter('jetpack_implode_frontend_css', '__return_false');

//
add_action('wp_head', '_h_remove_jetpack_head_assets', 2);
add_action('wp_footer', '_h_remove_jetpack_footer_assets');

add_action('init', '_h_remove_jetpack_share_buttons', 999);
add_filter('wp', '_h_remove_jetpack_share_buttons', 20);

// Add SVG logo to sharing button
add_filter('jetpack_sharing_display_text', '_h_jetpack_share_add_svg', 10, 2);
add_filter('jetpack_sharing_display_title', '_h_jetpack_share_add_color', 10, 2);
add_filter('jetpack_sharing_display_link', '_h_jetpack_share_add_print_listener', 10, 2);




/**
 * Remove redundant Jetpack's JS and CSS from Head
 * @action wp_head 2
 */
function _h_remove_jetpack_head_assets() {
  wp_dequeue_script('devicepx');
  wp_dequeue_style('sharedaddy');
  wp_dequeue_style('social-logos');
}

/**
 * Remove redundant Jetpack's JS and CSS from Footer
 * @action wp_footer
 */
function _h_remove_jetpack_footer_assets() {
  wp_deregister_script('sharing-js');

  // disable spinner when infinite loading is enabled
  wp_deregister_script('jquery.spin');
  wp_deregister_script('spin');
}


/**
 * Remove Jetpack Related Post from default position. To be added manually with shortcode [h-related-posts].
 * @filter wp
 */
function _h_remove_jetpack_related_posts() {
  if (class_exists('Jetpack_RelatedPosts')) {
    $jprp = Jetpack_RelatedPosts::init();
    $callback = [$jprp, 'filter_add_target_to_dom'];
    remove_filter('the_content', $callback, 40);
  }
}

  

/**
 * Remove default placement of sharing buttons. To be added manually with shortcode [h-jetpack-sharing].
 * @action loop_start
 */
function _h_remove_jetpack_share_buttons() {
  remove_filter('the_content', 'sharing_display', 19);
  remove_filter('the_excerpt', 'sharing_display', 19);

  if (class_exists('Jetpack_Likes')) {
    remove_filter('the_content', [Jetpack_Likes::init(), 'post_likes'], 30, 1);
  }
}


/**
 * Add SVG icon before the text
 * 
 * @filter jetpack_sharing_display_text
 * 
 * @param string $text - The text shown
 * @param object $share - Sharing object
 */
function _h_jetpack_share_add_svg($text, $share) {
  // No need for icon if style is Text Only
  if ($share->button_style === 'text') {
    return $text;
  }

  $slug = $share->shortname;

  if ($slug === 'jetpack-whatsapp') {
    $slug = 'whatsapp';
  }

  // if print, use this svg icon because it's not in the list
  if ($slug == 'print') {
    $svg = '<svg width="20px" height="20px" viewBox="0 0 512 512"><path d="M400 264c-13.25 0-24 10.74-24 24 0 13.25 10.75 24 24 24s24-10.75 24-24c0-13.26-10.75-24-24-24zm32-88V99.88c0-12.73-5.06-24.94-14.06-33.94l-51.88-51.88c-9-9-21.21-14.06-33.94-14.06H110.48C93.64 0 80 14.33 80 32v144c-44.18 0-80 35.82-80 80v128c0 8.84 7.16 16 16 16h64v96c0 8.84 7.16 16 16 16h320c8.84 0 16-7.16 16-16v-96h64c8.84 0 16-7.16 16-16V256c0-44.18-35.82-80-80-80zM128 48h192v48c0 8.84 7.16 16 16 16h48v64H128V48zm256 416H128v-64h256v64zm80-112H48v-96c0-17.64 14.36-32 32-32h352c17.64 0 32 14.36 32 32v96z"/></svg>';
  }
  else {
    $social = H::get_social_icon($slug);
    $svg = $social['svg'];
  }

  return "$svg <b>$text</b>";
}


/**
 * Add new 'style' attribute containing --color variable
 * 
 * @filter jetpack_sharing_display_title
 */
function _h_jetpack_share_add_color($title, $share) {
  $slug = $share->shortname;

  if ($slug === 'jetpack-whatsapp') {
    $slug = 'whatsapp';
  }

  if ($slug === 'print') {
    return $title;
  }

  $social = H::get_social_icon($slug);
  $color = $social['color'];

  return "$title\" style=\"--color: $color;";
}


/**
 * Add onclick event on Print share button
 * 
 * @filter jetpack_sharing_display_link
 */
function _h_jetpack_share_add_print_listener($url, $share) {
  if ($share->shortname === 'print') {
    $url = '#print';
    return "$url\" onclick=\"window.print();";
  }

  return $url;
}