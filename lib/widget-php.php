<?php
/*
* esegui codice php nelle sidebar
*/
add_filter( 'widget_text',function($widget_text){
	if( strpos( $widget_text, '<' . '?' ) !== false ) {
		ob_start();
		eval( '?>' . $widget_text );
		$widget_text = ob_get_contents();
		ob_end_clean();
	}
	return $widget_text;
},99);