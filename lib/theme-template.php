<?php
/*
https://developer.wordpress.org/reference/functions/get_single_template/
https://developer.wordpress.org/reference/hooks/type_template/
https://justintadlock.com/archives/2008/12/06/creating-single-post-templates-in-wordpress
*/
?>
<?php
/*
* Template Single
*/
add_filter('single_template',function($single_template){
	// == Global
	global $post;
	// == Layout
		//--
		$post_layout_selected_value 		= false;
		$post_layout_selected_value 		= get_post_meta($post->ID,'sem-post-layout-selected-value', true);
		//--
		if(isset($post_layout_selected_value) and !empty($post_layout_selected_value)){
			if(
				$post_layout_selected_value 	!== false 						and
				$post_layout_selected_value 	!== 'default' 					and
				$post_layout_selected_value 	!== 'sem-layout-single-line' 	and
				$post_layout_selected_value 	!== 'sem-layout-single-side'	and
				$post_layout_selected_value 	!== 'sem-layout-single-image'	and
				$post_layout_selected_value 	!== 'sem-layout-single-medium'
			){$post_layout_selected_value 	= false;}
		}else{$post_layout_selected_value 	= false;}
		
	// == 
	if($post_layout_selected_value == false or $post_layout_selected_value == 'default'){
		$single_template = SEXM_DIR_PATH.'/template/template-single-post-layout-default.php';
	}
	if($post_layout_selected_value == 'sem-layout-single-line'){
		$single_template = SEXM_DIR_PATH.'/template/template-single-post-layout-line.php';
	}
	if($post_layout_selected_value == 'sem-layout-single-side'){
		$single_template = SEXM_DIR_PATH.'/template/template-single-post-layout-side.php';
	}
	if($post_layout_selected_value == 'sem-layout-single-image'){
		$single_template = SEXM_DIR_PATH.'/template/template-single-post-layout-image.php';
	}
	if($post_layout_selected_value == 'sem-layout-single-medium'){
		$single_template = SEXM_DIR_PATH.'/template/template-single-post-layout-medium.php';
	}
	
return $single_template;});
/*
* Template Single
*/
add_filter('home_template',function($home_template){
	$home_template = SEXM_DIR_PATH.'/smart-site-home.php';
return $home_template;});
