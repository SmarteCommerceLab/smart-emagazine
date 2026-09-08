<?php

$root = dirname(__DIR__);
$hub = (string) file_get_contents($root . '/inc/class-sem-admin-support.php');
$scope = (string) file_get_contents($root . '/lib/css-admin.php');
$css_path = $root . '/css/admin-hub.css';
$css = is_file($css_path) ? (string) file_get_contents($css_path) : '';

$required_pages = array(
	'add_menu_page',
	'add_submenu_page',
	'sem-dashboard',
	'sem-design',
	'sem-menus',
	'sem-integrations',
	'sem-system',
	'sem-support',
);

foreach ($required_pages as $needle) {
	if (strpos($hub, $needle) === false) {
		fwrite(STDERR, "Missing admin hub contract: {$needle}\n");
		exit(1);
	}
}

foreach (array("get_user_option('admin_color')", '$_wp_admin_css_colors', 'customize.php', 'widgets.php', 'nav-menus.php') as $needle) {
	if (strpos($hub, $needle) === false) {
		fwrite(STDERR, "Missing WordPress admin integration: {$needle}\n");
		exit(1);
	}
}

foreach (array('.sem-admin-header', '.sem-admin-sidebar', '.sem-admin-main', '--sem-admin-header', '@media') as $needle) {
	if (strpos($css, $needle) === false) {
		fwrite(STDERR, "Missing admin design-system rule: {$needle}\n");
		exit(1);
	}
}

if (strpos($css, 'margin: 20px 20px 40px 2px') === false) {
	fwrite(STDERR, "The admin wrapper does not preserve the canonical WordPress safe area.\n");
	exit(1);
}

if (preg_match('/margin(?:-left|-top)?\s*:\s*-/', $css)) {
	fwrite(STDERR, "Negative wrapper margins must not cancel the WordPress admin spacing.\n");
	exit(1);
}

if (strpos($scope, 'toplevel_page_sem-dashboard') === false || strpos($scope, 'smart-emagazine_page_sem-') === false) {
	fwrite(STDERR, "Admin assets are not scoped to Smart eMagazine hub screens.\n");
	exit(1);
}

echo "Smart eMagazine admin hub contract OK.\n";
