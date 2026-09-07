<?php
defined('ABSPATH') || exit;

final class SEM_Admin_Support {
	private const MENU_SLUG = 'sem-dashboard';

	public static function register(): void {
		add_action('admin_menu', array(__CLASS__, 'menu'), 5);
		add_action('admin_enqueue_scripts', array(__CLASS__, 'assets'));
	}

	public static function pages(): array {
		return array(
			array('slug' => self::MENU_SLUG, 'title' => __('Dashboard', SEM_TEXT_DOMAIN), 'description' => __('Stato del tema e accessi rapidi.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-dashboard', 'callback' => 'dashboard_page', 'section' => __('Panoramica', SEM_TEXT_DOMAIN)),
			array('slug' => 'sem-design', 'title' => __('Design', SEM_TEXT_DOMAIN), 'description' => __('Customizer, widget e identita visiva.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-art', 'callback' => 'design_page', 'section' => __('Configurazione', SEM_TEXT_DOMAIN)),
			array('slug' => 'sem-menus', 'title' => __('Menu', SEM_TEXT_DOMAIN), 'description' => __('Posizioni e navigazione editoriale.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-menu-alt3', 'callback' => 'menus_page', 'section' => __('Configurazione', SEM_TEXT_DOMAIN)),
			array('slug' => 'sem-integrations', 'title' => __('Integrazioni', SEM_TEXT_DOMAIN), 'description' => __('Dipendenze e plugin consigliati.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-admin-plugins', 'callback' => 'integrations_page', 'section' => __('Sistema', SEM_TEXT_DOMAIN)),
			array('slug' => 'sem-system', 'title' => __('Sistema', SEM_TEXT_DOMAIN), 'description' => __('Aggiornamenti e diagnostica tecnica.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-shield-alt', 'callback' => 'system_page', 'section' => __('Sistema', SEM_TEXT_DOMAIN)),
			array('slug' => 'sem-support', 'title' => __('Assistenza', SEM_TEXT_DOMAIN), 'description' => __('Guide, report e percorso di supporto.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-sos', 'callback' => 'support_page', 'section' => __('Supporto', SEM_TEXT_DOMAIN)),
		);
	}

	public static function menu(): void {
		add_menu_page(SEM_THEME_NAME, SEM_THEME_NAME, 'edit_theme_options', self::MENU_SLUG, array(__CLASS__, 'dashboard_page'), 'dashicons-welcome-widgets-menus', 59);
		foreach (self::pages() as $page) {
			if ($page['slug'] === self::MENU_SLUG) {
				continue;
			}
			add_submenu_page(self::MENU_SLUG, SEM_THEME_NAME . ' - ' . $page['title'], $page['title'], 'edit_theme_options', $page['slug'], array(__CLASS__, $page['callback']));
		}

		global $submenu;
		if (isset($submenu[self::MENU_SLUG][0][0])) {
			$submenu[self::MENU_SLUG][0][0] = __('Dashboard', SEM_TEXT_DOMAIN);
		}
	}

	public static function assets(string $hook_suffix): void {
		if (strpos($hook_suffix, 'sem-') === false) {
			return;
		}
		wp_enqueue_style('sem-admin-hub', SEXM_DIR_URL . '/css/admin-hub.css', array('dashicons'), SEXM_VDATA);
	}

	private static function guard(): void {
		if (! current_user_can('edit_theme_options')) {
			wp_die(esc_html__('Accesso non autorizzato.', SEM_TEXT_DOMAIN));
		}
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

	private static function scheme(): array {
		$header = '#1d2327';
		$accent = '#2271b1';
		$text = '#ffffff';
		global $_wp_admin_css_colors;
		$scheme = get_user_option('admin_color') ?: 'fresh';
		if (! empty($_wp_admin_css_colors[$scheme])) {
			$colors = $_wp_admin_css_colors[$scheme];
			$header = sanitize_hex_color($colors->colors[0] ?? '') ?: $header;
			$accent = sanitize_hex_color($colors->colors['modern' === $scheme ? 1 : 2] ?? '') ?: $accent;
			$text = sanitize_hex_color($colors->icon_colors['current'] ?? '') ?: $text;
		}
		return array($header, $accent, $text);
	}

	private static function page(string $title, string $description, callable $content): void {
		self::guard();
		$current = isset($_GET['page']) ? sanitize_key((string) $_GET['page']) : self::MENU_SLUG;
		list($header, $accent, $text) = self::scheme();
		?>
		<div class="sem-admin" style="--sem-admin-header:<?php echo esc_attr($header); ?>;--sem-admin-accent:<?php echo esc_attr($accent); ?>;--sem-admin-accent-text:<?php echo esc_attr($text); ?>">
			<header class="sem-admin-header">
				<div class="sem-admin-brand"><span class="sem-admin-mark">Se</span><span><strong><?php echo esc_html(SEM_THEME_NAME); ?></strong><small><?php esc_html_e('Tema editoriale WordPress', SEM_TEXT_DOMAIN); ?></small></span></div>
				<div class="sem-admin-actions"><a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button"><span class="dashicons dashicons-art"></span><?php esc_html_e('Personalizza', SEM_TEXT_DOMAIN); ?></a><span class="sem-admin-version">v<?php echo esc_html(SEXM_VERSION); ?></span></div>
			</header>
			<div class="sem-admin-shell">
				<aside class="sem-admin-sidebar" aria-label="<?php esc_attr_e('Navigazione Smart eMagazine', SEM_TEXT_DOMAIN); ?>"><nav>
					<?php $section = ''; foreach (self::pages() as $page) : ?>
						<?php if ($section !== $page['section']) : $section = $page['section']; ?><div class="sem-admin-nav-section"><?php echo esc_html($section); ?></div><?php endif; ?>
						<a class="sem-admin-nav-item<?php echo $current === $page['slug'] ? ' is-active' : ''; ?>" href="<?php echo esc_url(admin_url('admin.php?page=' . $page['slug'])); ?>"><span class="dashicons <?php echo esc_attr($page['icon']); ?>"></span><span><strong><?php echo esc_html($page['title']); ?></strong><small><?php echo esc_html($page['description']); ?></small></span></a>
					<?php endforeach; ?>
				</nav></aside>
				<main class="sem-admin-main"><div class="sem-admin-path"><a href="<?php echo esc_url(admin_url('admin.php?page=' . self::MENU_SLUG)); ?>"><?php echo esc_html(SEM_THEME_NAME); ?></a><span>/</span><?php echo esc_html($title); ?></div><div class="sem-admin-body"><div class="sem-admin-page-title"><h1><?php echo esc_html($title); ?></h1><p><?php echo esc_html($description); ?></p></div><?php call_user_func($content); ?></div></main>
			</div>
			<footer class="sem-admin-footer"><?php echo esc_html(SEM_THEME_NAME . ' v' . SEXM_VERSION); ?> <span>&middot;</span> <a href="https://smartecommerce.it" target="_blank" rel="noopener noreferrer">Smart eCommerce</a></footer>
		</div>
		<?php
	}

	private static function cards(array $cards): void {
		echo '<div class="sem-admin-cards">';
		foreach ($cards as $card) {
			echo '<a class="sem-admin-card" href="' . esc_url($card['url']) . '"><span class="dashicons ' . esc_attr($card['icon']) . '"></span><span><strong>' . esc_html($card['title']) . '</strong><small>' . esc_html($card['description']) . '</small></span></a>';
		}
		echo '</div>';
	}

	public static function dashboard_page(): void {
		self::page(__('Dashboard', SEM_TEXT_DOMAIN), __('Panoramica del tema e accesso rapido alle funzioni editoriali.', SEM_TEXT_DOMAIN), static function () {
			$menu_count = count(array_filter(get_nav_menu_locations()));
			$info = array(
				array(__('Versione', SEM_TEXT_DOMAIN), SEXM_VERSION, 'dashicons-tag'),
				array(__('Customizer', SEM_TEXT_DOMAIN), defined('MZR_VERSION') ? __('Disponibile', SEM_TEXT_DOMAIN) : __('Da verificare', SEM_TEXT_DOMAIN), 'dashicons-art'),
				array(__('Menu assegnati', SEM_TEXT_DOMAIN), (string) $menu_count, 'dashicons-menu-alt3'),
				array(__('Aggiornamenti', SEM_TEXT_DOMAIN), __('Smart Repository', SEM_TEXT_DOMAIN), 'dashicons-update'),
			);
			echo '<div class="sem-admin-stats">';
			foreach ($info as $item) echo '<div class="sem-admin-stat"><span class="dashicons ' . esc_attr($item[2]) . '"></span><span><small>' . esc_html($item[0]) . '</small><strong>' . esc_html($item[1]) . '</strong></span></div>';
			echo '</div><h2>' . esc_html__('Strumenti', SEM_TEXT_DOMAIN) . '</h2>';
			self::cards(array(
				array('title' => __('Personalizza il tema', SEM_TEXT_DOMAIN), 'description' => __('Logo, social, articoli, redazione ed editore.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-art', 'url' => admin_url('customize.php')),
				array('title' => __('Gestisci i menu', SEM_TEXT_DOMAIN), 'description' => __('Assegna navigazioni alle posizioni editoriali.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-menu-alt3', 'url' => admin_url('nav-menus.php')),
				array('title' => __('Controlla il sistema', SEM_TEXT_DOMAIN), 'description' => __('Compatibilita, aggiornamenti e ambiente.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-shield-alt', 'url' => admin_url('admin.php?page=sem-system')),
			));
		});
	}

	public static function design_page(): void {
		self::page(__('Design', SEM_TEXT_DOMAIN), __('Controlla l aspetto del tema con gli strumenti nativi WordPress.', SEM_TEXT_DOMAIN), static function () {
			self::cards(array(
				array('title' => __('Customizer', SEM_TEXT_DOMAIN), 'description' => __('Configura identita, social, articoli e dati editoriali.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-admin-customizer', 'url' => admin_url('customize.php')),
				array('title' => __('Widget', SEM_TEXT_DOMAIN), 'description' => __('Gestisci le aree widget disponibili nel tema.', SEM_TEXT_DOMAIN), 'icon' => 'dashicons-welcome-widgets-menus', 'url' => admin_url('widgets.php')),
			));
		});
	}

	public static function menus_page(): void {
		self::page(__('Menu', SEM_TEXT_DOMAIN), __('Posizioni di navigazione del tema editoriale legacy.', SEM_TEXT_DOMAIN), static function () {
			$locations = get_registered_nav_menus();
			$assigned = get_nav_menu_locations();
			echo '<table class="widefat striped"><thead><tr><th>' . esc_html__('Posizione', SEM_TEXT_DOMAIN) . '</th><th>' . esc_html__('Menu assegnato', SEM_TEXT_DOMAIN) . '</th></tr></thead><tbody>';
			foreach ($locations as $slug => $label) {
				$menu = !empty($assigned[$slug]) ? wp_get_nav_menu_object($assigned[$slug]) : false;
				echo '<tr><th scope="row">' . esc_html($label) . '<br><code>' . esc_html($slug) . '</code></th><td>' . esc_html($menu ? $menu->name : __('Non assegnato', SEM_TEXT_DOMAIN)) . '</td></tr>';
			}
			echo '</tbody></table><p><a class="button button-primary" href="' . esc_url(admin_url('nav-menus.php?action=locations')) . '">' . esc_html__('Gestisci le posizioni', SEM_TEXT_DOMAIN) . '</a> <a class="button" href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Modifica i menu', SEM_TEXT_DOMAIN) . '</a></p>';
		});
	}

	public static function integrations_page(): void {
		self::page(__('Integrazioni', SEM_TEXT_DOMAIN), __('Dipendenze tecniche e plugin opzionali riconosciuti dal tema.', SEM_TEXT_DOMAIN), static function () {
			$plugins = array(
				array('Smart Bootstrap Manager', 'smart-bootstrap-manager/smart-bootstrap-manager.php', true),
				array('Smart Advertising', 'smart-advertising-manager/smart-advertising-manager.php', false),
				array('Smart SEO Dots', 'smart-seo-dots/smart-seo-dots.php', false),
				array('Smart WordPress Lite Core', 'smart-wordpress-lite-core/smart-wordpress-lite-core.php', false),
			);
			echo '<div class="sem-admin-integrations">';
			foreach ($plugins as $plugin) {
				$active = is_plugin_active($plugin[1]);
				echo '<div><span class="dashicons ' . ($active ? 'dashicons-yes-alt' : 'dashicons-marker') . '"></span><span><strong>' . esc_html($plugin[0]) . '</strong><small>' . esc_html($plugin[2] ? __('Dipendenza per design system e controlli Customizer.', SEM_TEXT_DOMAIN) : __('Integrazione opzionale.', SEM_TEXT_DOMAIN)) . '</small></span><b class="' . ($active ? 'is-active' : '') . '">' . esc_html($active ? __('Attivo', SEM_TEXT_DOMAIN) : __('Non attivo', SEM_TEXT_DOMAIN)) . '</b></div>';
			}
			echo '</div>';
		});
	}

	public static function system_page(): void {
		self::page(__('Sistema', SEM_TEXT_DOMAIN), __('Compatibilita, aggiornamenti e diagnostica essenziale del tema.', SEM_TEXT_DOMAIN), static function () {
			echo '<table class="widefat striped"><tbody>';
			foreach (self::diagnostics() as $label => $value) echo '<tr><th scope="row">' . esc_html($label) . '</th><td>' . esc_html((string) $value) . '</td></tr>';
			echo '</tbody></table><p><a class="button button-primary" href="' . esc_url(wp_nonce_url(self_admin_url('admin-post.php?action=sem_check_updates'), 'sem_check_updates')) . '">' . esc_html__('Controlla aggiornamenti', SEM_TEXT_DOMAIN) . '</a></p>';
		});
	}

	public static function support_page(): void {
		self::page(__('Assistenza', SEM_TEXT_DOMAIN), __('Guide, controlli preliminari e dati tecnici per ricevere supporto.', SEM_TEXT_DOMAIN), static function () {
			echo '<h2>' . esc_html__('Prima di richiedere assistenza', SEM_TEXT_DOMAIN) . '</h2><ol><li>' . esc_html__('Aggiorna WordPress e il tema.', SEM_TEXT_DOMAIN) . '</li><li>' . esc_html__('Verifica il problema con cache e ottimizzazioni temporaneamente disattivate.', SEM_TEXT_DOMAIN) . '</li><li>' . esc_html__('Indica la pagina interessata e i passaggi per riprodurre il problema.', SEM_TEXT_DOMAIN) . '</li></ol>';
			echo '<p><a class="button button-primary" href="https://kb.smartecommerce.it/" target="_blank" rel="noopener noreferrer">' . esc_html__('Apri la Knowledge Base', SEM_TEXT_DOMAIN) . '</a> <a class="button" href="https://smartecommerce.it/contatti/" target="_blank" rel="noopener noreferrer">' . esc_html__('Contatta Smart eCommerce', SEM_TEXT_DOMAIN) . '</a></p>';
			$lines = array(); foreach (self::diagnostics() as $label => $value) $lines[] = $label . ': ' . $value;
			echo '<h2>' . esc_html__('Report tecnico', SEM_TEXT_DOMAIN) . '</h2><p>' . esc_html__('Il report non contiene password, token, email o contenuti del sito.', SEM_TEXT_DOMAIN) . '</p><textarea class="large-text code" rows="13" readonly>' . esc_textarea(implode("\n", $lines)) . '</textarea>';
		});
	}
}

SEM_Admin_Support::register();
