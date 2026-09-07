<?php
$root = dirname(__DIR__);
$notices = file_get_contents($root . '/lib/plugin-check.php');
$scripts = file_get_contents($root . '/lib/javascript_admin.php');
$styles = file_get_contents($root . '/lib/css-admin.php');

foreach (array('get_current_screen', "'themes'", 'Integrazioni opzionali non attive') as $needle) {
	if (strpos($notices, $needle) === false) { fwrite(STDERR, "Missing scoped notice contract: {$needle}\n"); exit(1); }
}
if (strpos($notices, 'Smart Customizer Frameworks') !== false) {
	fwrite(STDERR, "Legacy SCF dependency returned to notices.\n"); exit(1);
}
foreach (array("'post.php'", "'post-new.php'", "'post' !== \$screen->post_type") as $needle) {
	if (strpos($scripts, $needle) === false) { fwrite(STDERR, "Missing editor script scope: {$needle}\n"); exit(1); }
}
foreach (array("'themes.php'", 'toplevel_page_sem-dashboard', 'smart-emagazine_page_sem-', 'sem-admin') as $needle) {
	if (strpos($styles, $needle) === false) { fwrite(STDERR, "Missing administration style scope: {$needle}\n"); exit(1); }
}
echo "Smart eMagazine administration scope contract OK.\n";
