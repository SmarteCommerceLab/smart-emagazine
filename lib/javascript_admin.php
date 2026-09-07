<?php
/**
 * Editor-only administration scripts.
 */
add_action( 'admin_enqueue_scripts', static function ( $hook_suffix ) {
	if ( ! in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'post' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_script( 'sem-script-header-load', SEXM_DIR_URL . '/js/script-header-load.js', array( 'jquery' ), SEXM_VDATA, true );
	wp_enqueue_script( 'sem-script-admin-editor', SEXM_DIR_URL . '/js/script-admin-editor.js', array( 'jquery' ), SEXM_VDATA, true );
} );
