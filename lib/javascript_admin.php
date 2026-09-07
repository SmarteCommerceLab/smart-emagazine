<?php
//--javascript
/* http://www.sintesi-design.it/wordpress/inserire-jquery-nel-tema-di-wordpress/ */
/* https://wpengine.com/support/including-a-different-jquery-version-in-wordpress/*/
add_action('admin_enqueue_scripts',function() {
	if(current_user_can('administrator')){
		wp_enqueue_script( 'script-header-load',get_template_directory_uri().'/js/script-header-load.js',array('jquery'),null,true);
	}
	wp_enqueue_script( 'script_admin_editor',get_template_directory_uri().'/js/script-admin-editor.js',array('jquery'),null,true);
});