<?php
/*
* Register Menu
*/
add_action('init',function(){register_nav_menus( array(
	'topic'				=> __('Topic'),
	'argomenti'			=> __('Argomenti'),
	'utili'				=> __('Utili'),
	
	'primo'				=> __('Primo'),
	'secondo'			=> __('Secondo'),
	'terzo'				=> __('Terzo'),		
		
	'local'				=> __('Local'),
	'localplus'			=> __('Città'),		
	
	'naviga'			=> __('Naviga'),
	'footer'			=> __('Footer'),
));});	