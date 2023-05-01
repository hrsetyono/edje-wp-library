import './h-menu-admin.sass';

const myMenu = {
  init() {
    if (!window.wpNavMenu) { return; }

    this.styleListener();
    this.depthChangeListener();

    // limit nav menu depth to 3rd level
    window.wpNavMenu.options.globalMaxDepth = 2;
  },

  /**
   * When megamenu columns is selected, add/remove class from it's children accordingly
   */
  styleListener() {
    const $toggles = document.querySelectorAll('.acf-field[data-name="dropdown_style"] input[type="radio"]');

    // add listener
    $toggles.forEach(($t) => {
      $t.addEventListener('click', (e) => {
        const $wrapper = e.currentTarget.closest('.menu-item');

        // need timeout to wait for ACF listener
        setTimeout(() => {
          this.megaMenuAddClasses($wrapper);
        });
      });
    });

    // activate mega menu classes on load
    const $parentItems = document.querySelectorAll('.menu-item.menu-item-depth-0');
    $parentItems.forEach(($i) => {
      this.megaMenuAddClasses($i);
    });
  },

  /**
   * When depth changed, check if it's under mega menu and add/remove class accordingly
   */
  depthChangeListener() {
    const $menu = document.querySelector('.menu');
    $menu.addEventListener('mouseup', (e) => {
      const $target = e.target.classList.contains('menu-item') ? e.target : e.target.closest('.menu-item');
      if (!$target) { return; }

      // wait until the class is changed
      setTimeout(() => {
        const $prevItem = $target.previousElementSibling;
        const isUnderMegaMenu = $prevItem.classList.contains('h-mega-menu__child') || $prevItem.classList.contains('h-mega-menu');
        if (this.isChildItem($target) && isUnderMegaMenu) {
          $target.classList.add('h-mega-menu__child');
        } else {
          $target.classList.remove('h-mega-menu__child');
        }
      });
    });
  },

  /**
   * Check whether current item and all its children need mega menu classes
   *
   * @param $item - `.menu-item` DOM object in the Appearance > Menu page.
   */
  megaMenuAddClasses($item) {
    const $checkedOption = $item.querySelector('[data-name="dropdown_style"] input[type="radio"]:checked');
    const $children = [];

    let $currentItem = $item;

    // loop to get all children
    while (true) {
      const $nextItem = $currentItem.nextElementSibling;

      // Abort if no more next element
      if (!$nextItem) { break; }

      const isChildItem = this.isChildItem($nextItem);

      if (isChildItem) {
        $children.push($nextItem);
      } else {
        break; // abort if no more child item
      }

      $currentItem = $nextItem;
    }

    // if have checked option, add mega menu classes
    if ($checkedOption.value === 'mega-menu') {
      $item.classList.add('h-mega-menu');

      $children.forEach(($c) => {
        $c.classList.add('h-mega-menu__child');
      });
    } else { // if unchecked, remove mega menu classes
      $item.classList.remove('h-mega-menu');

      $children.forEach(($c) => {
        $c.classList.remove('h-mega-menu__child');
      });
    }
  },

  /**
   * Check if a DOM object is a child menu item
   */
  isChildItem($item) {
    return $item.classList.contains('menu-item-depth-1') || $item.classList.contains('menu-item-depth-2');
  },
};

function onReady() {
  myMenu.init();
}

function onLoad() {
  // script that runs when everything is loaded
}

document.addEventListener('DOMContentLoaded', onReady);
window.addEventListener('load', onLoad);
