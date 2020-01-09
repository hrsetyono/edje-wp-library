<?php

/**
 * Output a toggle button to show list of CSS Variables.
 */
function my_css_desc( $vars, $extra_text = '' ) {
  $content = '';

  if( count( $vars ) > 0 ) {
    $content = '<code>' . implode( '</code><code>', $vars ) . '</code>';
  }
 
  return "<details>
    <summary>CSS</summary>
    $content
    $extra_text
  </details>";
}

/**
 * Option key for title
 */
function h_option_title() {
  return 'title/' . blocksy_rand_md5();
}

/**
 * Option key for divider
 */
function h_option_divider() {
  return 'divider/' . blocksy_rand_md5();
}

/**
 * Option key for tab
 */
function h_option_tab( $title ) {
  return "tab/{$title}/" . blocksy_rand_md5();
}


/**
 * Output notice in description field
 */
function my_css_notice( $text ) {
  return "<div class='notice'> <p>$text</p> </div>";
}


/**
 * Get all units and override some if any
 */
function my_get_all_units( $override = [] ) {
  $units = [
		'px' => [ 'min' => 0, 'max' => 40 ],
		'em' => [ 'min' => 0, 'max' => 30 ],
		'%' => [ 'min' => 0, 'max' => 100 ],
		'vw' => [ 'min' => 0, 'max' => 100 ],
		'vh' => [	'min' => 0, 'max' => 100 ],
		'pt' => [ 'min' => 0, 'max' => 100 ],
		'rem' => [ 'min' => 0, 'max' => 30 ],
	];

	foreach ( $override as $key => $value ) {
    $units[ $key ] = $value;
	}

	return $units;
}