<?php
/*
* 
*/
function sem_customizer_separetor_add($wp_customize,$object,$section){
	$wp_customize->add_setting($object,array('sanitize_callback' => '',));
	$wp_customize->add_control(new Mizer_Separator_Control($wp_customize,$object,array('section' => $section)));	
}
/*
* Wrapping Content Article
*/
if($option = sem_option_check('sem-content-wrapper-size')){
	add_action('wp_head',function(){if(is_single()){$option = sem_option_check('sem-content-wrapper-size');
		$widht = $option['sem-content-wrapper-size'];
		echo '<!-- smart eMagazine css -->';
		echo '<style type="text/css">.header-main{max-width:'.$widht.'px!important}main.container.site-main{max-width:'.$widht.'px!important}footer .container{max-width:'.$widht.'px!important}</style>';
		echo '<!-- / smart eMagazine css -->';
	}});		
}else{
	add_action('wp_head',function(){if(is_single()){$option = sem_option_check('sem-content-wrapper-size');
		echo '<!-- smart eMagazine css -->';
		echo '<style type="text/css">.header-main{max-width:1280px!important}main.container.site-main{max-width:1280px!important}footer .container{max-width:1280px!important}</style>';
		echo '<!-- / smart eMagazine css -->';
	}});	
}
/*
* Wrapping Content Article
*/
#add_action('the_content',function($content){return '<div id="single-content" class="entry-content">'.$content.'</div>';});
/*
* Get Menu Info
*/
function sec_menu_get_info($location_name){
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[$location_name]);
	if(is_object($menu)){
		#echo 'This menu exists!';
		#echo 'This menu has ' . $menu->count . ' menu items.';
		#echo 'This menu ID is ' . $menu->term_id . '.';
		#echo 'This menu Name is ' . $menu->name . '.';
	} else {
		#echo 'A menu with that name doesn\'t exist';
	}
return $menu;}
/*
* Jquery Remove - Completely Remove jQuery From WordPress
*/	
/*if(get_theme_mod('secMagazine_jquery_disable',false)==true){
	add_action('init', 'my_init');function my_init() {if (!is_admin()) {wp_deregister_script('jquery');wp_register_script	('jquery', false);}}
	// == deRegistrazione
	#wp_deregister_script('wp-embed');
	#wp_deregister_script('jquery');
	#wp_deregister_script('jquery-ui-core');		
}*/
/*
*	
* Get Primary Post Category
* https://www.lab21.gr/blog/wordpress-get-primary-category-post
--------------------*/
function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
	$return = array();
	if (class_exists('WPSEO_Primary_Term')){
		// Show Primary category by Yoast if it is enabled & set
		$wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
		$primary_term = get_term($wpseo_primary_term->get_primary_term());

		if (!is_wp_error($primary_term)){
			$return['primary_category'] = $primary_term;
		}
	}
	if (empty($return['primary_category']) || $return_all_categories){
		$categories_list = get_the_terms($post_id, $term);

		if (empty($return['primary_category']) && !empty($categories_list)){
			$return['primary_category'] = $categories_list[0];  //get the first category
		}
		if ($return_all_categories){
			$return['all_categories'] = array();

			if (!empty($categories_list)){
				foreach($categories_list as &$category){
					$return['all_categories'][] = $category->term_id;
				}
			}
		}
	}
	return $return;
}
/*
* Escludere Categorie dalle query di pagine specifiche
* http://www.semanticstone.net/wordpress/snippet/wordpress-customizzare-la-query-taxonomy/
* https://codex.wordpress.org/it:Riferimento_funzioni/query_posts
* https://wordpress.stackexchange.com/questions/167032/exclude-particular-posts-in-archive-php
*/
/*add_action( 'pre_get_posts', function($query){
	if ( is_admin() || ! $query->is_main_query() )
		return;
	if ( $query->is_archive() ) {$query->set( 'category__not_in', array(get_theme_mod('journal_notinclude_category','')) );}
	if ( $query->is_search() ) {$query->set( 'category__not_in', array(get_theme_mod('journal_notinclude_category','')) );}
});*/
/**
*
* Search form html
*/
function sem_search_form_html(){?>
    <form 
        class	= "search-form mb-3 d-flex justify-content-center align-items-center border border-1" 
        role	= "search" 
        method	= "get" 
        id		= "searchform" 
        action	= "<?php echo home_url('/'); ?>"
    >
        <input 
            type 				= "search" 
            class 				= "form-control border-0 m-2" 
            placeholder 		= "Cerca nel sito" 
            aria-label			= "Cerca nel sito" 
            aria-describedby	= "basic-addon2" 
            value				= "<?php echo esc_attr( get_search_query() ); ?>"  
            name				= "s" 
            id					= "s"
        >
        <button 
        	class	= "btn btn-primary m-2" 
            type	= "submit"
		>
            <i class="fa-solid fa-search fa-xl"></i>
		</button>
    </form> 
    <hr> 
<?php }