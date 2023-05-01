<?php

add_filter('wp_nav_menu_objects', '_h_mega_menu_classes', 100);
add_filter('wp_nav_menu_objects', '_h_menu_item_classes', 101);

/**
 * Add classes to menu-item that's related to mega menu
 * 
 * @filter wp_nav_menu_objects 100
 */
function _h_mega_menu_classes($items) {
  $mega_menu_ids = []; // used to check whether a children is under mega menu or not

  foreach ($items as &$i) {
    // If parent item, check for mega menu ACF field
    if ($i->menu_item_parent === '0') {
      $style = get_field('dropdown_style', $i);
      
      if ($style === 'mega-menu' || $style === 'horizontal-menu') {  
        $columns = get_field('dropdown_columns', $i);
        $alignment = $columns < '4' ? get_field('dropdown_alignment', $i) : '';

        $i->classes[] = "{$style}-wrapper";
        $i->classes[] = "has-{$columns}-columns";
        $i->classes[] = $alignment ? "is-align-{$alignment}" : '';
      }

      if ($style === 'mega-menu') {
        $mega_menu_ids[] = $i->ID;
      }

      continue;
    }
    // If it's under mega menu
    elseif (in_array($i->menu_item_parent, $mega_menu_ids)) {
      $i->classes[] = 'mega-menu__column';
      $i->url = '';

      // remove unnecessary class
      $key = array_search('menu-item', $i->classes);
      $key2 = array_search('menu-item-has-children', $i->classes);
      
      if ($key) {
        $i->classes[$key] = '';
      }
      if ($key2) {
        $i->classes[$key2] = '';
      }
    }
  }

  return $items;
}

/**
 * Change the Menu Item markup
 * 
 * @filter wp_nav_menu_objects 101
 */
function _h_menu_item_classes($items) {
  foreach ($items as &$i) {
    // remove the "menu-item-type-xxx" and "menu-item-object-xxx" class
    $i->classes[2] = '';
    $i->classes[3] = '';

    // if has shortcode
    preg_match('/\[(.+)\]/', $i->title, $matches);
    if (isset($matches[1]) && shortcode_exists($matches[1])) {
      $i->classes[] = 'menu-item-has-shortcode';
      $i->title = '</a>' . do_shortcode($i->title) . '<a>';
      continue;
    }

    // If title is "#" or "-", replace with empty one
    switch ($i->title) {
      case '-':
        $i->title = '';
        break;

      case '#':
        $i->title = '&nbsp;';
        $i->classes[] = 'menu-item-empty-title';
        break;
    }

    // If a child item, change the "menu-item" class into "submenu-item"
    $is_child = $i->menu_item_parent !== '0' && $i->classes[1] === 'menu-item';
    if ($is_child) {
      $key = array_search('menu-item', $i->classes);
      
      if ($key) {
        $i->classes[$key] = 'submenu-item';
      }
    }
    
    // Add style as extra class
    $styles = get_field('style', $i);

    if (is_array($styles)) {
      foreach ($styles as $s) {
        $i->classes[] = "menu-item-$s";
      }

      // Check for background
      if (in_array('has-background', $styles)) {
        $bg_color = get_field('background_color', $i);
        $i->classes[] = "menu-background-{$bg_color}";
      }
    }

    // Render it
    $i->title = _h_render_menu_item($i, $styles);
  }

  return $items;
}

/**
 * Change the markup of the menu item
 * 
 * @param Object $i - menu item object
 * @param array $styles
 * 
 * @return string - the HTML markup of the menu item
 */
function _h_render_menu_item($i, $styles) {
  $title = $i->title;
  $description = H::markdown($i->post_content, true);
  $image_tag = '';

  if (is_array($styles)) {
    // Check for icon
    if (in_array('has-icon', $styles)) {
      $icon = get_field('icon', $i);

      if ($icon) {
        $src = $icon['sizes']['thumbnail'];
        $image_tag = "<img src='{$src}'>";
      }
    }

    // Check for image
    if (in_array('has-image', $styles)) {
      $image = get_field('image', $i);
      if ($image) {
        $src = $image['sizes']['medium'];
        $alt = $image['alt'];
        $image_tag = "<img src='{$src}' alt='{$alt}'>";
      }
    }
  }

  $custom_render = apply_filters('h_menu_item', '', [
    'title' => $title,
    'description' => $description,
    'image_tag' => $image_tag
  ]);

  if ($custom_render) {
    return $custom_render;
  }

  ob_start(); ?>
    <?= $image_tag ?>
    <?php if ($description): ?>
      <dt>
        <?= $title ?>
      </dt>
      <dd>
        <?= $description ?>
      </dd>
    <?php else: ?>
      <?= $title ?>
    <?php endif; ?>
  <?php

  return ob_get_clean();
}