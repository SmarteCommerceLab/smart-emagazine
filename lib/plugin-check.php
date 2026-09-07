<?php
/**
 * Theme integration notices shown only where they are actionable.
 */
add_action( 'admin_notices', static function () {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ! in_array( $screen->id, array( 'themes', 'appearance_page_smart-emagazine-system' ), true ) ) {
		return;
	}
	if ( ! is_plugin_active( 'smart-bootstrap-manager/smart-bootstrap-manager.php' ) ) {
		echo '<div class="notice notice-warning"><p><strong>Smart eMagazine:</strong> ' . esc_html__( 'Smart Bootstrap Manager è necessario per il design system e i controlli del Customizer.', 'smart-emagazine' ) . '</p></div>';
		return;
	}
	$optional = array();
	foreach ( array(
		'smart-advertising-manager/smart-advertising-manager.php' => 'Smart Advertising',
		'smart-wordpress-lite-core/smart-wordpress-lite-core.php' => 'Smart WordPress Lite Core',
		'smart-seo-dots/smart-seo-dots.php' => 'Smart SEO Dots',
		'smart-yoast-personalize/smart-yoast-personalize.php' => 'Smart Yoast Formatter',
		'smart-google-tag-manager/smart-google-tag-manager.php' => 'Smart Google Tag Manager',
	) as $plugin => $name ) {
		if ( ! is_plugin_active( $plugin ) ) {
			$optional[] = $name;
		}
	}
	if ( $optional ) {
		printf(
			'<div class="notice notice-info is-dismissible"><p><strong>Smart eMagazine:</strong> %s %s</p></div>',
			esc_html__( 'Integrazioni opzionali non attive:', 'smart-emagazine' ),
			esc_html( implode( ', ', $optional ) )
		);
	}
} );
