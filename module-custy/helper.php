<?php

/**
 * Get random ID for options like Title / Divider / Condition / Tab
 * 
 * @return string
 */
function custy_rand_id() {
  return md5( time() . '-' . uniqid( wp_rand(), true ) . '-' . wp_rand() );
}


/**
 * Combine all variables from a directory
 */
function custy_combine_vars_from_dir( $dir, $single_var = 'section', $multi_var = 'sections' ) {
  $all = [];
  $files = glob( "$dir/*.php" );

  // Loop all files
  foreach( $files as $f ) {
    $item = null; $items = null; // reset
    $file_name = basename( $f, '.php' );
    
    // SKIP if first letter is underscore
    if( preg_match( '/^_/', $file_name, $matches ) ) { continue; }

    // Get variable $item or $items from file
    require $f;

    if( isset( $$single_var ) ) {
      $all[ $file_name ] = $$single_var;
    }
    elseif( isset( $$multi_var ) ) {
      $all = array_merge( $all, $$multi_var );
    }
  }

  return $all;
}


/**
 * Apply default value if missing from args
 */
function custy_parse_args( &$args, $defaults ) {
	$args = (array) $args;
	$defaults = (array) $defaults;
  $result = $defaults;
  
	foreach ( $args as $k => &$v ) {
		if ( is_array( $v ) && isset( $result[ $k ] ) ) {
			$result[ $k ] = custy_parse_args( $v, $result[ $k ] );
		} else {
			$result[ $k ] = $v;
		}
  }
  
	return $result;
}