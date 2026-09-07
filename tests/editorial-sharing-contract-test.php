<?php
$root = dirname(__DIR__);
$share = (string) file_get_contents($root . '/template-parts/share-buttons.php');
$profile = (string) file_get_contents($root . '/inc/class-sem-editorial-profile.php');
$functions = (string) file_get_contents($root . '/functions.php');

foreach (array('facebook.com/sharer', 'twitter.com/intent/tweet', 'api.whatsapp.com/send', 'linkedin.com/sharing/share-offsite', 'navigator.share', 'aria-label') as $needle) {
	if (false === strpos($share, $needle)) {
		throw new RuntimeException('Share contract missing: ' . $needle);
	}
}
foreach (array('current_user_can', 'wp_verify_nonce', 'esc_url_raw', 'sanitize_text_field', 'sem_editorial_role') as $needle) {
	if (false === strpos($profile, $needle)) {
		throw new RuntimeException('Editorial profile contract missing: ' . $needle);
	}
}
if (false === strpos($functions, "class-sem-editorial-profile.php")) {
	throw new RuntimeException('Editorial profile bootstrap missing.');
}

$layouts = glob($root . '/template/template-single-post-layout-*.php');
foreach ($layouts as $layout) {
	$content = (string) file_get_contents($layout);
	if (false === strpos($content, "get_template_part('template-parts/share-buttons')")) {
		throw new RuntimeException('Central share component missing in ' . basename($layout));
	}
	if (false !== strpos($content, 'link-social-facebook')) {
		throw new RuntimeException('Legacy share markup remains in ' . basename($layout));
	}
}

echo "Smart eMagazine editorial sharing contract OK\n";
