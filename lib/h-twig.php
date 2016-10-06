<?php
new H_Twig();
class H_Twig {

  function __construct() {
    add_filter('get_twig', array($this, 'add_to_twig') );
  }

  function add_to_twig($twig) {
    $twig->addExtension(new Twig_Extension_StringLoader() );

    // Parse Markdown
    $twig->addFilter('markdown', new Twig_Filter_Function(function($text) {
      $pd = new Parsedown();
      return $pd->text($text);
    }) );

    // Get human-friendly time
    $twig->addFilter('date_ago', new Twig_Filter_Function(function($date) {
      $date_ago = $this->get_dateago($date);
      return $date_ago;
    }) );

    // Dump all methods available in the object
    $twig->addFilter('methods', new Twig_Filter_Function(function($object) {
      var_dump(get_class_methods($object) );
    }) );

    return $twig;
  }

  /*
    Get relative datetime such as "x days ago"

    @param $ptime (str) - Raw date data from database
  */
  private function get_dateago($ptime) {
    $ptime = strtotime($ptime);
    $estimate_time = current_time('timestamp') - $ptime;

    if($estimate_time < 1) {
      return 'just now';
    }

    $condition = array(
      12 * 30 * 24 * 60 * 60  => 'year',
      30 * 24 * 60 * 60 => 'month',
      24 * 60 * 60 => 'day',
      60 * 60 => 'hour',
      60 => 'minute',
      1 => 'second'
    );

    foreach($condition as $secs => $str) {
      $d = $estimate_time / $secs;

      if($d >= 1) {
        $r = round( $d );
        return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
      }
    }
  }

}
