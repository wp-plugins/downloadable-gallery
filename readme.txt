=== Plugin Name ===
Contributors: jondor
Donate link: http://www.funsite.eu/downloadable-wallpapers/
Tags: images,gallery,show,shortcode,downloadable
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A shortcode which shows an gallery of downloadeble images

== Description ==

A shortcode which shows an gallery of downloadable images. The basic idea was to have an easy way to make some images available for download.

= shortcode =

	[downloadable_images taxonomy="gallery" slug="wallpaper"]
	
The default for taxonomy is gallery, the default slug is "wallpaper". So the above could also be used as

	[downloadable_images]

I use this plugin together with "Enhanced Media Library" (https://wordpress.org/plugins/enhanced-media-library/) which enables a taxonomy on the
media library (besides other features)

This plugin implements a custom thumbnail size of 300px width so probably you will have to regenerate thumbnails too. As a minimum for the
photo's shown if they are already uploaded. New uploaded photo's will generate this thumbnail automatically. 

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add the shortcode to a page.
4. regenerate thumbnails for the photo's which you want to show. 

== Frequently Asked Questions ==

= Why?? =
I wanted to share some of my work as wallpaper and needed a simple and easy way to do this. 

== Screenshots ==

1. preview

but for a working demo see: http://www.funsite.eu/downloadable-wallpapers/

== Changelog ==

= 1.0 =
* First release

== Upgrade Notice ==

Nothing  yet. 

