## 0.9.4

- Update deprecated Twig Helper so it won't show warning.

## 0.9.3

- [Default] Fixed some actions not running due to misplacement.

## 0.9.2

- [Customizer] Fixed crash due to Namespacing
- [Customizer] Added `background_color` theme mod to Site Identity tab.
- [MetaTag] Added `theme_color` meta tag if `background_color` theme mod is filled.

## 0.9.1

- [Column] Added `H::add_column()` for appending a column with new `>` symbol for positioning. [Read more](https://github.com/hrsetyono/wp-edje/wiki/Table-Columns).
- [Column] Renamed `H::register_columns()` to `H::override_columns()`. The prior now become the alias of the latter.

## 0.9.0

- New feature! Integration with [WP Edje Web-Push](https://github.com/hrsetyono/wp-edje-web-push)
- [CPT] Refactor CPT Column code.

## 0.8.2

- Namespaced all modules with "h". No changes needed on Theme code.

## 0.8.1

- Fixed Fatal error due to class not found.

## 0.8.0

- Organize files into module directory. Preparation to have Jetpack-like setting page.

## 0.7.2

- [CSS] Version string is removed to get better score at Pingdom


## 0.7.1

- [Customizer] Wrap the setting with ID selector to show pencil icon. Example: setting name is `phone_no`, so add `id="phone_no"` to the wrapper.

## 0.7.0

- [CPT] Support `rest-api` will create endpoint with the slug at its base URL.
- [CPT] Added support `hidden` that will hide single post view.
- [Customizer] NEW FEATURE! Check out the [wiki for detail](https://github.com/hrsetyono/wp-edje/wiki/Customizer)

## 0.6.3

- [CPT] Fixed `supports` arguments not being read.
- [On Install] Change the name of default navigation.

## 0.6.2

- Disable microdata
- [CPT] `jetpack-api` support is renamed to `rest-api` when creating CPT.
- [CPT] Add **supports** argument when creating Custom Taxonomy. For now it only has one available value: `rest-api`.

## 0.6.1

- [CPT] Support for `dashboard-count` is now on by default.
- [SEO] Fixed microdata error on `product` post type that's not created by WooCommerce.
- [SEO] Added WooCommerce product to Jetpack's sitemap.

## 0.6.0

- [CPT] Added `supports` parameter. Wiki has been updated with this new information [here](https://github.com/hrsetyono/edje-wp/wiki/Custom-Post-Type)

## 0.5.7

- New Customizer module.
- [Customizer] Added HEAD and FOOTER customizer, good for adding Google Analytics and such.

## 0.5.6

- [SEO] Extend microdata according to Ghost.org standard.
- [SEO] Added social media fields in User Profile. Disabled when Yoast is installed.

## 0.5.5

- [Shortcode] Automatically unautop all shortcodes.
- [On Install] Threaded comments set to 2.

## 0.5.4b

- [Shortcode] Add `class` attribute to [column]

## 0.5.4

- [SEO] If Yoast installed, disable the custom meta tags by Jetpack.
- [Shortcode] Remove empty <p> tag when using shortcode.
- [CPT] Automatically add custom taxonomy to Column List.
- [Editor] Make very small heading (H5, H6) bigger in Editor.

## 0.5.3b

- [SEO] Move JSON LD microdata to wp_footer instead of directly under the_content.
- [Widget] Text widget will use markdown if "Auto add paragraph" is not checked.
- [Admin] Added CPT to "At a Glance" widget in dashboard.

## 0.5.3

- Change logo in Login page if `custom_logo` is set in Customizer.
- Change some default Jetpack and Timber's behavior.
- [Woo] When WooCommerce is installed, automatically add `product` to Sitemap.
- Remove reordering of Editor buttons due to same feature implemented in WP 4.7.

## 0.5.2

- [SEO] Automatically add JSON LD Microdata on Post and Product

## 0.5.1

- Add default sample post, created upon plugin activation for the first time
- Added [row] and [column size="x"] shortcode that works with Edje Framework syntax.

## 0.5.0

- Added Editor style.
- Reorder Editor buttons.

## 0.4.2

- WordPress updated to v4.6

New SEO Functionality:

- All `<title>` matters are handled with this plugin. Your theme should only call `<title>wp_title();</title>`.
- Site name is appended after post title with `|`. With the exception of frontpage.
- Frontpage title overrides Site name.
- Description, Facebook, and Twitter meta tags are appended automatically. It uses excerpt; if empty, fallback to Site description.
- Reorder Taxonomy name in archive page.

## 0.4.1

- (Experimental) Added custom Row Action for any post type.
- Add several `is_admin()` conditional so it won't run in front end.

## 0.4.0

- Automatically change WP Setting to our standard after activation.

## 0.3.7

- Allow changes to Post and Page column.
- Registering columns now accepts array with `icon` and `content` argument. **Icon** is string and **Content** is function that returns the shown value.

## 0.3.6

- Fixed error when adding new menu without position.

## 0.3.5

- Added `slug` argument to custom post type.

## 0.3.4

- Change double quote to single quote in PHP.
- Added URL Rewrite on CPT and Taxonomy to replace underscore with dash.

## 0.3.1

- Added `name` argument to custom taxonomy. `name` is the ID stored in database, `slug` is the URL for single taxonomy page.

## 0.3.0

- Ready to use.
