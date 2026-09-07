<?php
/*
* Plugin Dipendenze Notice
* https://digwp.com/2016/05/wordpress-admin-notices/
*/
add_action( 'admin_notices',function() {
	// SBM provides the Customizer compatibility runtime used by the theme.
	if(!is_plugin_active( 'smart-bootstrap-manager/smart-bootstrap-manager.php' )){
		echo 	'<div class="notice notice-warning is-dismissible"><p><strong>Smart eMagazine:</strong> Smart Bootstrap Manager è necessario per il design system e i controlli del Customizer.</p></div>';
	}
	// Advertising slots are guarded in templates and remain an optional integration.
	if(!is_plugin_active( 'smart-advertising-manager/smart-advertising-manager.php' ))		{
		echo 	'<div class="notice notice-info is-dismissible"><p><strong>Smart eMagazine:</strong> Smart Advertising è opzionale e serve soltanto per attivare gli spazi pubblicitari gestiti.</p></div>';
	}
	// -- Smart Wordpress Lite
	if(!is_plugin_active( 'smart-wordpress-lite-core/smart-wordpress-lite-core.php' )){
		echo 	'<div class="notice notice-info is-dismissible"><p>Info: Plugin Ottimali per Smart eMagazine Theme : <strong>Smart Wordpress Lite Core</strong> - ver:1.0.5</p></div>';
	}
	// -- Smart Seo Dots
	if(!is_plugin_active( 'smart-seo-dots/smart-seo-dots.php' ))			{
		echo 	'<div class="notice notice-info is-dismissible"><p>Info: Plugin Ottimali per Smart eMagazine Theme : <strong>Smart Seo Dots</strong> - ver:1.2.23</p></div>';
	}
	// -- Smart Yoast Formatting
	if(!is_plugin_active( 'smart-yoast-personalize/smart-yoast-personalize.php' ))		{
		echo 	'<div class="notice notice-info is-dismissible"><p>Info: Plugin Ottimali per Smart eMagazine Theme : <strong>Smart Yoast Fomatter</strong> - ver:1.0.9</p></div>';
	}
	// -- Smart Google Tag Manager
	if(!is_plugin_active( 'smart-google-tag-manager/smart-google-tag-manager.php' ))			{
		echo 	'<div class="notice notice-info is-dismissible"><p>Info: Plugin Ottimali per Smart eMagazine Theme : <strong>Smart Google Tag Manager</strong> - ver:1.0.2</p></div>';
	}
});
