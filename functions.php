<?php
/*
* define CONSTANT
*/
define('SEXM_'.'VERSION'	, '1.0.92' );
define('SEXM_'.'VDATA'		, '202403280844');
define('SEXM_'.'DIR_PATH'	, get_template_directory());
define('SEXM_'.'DIR_URL'	, get_template_directory_uri( __FILE__ ) );
define('SEXM_'.'OPTION'		, 'smart-emagazine-option');
define('SEM_TEXT_DOMAIN', 'smart-emagazine');
define('SEM_THEME_NAME', 'Smart eMagazine');
define('SEM_PRODUCT_SLUG', 'smart-emagazine');
define('SEM_UPDATE_ENDPOINT', 'https://repository.smartecommerce.it/updates/themes/smart-emagazine.json');
/*
*
*/
include_once ABSPATH.'wp-admin/includes/plugin.php';
/*
* 
*/
require_once('lib/theme-function-tools.php');
require_once('inc/class-sem-public-theme-updater.php');

SEM_Public_Theme_Updater::register(array(
	'theme_slug'   => get_template(),
	'product_slug' => SEM_PRODUCT_SLUG,
	'version'      => SEXM_VERSION,
	'endpoint'     => SEM_UPDATE_ENDPOINT,
));
/*
* Theme-Reset
*/
if (is_admin()){
	require_once('lib/theme-option-register.php');
	require_once('lib/theme-option-reset.php');
}
/*
*
*/
if(current_user_can('administrator')){require_once ('lib/plugin-check.php');}
require_once ('lib/theme-support.php');
require_once ('lib/register-menu.php');
require_once ('lib/amp.php');
/*
*
*/
if(is_customize_preview()){
	/*
	* Caricamento Customizer
	*/
	require_once ('lib/customizer.php');
}
/*
*
*/
if (!is_admin()){
	add_action('wp_head',function(){echo '<!-- This site is using Smart eMagazine Theme v'.SEXM_VERSION.' - Developed by Smart eCommerce - https://smartecommerce.it -->'; });
	require_once ('lib/theme-template.php');
	require_once ('lib/css.php');
	require_once ('lib/compose.php');	
	require_once ('lib/script-adding.php');
	require_once ('lib/post_next_previous.php');
	require_once ('lib/widget-php.php');
	require_once ('lib/theme-utilities.php');
}
/*
*
*/
if (is_admin()){
	require_once ('lib/css-admin.php');
	require_once ('lib/theme-image-size.php');	
	require_once ('lib/javascript_admin.php');
	require_once ('lib/thumb_minimun_size.php');
	require_once ('lib/post_occhiello.php');
	require_once ('lib/post_layout.php');
	if(current_user_can('administrator')){require_once ('lib/post-script-disable.php');}
}
