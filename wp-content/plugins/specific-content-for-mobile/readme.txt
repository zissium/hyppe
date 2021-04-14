=== Specific Content for Mobile ===
Contributors: giuse
Donate link: https://commerce.coinbase.com/checkout/501bd0a4-965c-4e5d-b614-aae0e35a9d6c
Tags: mobile version, content for mobile
Requires at least: 4.6
Tested up to: 5.7
Stable tag: 0.1.7
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Specific Content For Mobile allows you to create specific content for the mobile version.

== Description ==

Specific Content For Mobile allows you to create specific content of pages and posts for the mobile version.

It's perfect if you have a couple of pages where you want to remove some fat content or different content.

The best way to have a mobile version is always a fully responsive design, but sometimes for a couple of pages, you may need to have different content. In all those cases, you will find useful Specific Content For Mobile.


To add or remove specific content for the mobile version of your pages, follow these steps:

- click on Pages in the main admin menu
- go with your mouse on the page you want to modify for the mobile version and click on the action link "Create mobile version", or click on the icon "+" you see in the devices column
- modify your page as you want to see it on mobile
- save your page mobile version



If you want to create a mobile version for your blog posts, do as explained above, but going to the list of Posts.


The actual version supports only the mobile version of pages and posts, no custom post types, no archives, no terms.

On mobile devices, the plugin will load the mobile version you have created for that page or post.

If create the mobile version for a page reachable at https://your-domain.com/page-example/, if you are logged-in you will see also https://your-domain.com/page-example-mobile/, but logged-out users will not see it, and the only URL that exists for the public is https://your-domain.com/page-example/.

The page reachable at https://your-domain.com/page-example/ will show the desktop content on desktop devices and the mobile content on mobile devices, but the URL is always the same.

You have no redirections, and the plugin just replaces the desktop content with the mobile version on the pages where you have specified a different content.


It's useful if you want to remove some content in the mobile version instead of simply hide it via CSS.


If you have a server cache plugin, be sure to set a different server cache handling for mobile devices, in another case the mobile version of your pages could also be served on desktop devices.
E.g. [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/), [WP Fastest Cache](https://wordpress.org/plugins/wp-fastest-cache/) and [Powered Cache](https://wordpress.org/plugins/powered-cache/) are caching plugins that can handle the mobile cache.



As a default, WordPress doesn't output the blog page content before the posts loop.
Some themes do it. In this case, the blog page content output before the loop is handled by the theme templates.
The plugin will check if the theme declares support for the blog page mobile version, if not so the blog page mobile version may take the original desktop content.

As a default Specific Content For Mobile synchronizes the post metadata. This means that when you save a post or page, if they have a mobile version, the same metadata will be saved in the mobile version.
When you save a mobile version, the mobile version metadata will be saved also in the desktop version.
If you want to change this behavior, go to Specific Content For Mobile settings and choose "Allow mobile versions having their own metadata".


For the most popular SEO plugins, you can choose the metadata synchronization specifically for that plugin.





For theme developers.

If you need to use a different template file on mobile, copy the template file of your theme and put it in one of these folders:

wp-content/scfm/

wp-content/themes/theme-name/scfm


For example, if your theme is "theme-name" and you want to load a different page.php on mobile, it will be something that looks like:

wp-content/scfm/page.PHP

or

wp-content/themes/theme-name/page.php


In the case of mobile devices, Specific Content For Mobile will look for the custom template file first in wp-content/themes/theme-name/scfm and if it doesn't find it in wp-content/scfm.






If you add an option for the metadata synchronization of an external plugin, you can use the filter "eos_scfm_meta_integration_array".

Here an example:

`
add_filter( 'eos_scfm_meta_integration_array','my_custom_scfm_meta_integration',20,2 );
//It adds an option to synchronize your plugin meta data.
function my_custom_scfm_meta_integration( $arr,$options ){
	$slug = 'my_custom_meta';
	$arr[$slug] = array(
		'is_active' => defined( 'WPSEO_FILE' ),
		'args' => array(
			'title' => __( 'My custom meta synchronization','my-textdomain' ),
			'type' => 'select',
			'value' => isset( $options[$slug] ) ? esc_attr( $options[$slug] ) : 'synchronized',
			'options' => array(
				'synchronized' => __( 'Synchronize desktop and mobile metadata','my-textdomain' ),
				'separated' => __( 'Allow mobile versions having their own metadata','my-textdomain' )
			),
		),
		'prefix' => array( '_my_plugin' ),
		'default' => 'synchronized'
	);
	return $arr;
}
`
Then you will see your custom option "My custom meta synchronization" in the main settings page.





In your theme, you can use the following functions to give full support to the mobile version content:


`
eos_scfm_related_desktop_id( $post_id );
`
given the post ID, it will get the post ID of the related desktop version.

`
eos_scfm_related_mobile_id( $post_id );
`
given the post ID, it will get the post ID of the related mobile version.


To add the theme support to the blog content, you can add this line in your theme support action hook:

`
add_theme_support('specific_content_form_mobile',array( 'posts_page' => true ) );
`

== Screenshots ==

1. Pages
2. Metadata synchronization
3. Custom metadata synchronization (for developers)


== Installation ==

1. Upload the entire `specific-content-for-mobile` folder to the `/wp-content/plugins/` directory or install it using the usual installation button in the Plugins administration page.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. After successful activation you will be automatically redirected to the plugin global settings page.
4. All done. Good job!



== Changelog ==

= 0.1.7 =
* Fixed: Conflict with Elementor


= 0.1.6 =
* Fixed: Mobile content not called when coming from single post editing screen
* Fixed: Missing icons on mobile preview
* Fixed: Permalinks on posts archive on mobile
* Added: Possibility to assign a different mobile page
* Added: Support to the mobile version of post excerpts
* Added: Hooks for the PRO version
* Added: Hooks to create the mobile version of the theme template files

= 0.1.5 =
* Fixed: Conflict with WPBakery and Elementor frontend builder
* Fixed: Device images and icons not loading on mobile preview

= 0.1.4 =
* Fixed: Mobile posts showing on archives
* Fixed: Private page visible for not logged users if WooCommerce is active
* Added: Preview on mobile
* Added: Options to synchronize the metadata
* Added: Filter to add metadata synchronization for external plugins
* Added: Bulk action to unlink the mobile versions

= 0.1.3 =
* Fixed: Compatibility with KingComposer
* Fixed: Compatibility with WpDiscuz plugin

= 0.1.2 =
* Fixed: PHP warnings if saving post without revisions
* Fixed: Comments not taken on mobile devices
* Removed: Synchronization between desktop and mobile

= 0.1.1 =
* Fixed: PHP error saving page missing links

= 0.1.0 =
* Fixed: error 404 if not logged on some mobile pages

= 0.0.9 =
* Fixed: PHP memory leak on mobile version trashing and untrashing
* Fixed: is_front_page() returned false on mobile homepage
* Checked: WordPress version 5.3

= 0.0.8 =
* Added: synchronization between desktop and mobile version for simple text, images, and links replacements

= 0.0.7 =
* Fixed: bug when user not logged-in

= 0.0.6 =
* Added: warning after the desktop content change
* Added: hook for the desktop and mobile versions changes synchronization (future PRO version)

= 0.0.5 =
* Fixed: mobile version for blog posts

= 0.0.4 =
* Added: prevent mobile version from being public to avoid SEO problems
* Fixed: issues when mobile versions moved to trash or restored from the trash

= 0.0.3 =
* Added: mobile version metabox in the single page and posts

= 0.0.2 =
* Added: action links in the plugins page
* Added: translation to Italian

= 0.0.1 =
* Initial Release

== Screenshots ==

1. Pages and posts list screen
