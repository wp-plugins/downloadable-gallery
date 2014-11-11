<?php
/**
 * @package downloadable_gallery
 * @version 1.0
 */
/*
Plugin Name: downloadable gallery
Plugin URI: http://www.funsite.eu/downloadable_gallery
Description: A shortcode which shows an gallery of downloadable images
Author: Gerhard Hoogterp
Version: 1.0
Author URI: http://www.funsite.eu/
*/

// Add Shortcode


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
		$res .= '<img src="'.$thumb[0].'">';
		$res .= '<i class="icon-download-cloud overlay"></i>';
		$res .= '</a>';
	}
	$res .= '</div>';
	
	return $res;
}

// Add some stylinginfo
function downloadable_images_style() {
	wp_enqueue_style( "downloadable_gallery_font",plugins_url('css/fontello.css', __FILE__));
	wp_enqueue_style( "downloadable_gallery",plugins_url('css/downloadable_gallery.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'downloadable_images_style' );

// Define a custom size
add_image_size( 'downloadableThumb', 300);

// add the shortcode
add_shortcode( 'downloadable_images', 'downloadable_images' );
?>