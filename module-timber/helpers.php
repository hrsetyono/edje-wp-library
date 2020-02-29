<?php

/**
 * Get TimberMenu object using ID
 */
function h_get_timber_menu( $menu_id ) {
  return new Timber\Menu( $menu_id );
}