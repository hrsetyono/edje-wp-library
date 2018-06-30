<?php namespace h;
/*
*  Outputs extra meta tags for SEO purposes.
*/

class SEO_Profile {
  function __construct() {

    // add social link if yoast not installed
    if( !\_H::is_plugin_active('yoast') ) {
      add_filter( 'user_contactmethods', array($this, 'add_social_contactmethods'), 10, 1 );
    }
  }

  /*
    Add social media fields to user profile

    @filter user_contactmethods
  */
  public function add_social_contactmethods( $contactmethods ) {
    $contactmethods['googleplus'] = __('Google+ URL', 'h');
    $contactmethods['twitter'] = __('Twitter Username (without @)', 'h');
    $contactmethods['facebook'] = __('Facebook URL', 'h');

    return $contactmethods;
  }
}
