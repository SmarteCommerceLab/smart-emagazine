<?php
defined('ABSPATH') || exit;

final class SEM_Admin_Support {
	public static function register(): void {
		add_action('admin_menu', array(__CLASS__, 'menu'));
	}

	public static function menu(): void {
		add_theme_page(__('Smart eMagazine - Sistema', SEM_TEXT_DOMAIN), __('Smart eMagazine - Sistema', SEM_TEXT_DOMAIN), 'manage_options', 'sem-system', array(__CLASS__, 'system_page'));
		add_theme_page(__('Smart eMagazine - Assistenza', SEM_TEXT_DOMAIN), __('Smart eMagazine - Assistenza', SEM_TEXT_DOMAIN), 'manage_options', 'sem-support', array(__CLASS__, 'support_page'));
	}

	private static function diagnostics(): array {
		$uploads = wp_get_upload_dir();
		return array(
			__('Tema', SEM_TEXT_DOMAIN) => SEM_THEME_NAME . ' ' . SEXM_VERSION,
			__('WordPress', SEM_TEXT_DOMAIN) => get_bloginfo('version'),
			__('PHP', SEM_TEXT_DOMAIN) => PHP_VERSION,
			__('HTTPS', SEM_TEXT_DOMAIN) => is_ssl() ? __('Attivo', SEM_TEXT_DOMAIN) : __('Non attivo', SEM_TEXT_DOMAIN),
			__('REST API', SEM_TEXT_DOMAIN) => rest_url(),
			__('Permalink', SEM_TEXT_DOMAIN) => get_option('permalink_structure') ?: __('Semplici', SEM_TEXT_DOMAIN),
			__('Memoria PHP', SEM_TEXT_DOMAIN) => ini_get('memory_limit') ?: __('Non disponibile', SEM_TEXT_DOMAIN),
			__('WP_DEBUG', SEM_TEXT_DOMAIN) => defined('WP_DEBUG') && WP_DEBUG ? __('Attivo', SEM_TEXT_DOMAIN) : __('Disattivo', SEM_TEXT_DOMAIN),
			__('Cron WordPress', SEM_TEXT_DOMAIN) => defined('DISABLE_WP_CRON') && DISABLE_WP_CRON ? __('Disabilitato', SEM_TEXT_DOMAIN) : __('Attivo', SEM_TEXT_DOMAIN),
			__('Cartella upload', SEM_TEXT_DOMAIN) => empty($uploads['error']) && wp_is_writable($uploads['basedir']) ? __('Scrivibile', SEM_TEXT_DOMAIN) : __('Da verificare', SEM_TEXT_DOMAIN),
			__('Tema child', SEM_TEXT_DOMAIN) => is_child_theme() ? wp_get_theme()->get('Name') : __('Non attivo', SEM_TEXT_DOMAIN),
		);
	}

	private static function guard(): void {
		if (!current_user_can('manage_options')) wp_die(esc_html__('Accesso non autorizzato.', SEM_TEXT_DOMAIN));
	}

	private static function page_header(string $title, string $description): void {
		echo '<div class="wrap"><h1>' . esc_html($title) . '</h1><p>' . esc_html($description) . '</p><hr>';
	}

	public static function system_page(): void {
		self::guard();
		self::page_header(__('Sistema', SEM_TEXT_DOMAIN), __('Compatibilità, aggiornamenti e diagnostica essenziale del tema.', SEM_TEXT_DOMAIN));
		echo '<table class="widefat striped" style="max-width:900px"><tbody>';
		foreach (self::diagnostics() as $label => $value) echo '<tr><th scope="row" style="width:240px">' . esc_html($label) . '</th><td>' . esc_html((string) $value) . '</td></tr>';
		echo '</tbody></table><p><a class="button button-primary" href="' . esc_url(wp_nonce_url(self_admin_url('admin-post.php?action=sem_check_updates'), 'sem_check_updates')) . '">' . esc_html__('Controlla aggiornamenti', SEM_TEXT_DOMAIN) . '</a></p></div>';
	}

	public static function support_page(): void {
		self::guard();
		self::page_header(__('Assistenza', SEM_TEXT_DOMAIN), __('Guide, controlli preliminari e dati tecnici per ricevere supporto.', SEM_TEXT_DOMAIN));
		echo '<h2>' . esc_html__('Prima di richiedere assistenza', SEM_TEXT_DOMAIN) . '</h2><ol><li>' . esc_html__('Aggiorna WordPress e il tema.', SEM_TEXT_DOMAIN) . '</li><li>' . esc_html__('Verifica il problema con cache e ottimizzazioni temporaneamente disattivate.', SEM_TEXT_DOMAIN) . '</li><li>' . esc_html__('Indica la pagina interessata e i passaggi per riprodurre il problema.', SEM_TEXT_DOMAIN) . '</li></ol>';
		echo '<p><a class="button button-primary" href="https://kb.smartecommerce.it/" target="_blank" rel="noopener noreferrer">' . esc_html__('Apri la Knowledge Base', SEM_TEXT_DOMAIN) . '</a> <a class="button" href="https://smartecommerce.it/contatti/" target="_blank" rel="noopener noreferrer">' . esc_html__('Contatta Smart eCommerce', SEM_TEXT_DOMAIN) . '</a></p>';
		$lines = array();
		foreach (self::diagnostics() as $label => $value) $lines[] = $label . ': ' . $value;
		echo '<h2>' . esc_html__('Report tecnico', SEM_TEXT_DOMAIN) . '</h2><p>' . esc_html__('Il report non contiene password, token, email o contenuti del sito.', SEM_TEXT_DOMAIN) . '</p><textarea class="large-text code" rows="13" readonly>' . esc_textarea(implode("\n", $lines)) . '</textarea></div>';
	}
}

SEM_Admin_Support::register();
