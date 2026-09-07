<?php
/*
* Plugin Dipendenze Notice
* https://digwp.com/2016/05/wordpress-admin-notices/
*/
add_action( 'admin_notices',function() {
	// -- Smart Customizer Frameworks
	if(!is_plugin_active( 'smart-customizer-frameworks/smart-customizer-frameworks.php' ))		{
		echo 	'<div class="notice notice-warning  is-dismissible"><p>Warning: Plugin Richiesti per Smart eMagazine Theme : <strong>Smart Customizer Frameworks</strong> - ver:1.1.8</p></div>';
	}
	// -- Smart Bootstrap Integration
	if(!is_plugin_active( 'smart-bootstrap-manager/smart-bootstrap-manager.php' )){
		echo 	'<div class="notice notice-warning  is-dismissible"><p>Warning: Plugin Richiesti per Smart eMagazine Theme : <strong>Smart Bootstrap Integration</strong> - ver:1.0.9</p></div>';
	}
	// -- Smart Advertising Hosting
	if(!is_plugin_active( 'smart-advertising-manager/smart-advertising-manager.php' ))		{
		echo 	'<div class="notice notice-warning  is-dismissible"><p>Warning: Plugin Richiesti per Smart eMagazine Theme : <strong>Smart Advertising</strong> - ver:1.0.11</p></div>';
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