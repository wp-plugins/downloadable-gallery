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

if (!class_exists('basic_plugin_class')) {
	require(plugin_dir_path(__FILE__).'basics/basic_plugin.class');
}

class downloadable_gallery_class  extends basic_plugin_class {

	function getPluginBaseName() { return plugin_basename(__FILE__); }
	function getChildClassName() { return get_class($this); }

	public function __construct() {
		parent::__construct();
		
		add_action( 'wp_enqueue_scripts', array($this,'downloadable_images_style') );
		// Define a custom size
		add_image_size( 'downloadableThumb', 300);
		// add the shortcode
		add_shortcode( 'downloadable_images', array($this,'downloadable_images') );
	}

	function pluginInfoRight($info) {  }
	
	const FS_TEXTDOMAIN = 'downloadable_gallery';
	const FS_PLUGINNAME = 'downloadable-gallery';
	
	
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

}

$downloadable_gallery = new downloadable_gallery_class();

?>