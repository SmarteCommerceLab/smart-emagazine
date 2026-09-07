<?php
$root = dirname(__DIR__);
$combined = file_get_contents($root . '/functions.php') . file_get_contents($root . '/inc/class-sem-admin-support.php');
$metaboxes = file_get_contents($root . '/lib/post_occhiello.php') . file_get_contents($root . '/lib/post_layout.php') . file_get_contents($root . '/lib/post-script-disable.php') . file_get_contents($root . '/lib/metabox-security.php');
$pluginChecks = file_get_contents($root . '/lib/plugin-check.php');
$customizer = file_get_contents($root . '/lib/customizer.php');

foreach (array('wp_nonce_field', 'sem_can_save_metabox', 'sanitize_text_field', 'sanitize_key', 'sem_sanitize_slug_list_json') as $needle) {
	if (strpos($metaboxes, $needle) === false) { fwrite(STDERR, "Missing metabox protection: {$needle}\n"); exit(1); }
}
foreach (array('add_theme_page', 'Sistema', 'Assistenza', 'current_user_can', 'diagnostics', 'sem_check_updates') as $needle) {
	if (strpos($combined, $needle) === false) { fwrite(STDERR, "Missing admin support contract: {$needle}\n"); exit(1); }
}
foreach (array('header-index.php', 'footer-index.php', 'header-page.php', 'footer-page.php') as $file) {
	$content = file_get_contents($root . '/' . $file);
	$canonical = strpos($file, 'header-') === 0 ? 'header.php' : 'footer.php';
	if (strpos($content, "require __DIR__ . '/{$canonical}';") === false) { fwrite(STDERR, "Template wrapper is not consolidated: {$file}\n"); exit(1); }
}
if (strpos($pluginChecks, 'Plugin Richiesti per Smart eMagazine Theme : <strong>Smart Customizer Frameworks') !== false) {
	fwrite(STDERR, "Legacy Smart Customizer Framework dependency notice is still active.\n"); exit(1);
}
foreach (array('MZR_VERSION', 'Smart_Customizer_Control_Toggle_Checkbox') as $needle) {
	if (strpos($customizer, $needle) === false) { fwrite(STDERR, "Missing embedded SBM Customizer runtime gate: {$needle}\n"); exit(1); }
}
if (strpos($combined, "require_once ('lib/customizer.php');") === false
	|| strpos($combined, 'if(is_customize_preview())') !== false) {
	fwrite(STDERR, "Customizer hooks are still gated by an early preview-state check.\n"); exit(1);
}
if (strpos($customizer, 'smart_bootstrap_manager_load_customizer_framework') === false) {
	fwrite(STDERR, "Customizer does not explicitly bootstrap the embedded SCF runtime.\n"); exit(1);
}
if (strpos($pluginChecks, "'smart-advertising-manager/smart-advertising-manager.php' => 'Smart Advertising'") === false
	|| strpos($pluginChecks, 'Integrazioni opzionali non attive') === false) {
	fwrite(STDERR, "Smart Advertising is not identified as optional.\n"); exit(1);
}
echo "Smart eMagazine technical 2.0 contract OK.\n";
