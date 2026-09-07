<?php
$root    = dirname(__DIR__);
$layouts = glob($root . '/template/template-single-post-layout-*.php');
$parts   = array(
	'single-author-meta',
	'single-featured-image',
	'single-tags',
	'single-author-box',
);

if (count($layouts) !== 5) {
	fwrite(STDERR, "Expected five single-post layouts.\n");
	exit(1);
}

foreach ($layouts as $layout) {
	$content = file_get_contents($layout);
	foreach ($parts as $part) {
		if (strpos($content, "template-parts/{$part}") === false) {
			fwrite(STDERR, basename($layout) . " does not use {$part}.\n");
			exit(1);
		}
	}
	foreach (array('get_avatar(', 'get_the_tags(', 'the_post_thumbnail(') as $duplicated_call) {
		if (strpos($content, $duplicated_call) !== false) {
			fwrite(STDERR, basename($layout) . " contains duplicated {$duplicated_call}.\n");
			exit(1);
		}
	}
}

foreach ($parts as $part) {
	if (! is_file($root . "/template-parts/{$part}.php")) {
		fwrite(STDERR, "Missing shared template part {$part}.\n");
		exit(1);
	}
}

echo "Smart eMagazine single template parts contract OK.\n";
