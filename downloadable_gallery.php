<?php
/**
 * @package downloadable_gallery
 * @version 1.2
 */
/*
Plugin Name: downloadable gallery
Plugin URI: http://www.funsite.eu/downloadable_gallery
Description: A shortcode which shows an gallery of downloadable images
Author: Gerhard Hoogterp
Version: 1.2
Author URI: http://www.funsite.eu/
*/

class downloadable_gallery_class {

	const FS_TEXTDOMAIN = 'downloadable_gallery';
	const FS_PLUGINNAME = 'downloadable-gallery';
	
    public function __construct() {
   		add_action('init', array($this,'myTextDomain'));
		add_filter('plugin_row_meta', array($this,'downloadable_gallery_PluginLinks'),10,2);
		add_action( 'wp_enqueue_scripts', array($this,'downloadable_images_style') );
		// Define a custom size
		add_image_size( 'downloadableThumb', 300);
		// add the shortcode
		add_shortcode( 'downloadable_images', array($this,'downloadable_images') );
	}

	
	function downloadable_images( $atts ) {
		$res = '';
		// Attributes
		extract( shortcode_atts(
			array(
				'taxonomy'	=> 'gallery',
				'slug'	=> 'wallpaper',
			), $atts )
		);

		// first get the term_id by name
		$row = get_term_by( 'slug', $slug, $taxonomy);
		
		// using the term_id let's find the objects 
		$args = array();
		$object_ids = get_objects_in_term($row->term_id, $taxonomy, $args );

		$res = '<div class="downloadable_gallery">';
		foreach ($object_ids as $obj_id) {

			$full = wp_get_attachment_image_src( $obj_id, 'full' );
			$thumb = wp_get_attachment_image_src( $obj_id, 'downloadableThumb'); 

			$res .= '<a href="'.$full[0].'" download>';
			$res .= '<img src="'.$thumb[0].'" alt="" title="'.__("Download for free",self::FS_TEXTDOMAIN).'">';
			$res .= '<i class="download-icon overlay" title="'.__("Download for free",self::FS_TEXTDOMAIN).'"></i>';
			$res .= '</a>';
		}
		$res .= '</div>';
		
		return $res;
	}

	// Add some stylinginfo
	function downloadable_images_style() {
		wp_enqueue_style( "downloadable_gallery",plugins_url('css/downloadable_gallery.css', __FILE__));
	}


	/* -------------------------------------------------------------------------------------- */
	function downloadable_gallery_PluginLinks($links, $file) {
		$base = plugin_basename(__FILE__);
		if ($file == $base) {
			$links[] = '<a href="https://wordpress.org/support/view/plugin-reviews/'.self::FS_PLUGINNAME.'#postform">' . __('Please rate me.',self::FS_TEXTDOMAIN) . '</a>';
		}
		return $links;
	}

	function myTextDomain() {
		$ok=load_plugin_textdomain(
			self::FS_TEXTDOMAIN,
			false,
			dirname(plugin_basename(__FILE__)).'/languages/'
		);
	}
	
}

$downloadable_gallery = new downloadable_gallery_class();

?>