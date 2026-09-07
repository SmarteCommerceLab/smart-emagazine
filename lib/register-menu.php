<?php
/**
 * Navigation contract shared conceptually with AI-HTML.
 *
 * Smart eMagazine keeps its legacy editorial locations and PHP rendering.
 */

add_action('after_setup_theme', function () {
	register_nav_menus(array(
		'topic'        => __('Navigazione principale', 'smart-emagazine'),
		'utili'        => __('Link di utilita', 'smart-emagazine'),
		'naviga'       => __('Navigazione secondaria', 'smart-emagazine'),
		'footer'       => __('Footer', 'smart-emagazine'),
		'topic_left'   => __('Principale sinistra', 'smart-emagazine'),
		'topic_right'  => __('Principale destra', 'smart-emagazine'),
		'footer_col_1' => __('Footer colonna 1', 'smart-emagazine'),
		'footer_col_2' => __('Footer colonna 2', 'smart-emagazine'),
		'footer_col_3' => __('Footer colonna 3', 'smart-emagazine'),
		'footer_col_4' => __('Footer colonna 4', 'smart-emagazine'),
		'argomenti'    => __('Argomenti', 'smart-emagazine'),
		'primo'        => __('Sezione editoriale 1', 'smart-emagazine'),
		'secondo'      => __('Sezione editoriale 2', 'smart-emagazine'),
		'terzo'        => __('Sezione editoriale 3', 'smart-emagazine'),
		'local'        => __('Local', 'smart-emagazine'),
		'localplus'    => __('Citta', 'smart-emagazine'),
	));
});

function sem_get_nav_menu_fallback_locations($location) {
	$location = sanitize_key((string) $location);
	$map = array(
		'topic'        => array('topic', 'naviga', 'argomenti'),
		'utili'        => array('utili', 'footer', 'naviga'),
		'naviga'       => array('naviga', 'utili', 'footer'),
		'footer'       => array('footer', 'utili', 'naviga'),
		'topic_left'   => array('topic_left', 'topic'),
		'topic_right'  => array('topic_right', 'argomenti', 'topic'),
		'footer_col_1' => array('footer_col_1', 'naviga'),
		'footer_col_2' => array('footer_col_2', 'footer'),
		'footer_col_3' => array('footer_col_3', 'utili'),
		'footer_col_4' => array('footer_col_4', 'footer'),
	);
	$locations = isset($map[$location]) ? $map[$location] : array($location);

	return array_values(array_unique(array_filter(array_map('sanitize_key', (array) apply_filters(
		'sem_nav_menu_fallback_locations',
		$locations,
		$location
	)))));
}

function sem_resolve_nav_menu($location) {
	$requested = sanitize_key((string) $location);
	$result = array(
		'requested_location' => $requested,
		'location'           => '',
		'menu_id'            => 0,
		'menu_name'          => '',
		'source'             => 'unavailable',
	);
	$assigned = get_nav_menu_locations();

	foreach (sem_get_nav_menu_fallback_locations($requested) as $candidate) {
		$menu_id = isset($assigned[$candidate]) ? absint($assigned[$candidate]) : 0;
		$menu = $menu_id ? wp_get_nav_menu_object($menu_id) : false;
		if (! $menu || (isset($menu->count) && (int) $menu->count < 1)) {
			continue;
		}
		$result = array(
			'requested_location' => $requested,
			'location'           => $candidate,
			'menu_id'            => $menu_id,
			'menu_name'          => (string) $menu->name,
			'source'             => $candidate === $requested ? 'assigned' : 'location_alias',
		);
		break;
	}

	return (array) apply_filters('sem_resolved_nav_menu', $result, $requested);
}

function sem_resolve_nav_menu_args($location, array $args = array()) {
	$resolved = sem_resolve_nav_menu($location);
	unset($args['menu'], $args['theme_location']);
	$args['theme_location'] = $resolved['location'] !== '' ? $resolved['location'] : sanitize_key((string) $location);
	$args['fallback_cb'] = isset($args['fallback_cb']) ? $args['fallback_cb'] : false;
	return $args;
}

function sem_has_resolved_nav_menu($location) {
	$resolved = sem_resolve_nav_menu($location);
	return $resolved['menu_id'] > 0;
}

add_filter('wp_nav_menu_args', function ($args) {
	if (! is_array($args) || ! empty($args['menu']) || empty($args['theme_location'])) {
		return $args;
	}
	return sem_resolve_nav_menu_args($args['theme_location'], $args);
});
