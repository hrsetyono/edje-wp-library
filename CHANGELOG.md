## 0.4.2

- Wordpress updated to v4.6

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
