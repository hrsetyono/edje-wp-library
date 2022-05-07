<?php
/**
 * Modify anything related to SEO, including redirection
 */

// remove extra rss
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Disable Jetpack SEO
add_filter('jetpack_enable_open_graph', '__return_false');

add_filter('redirect_canonical', '_h_prevent_url_guessing');



/**
 * Prevent URL guessing
 * @filter redirect_canonical
 */
function _h_prevent_url_guessing($url) {
  if (is_404()) { return; }
  return $url;
}
