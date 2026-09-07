<?php
/* 
* https://developer.wordpress.org/reference/functions/wp_enqueue_style/
* https://www.gleenk.com/come-caricare-correttamente-i-css-in-tema-wordpress/ 
* https://code.tutsplus.com/it/tutorials/loading-css-into-wordpress-the-right-way--cms-20402
* if(is_home()  or is_page_template('home.php') or is_archive() or is_page() or is_search() or is_404()){}
*/
add_action( 'wp_enqueue_scripts',function() {
	wp_enqueue_style('smart-emagazine-compose',SEXM_DIR_URL.'/css/compose.min.css',array(),SEXM_VDATA);		
},99);
/*
* WP - Load CSS Asynchronously
* Eliminate blocking-resources
*/
/*add_filter('style_loader_tag',function($html, $handle) {
	// -- css da gestire
	$async_loading = array(
		'smart-emagazine-compose'
	);
	// -- css caricato asyncrono con preload
	if(in_array($handle, $async_loading)){
		$async_html = str_replace("rel='stylesheet'", "rel='preload' as='style'", $html);
		$async_html .= str_replace( 'media=\'all\'', 'media="print" onload="this.media=\'all\'"', $html );
		return $async_html;
	}
	return $html;
},10,2);*/
/*
* fontawasome load css
*/
add_action('get_footer',function(){
	#if(is_home()  or is_page_template('home.php') or is_archive() or is_page() or is_search() or is_404() or is_page_template('gerenza.php')){}
	wp_enqueue_style ('font-awesome-6.4.2',	SEXM_DIR_URL.'/css/fontawesome/fontawesome.min.css',	array(),SEXM_VDATA);
	wp_enqueue_style ('solid-6.4.2',		SEXM_DIR_URL.'/css/fontawesome/solid.min.css',			array(),SEXM_VDATA);
	wp_enqueue_style ('brands-6.4.2',		SEXM_DIR_URL.'/css/fontawesome/brands.min.css',			array(),SEXM_VDATA);
});