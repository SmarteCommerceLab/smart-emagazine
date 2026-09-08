<?php
/*
* Setup Theme
*/
add_action( 'after_setup_theme',function(){
	add_theme_support('html5', array('gallery','caption'));
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('smart-builder-site', array(
		'templates' => array(
			'smart-site-home.php' => array('builder' => true, 'compose' => true),
			'smart-site-blog.php' => array('builder' => true, 'compose' => true),
			'smart-site-builder.php' => array('builder' => true, 'compose' => false),
		),
	));
});
/*
* Gravatr - Customize fileds
*/
add_filter( 'avatar_defaults',function($avatar_defaults){
	$avatar_defaults[get_site_icon_url()] = get_bloginfo('name');
return $avatar_defaults;});
/*
* Post Sub Title - Display
*/
function the_sub_title($before = '',$after = '',$display = true){global $post;
	// --
	$text = esc_html(get_post_meta($post->ID,'post-sub-title-value',true),1);
	// --
	if(strlen($text) === 0) {return;}
	// --
	$text = $before.$text.$after;
	// --
	if ($display){echo $text;}else{return $text;}
}
/*
* Remove Amp Link Switcher
*/
add_filter('amp_mobile_version_switcher_link_text',function(){if(is_plugin_active('amp/amp.php')){if(amp_is_request()){return false;}}});
