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
      $columns = get_field('mega_menu', $i);

      if ($columns) {
        $i->classes[] = "h-mega-menu";
        $i->classes[] = "h-mega-menu-$columns-columns";
        $mega_menu_ids[] = $i->ID;
      }

      continue;
    }
    // Add special class if it's under mega menu
    elseif (in_array($i->menu_item_parent, $mega_menu_ids)) {
      $i->classes[] = 'h-mega-menu__column';

      // remove "has-children" class
      $key = array_search('menu-item-has-children', $i->classes);
      $i->classes[$key] = '';
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

    // If title is "-", add empty class so it can be hidden
    if ($i->title === '-') {
      $i->title = '&nbsp;';
      // $i->classes[] = 'menu-item-empty-title';
    }

    $is_child_item = $i->menu_item_parent !== '0' && $i->classes[1] == 'menu-item';
    // Change the "menu-item" class into "submenu-item" if it's a child item
    if ($is_child_item) {
      $i->classes[1] = 'submenu-item';
    }

    // Add style as extra class
    $styles = get_field('style', $i);
    foreach ($styles as $s) {
      $i->classes[] = "menu-item-$s";
    }

    // Check for background
    if (in_array('has-background', $styles)) {
      $bg_color = get_field('background_color', $i);
      $i->classes[] = "menu-background-{$bg_color}";
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