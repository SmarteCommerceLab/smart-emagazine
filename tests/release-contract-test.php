<?php

$root = dirname(__DIR__);
$style = (string) file_get_contents($root . '/style.css');
$functions = (string) file_get_contents($root . '/functions.php');
$updater = (string) file_get_contents($root . '/inc/class-sem-public-theme-updater.php');

preg_match('/^Version:\s*([^\r\n]+)/m', $style, $header_version);
preg_match("/define\('SEXM_'\.'VERSION'\s*,\s*'([^']+)'/", $functions, $constant_version);

if (($header_version[1] ?? '') !== ($constant_version[1] ?? null)) {
	fwrite(STDERR, "Theme header and SEXM_VERSION are not aligned.\n");
	exit(1);
}

foreach (array('SEM_UPDATE_ENDPOINT', 'pre_set_site_transient_update_themes', 'upgrader_pre_download', "hash_file('sha256'", 'upgrader_source_selection') as $needle) {
	if (strpos($functions . $updater, $needle) === false) {
		fwrite(STDERR, "Missing release contract: {$needle}\n");
		exit(1);
	}
}

echo "Smart eMagazine release contract OK.\n";
