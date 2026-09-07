<?php
/**
 * Load theme administration styles only on owned screens.
 */
add_action( 'admin_enqueue_scripts', static function ( $hook_suffix ) {
	$screen       = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	$is_post_edit = $screen && 'post' === $screen->post_type && in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true );
	$is_theme_ui  = 'themes.php' === $hook_suffix
		|| 'toplevel_page_sem-dashboard' === $hook_suffix
		|| false !== strpos( $hook_suffix, 'smart-emagazine_page_sem-' );
	if ( $is_post_edit || $is_theme_ui ) {
		wp_enqueue_style( 'sem-admin', SEXM_DIR_URL . '/css/admin-css.min.css', array(), SEXM_VDATA );
	}
} );
