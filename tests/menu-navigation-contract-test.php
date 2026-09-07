<?php
$root   = dirname(__DIR__);
$menu   = file_get_contents($root . '/lib/register-menu.php');
$header = file_get_contents($root . '/header.php');
$footer = file_get_contents($root . '/footer.php');
$tools  = file_get_contents($root . '/lib/theme-utilities.php');

foreach (array('topic', 'utili', 'naviga', 'footer', 'topic_left', 'topic_right', 'footer_col_1', 'footer_col_4', 'argomenti', 'primo', 'localplus') as $location) {
	if (strpos($menu, "'{$location}'") === false) {
		fwrite(STDERR, "Missing menu location: {$location}\n");
		exit(1);
	}
}

foreach (array('sem_get_nav_menu_fallback_locations', 'sem_resolve_nav_menu', 'sem_resolve_nav_menu_args', 'sem_has_resolved_nav_menu', 'wp_nav_menu_args') as $functionality) {
	if (strpos($menu, $functionality) === false) {
		fwrite(STDERR, "Missing navigation contract: {$functionality}\n");
		exit(1);
	}
}

if (strpos($tools, 'sem_resolve_nav_menu($location_name)') === false) {
	fwrite(STDERR, "Legacy menu metadata does not use the shared resolver.\n");
	exit(1);
}

foreach (array('visually-hidden-focusable', 'language_attributes()', 'Apri menu di navigazione') as $accessibility) {
	if (strpos($header, $accessibility) === false) {
		fwrite(STDERR, "Missing header accessibility contract: {$accessibility}\n");
		exit(1);
	}
}

if (strpos($header, 'data-bs-toggle') === false || strpos($header, '<button') === false || strpos($footer, '<button') === false) {
	fwrite(STDERR, "Offcanvas controls are not semantic buttons.\n");
	exit(1);
}

echo "Smart eMagazine menu navigation contract OK.\n";
