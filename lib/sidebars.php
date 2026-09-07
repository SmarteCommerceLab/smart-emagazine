<?php
// -------------------------------------------------------------------------------------------------------- Home / Single / Category / Tag / Author / Search / 404 / Image / Archivie
// -------------------------------------------------------------------------------------------------------- single.php
	/*== Single-Sidebar == */
	if (function_exists('register_sidebar')) {
		 register_sidebar(array(
			'name' 			=> 'Single Sidebar',
			'id'   			=> 'single_sidebar',
			'description'   => 'Single Sidebar',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="d-md-none mb-3 sec_smartAdv sec_smartAdv_Sidebar_post d-flex justify-content-center align-items-center %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => ''
		 ));
	}
// -------------------------------------------------------------------------------------------------------- category.php / tag.php / author.php / archivie.php
	/*== category_sidebar == */
	if (function_exists('register_sidebar')) {
		 register_sidebar(array(
			'name' 			=> 'Category Sidebar',
			'id'   			=> 'category_sidebar',
			'description'   => 'Category Sidebar',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="mb-3 %2$s d-flex justify-content-center align-items-center">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => ''
		 ));
	}