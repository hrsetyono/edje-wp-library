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
      $i->classes[] = 'menu-item-empty-title';
    }

    $is_child_item = $i->menu_item_parent !== '0' && $i->classes[1] == 'menu-item';
    // Change the "menu-item" class into "submenu-item" if it's a child item
    if ($is_child_item) {
      $i->classes[1] = 'submenu-item';
    }

    // Add style as extra class
    $style = get_field('style', $i);
    if ($style) {
      $i->classes[] = "menu-item-$style";
    }

    // Check for background
    if (in_array($style, ['has-background'])) {
      $bg_color = get_field('background_color', $i);
      $i->classes[] = "menu-background-{$bg_color}";
    }

    $i->title = _h_render_menu_item($i, $style);
  }

  return $items;
}

/**
 * Change the markup of the menu item
 * 
 * @param Object $i - menu item object
 * @param string $style
 * 
 * @return string - the HTML markup of the menu item
 */
function _h_render_menu_item($i, $style) {
  $title = $i->title;
  $description = H::markdown($i->post_content, true);
  $image_src = '';
  $image_alt = '';
  $bg_color = '';
  
  // Check for image
  if (in_array($style, ['has-image', 'has-icon'])) {
    $image = get_field('image', $i);

    if ($image) {
      $image_src = $style === 'has-image'
        ? $image['sizes']['medium']
        : $image['sizes']['thumbnail'];
      $image_alt = $image['alt'];
    }
  }

  ob_start(); ?>
    <?php if ($image_src): ?>
      <img src="<?= $image_src ?>" alt="<?= $image_alt ?>">
    <?php endif; ?>

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