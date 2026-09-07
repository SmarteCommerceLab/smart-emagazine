<?php
/**
* Get all the registered image sizes along with their dimensions
*
* @global array $_wp_additional_image_sizes
*
* @link http://core.trac.wordpress.org/ticket/18947 Reference ticket
*
* @return array $image_sizes The image sizes
*/
function sem_get_all_image_sizes() {
	// --
    global $_wp_additional_image_sizes;
	// --
    $default_image_sizes = get_intermediate_image_sizes();
	// --
    foreach ( $default_image_sizes as $size ) {
        $image_sizes[ $size ][ 'width' ] 	= intval( get_option( "{$size}_size_w" ) );
        $image_sizes[ $size ][ 'height' ] 	= intval( get_option( "{$size}_size_h" ) );
        $image_sizes[ $size ][ 'crop' ] 	= get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
    }
	// --
    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
    }
return $image_sizes;}
/*
* https://wordpress.stackexchange.com/questions/28359/how-to-require-a-minimum-image-dimension-for-uploading
*/
if($option = sem_option_check_true('sem-article-image-size-control') and !current_user_can( 'administrator')){
	add_filter( 'wp_handle_upload_prefilter',function($file){
	// -- 
	$sem_get_all_image_sizes = sem_get_all_image_sizes();
	// -- Tipo di File da Controllare
	$mimes = array( 'image/jpg','image/jpeg', 'image/png', 'image/gif' );
	// -- Misur Minime
	$minimum = array( 'width' => $sem_get_all_image_sizes['large']['width'], 'height' => $sem_get_all_image_sizes['large']['height'] );
	// -- Controllo Upload Formato
	if(!in_array( $file['type'], $mimes)){return $file;}
	// -- Recupero Size Upload
	$img = getimagesize( $file['tmp_name'] );
	// -- Controllo Misure
	if ($img[0] < $minimum['width']){
		$file['error'] = 
		'Attenzione! Larghezza minima richiesta'. $minimum['width'].'px. Larghezza immagine caricata '.$img[0].'px.
		Caricare un immagine più grande, almeno '.$sem_get_all_image_sizes['large']['width'].'x'.$sem_get_all_image_sizes['large']['height'].'px.';
	}elseif($img[1] < $minimum['height']){
		$file['error'] = 
		'Attenzione! Altezza minima richiesta'. $minimum['height'].'px. Altezza immagine caricata '. $img[1] . 'px.
		Caricare un immagine più grande, almeno '.$sem_get_all_image_sizes['large']['width'].'x'.$sem_get_all_image_sizes['large']['height'].'px.';
	}
return $file;});}