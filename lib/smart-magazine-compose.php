<?php
/*== Top == */
if (function_exists('register_sidebar')) {
	 register_sidebar(array(
	 'name' => 'Compose - Home Top',
	 'id'   => 'top_section',
	 'description'   => 'Compose - Home Page',
	 'before_widget' => '',
	 'after_widget'  => '',
	 'before_title'  => '',
	 'after_title'   => ''
	 ));
}
?>