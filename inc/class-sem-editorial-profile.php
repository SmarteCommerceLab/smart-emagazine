<?php
/**
 * Campi del profilo redazione per autori e collaboratori.
 *
 * @package Smart_eMagazine
 */

if (!defined('ABSPATH')) {
	exit;
}

final class SEM_Editorial_Profile {
	private const FIELDS = array(
		'sem_editorial_role' => array('label' => 'Ruolo in redazione', 'type' => 'text'),
		'facebook'            => array('label' => 'Facebook', 'type' => 'url'),
		'twitter'             => array('label' => 'X / Twitter', 'type' => 'url'),
		'instagram'           => array('label' => 'Instagram', 'type' => 'url'),
		'youtube'             => array('label' => 'YouTube', 'type' => 'url'),
		'linkedin'            => array('label' => 'LinkedIn', 'type' => 'url'),
	);

	public static function register(): void {
		add_action('show_user_profile', array(__CLASS__, 'render'));
		add_action('edit_user_profile', array(__CLASS__, 'render'));
		add_action('personal_options_update', array(__CLASS__, 'save'));
		add_action('edit_user_profile_update', array(__CLASS__, 'save'));
	}

	public static function render(WP_User $user): void {
		if (!current_user_can('edit_user', $user->ID)) {
			return;
		}
		wp_nonce_field('sem_editorial_profile_' . $user->ID, 'sem_editorial_profile_nonce');
		?>
		<h2><?php esc_html_e('Smart eMagazine - Profilo redazione', SEM_TEXT_DOMAIN); ?></h2>
		<table class="form-table" role="presentation">
			<?php foreach (self::FIELDS as $key => $field) : ?>
			<tr>
				<th><label for="<?php echo esc_attr($key); ?>"><?php echo esc_html__($field['label'], SEM_TEXT_DOMAIN); ?></label></th>
				<td><input class="regular-text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" type="<?php echo esc_attr($field['type']); ?>" value="<?php echo esc_attr(get_user_meta($user->ID, $key, true)); ?>"></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
	}

	public static function save(int $user_id): void {
		$nonce = isset($_POST['sem_editorial_profile_nonce']) ? sanitize_text_field(wp_unslash($_POST['sem_editorial_profile_nonce'])) : '';
		if (!current_user_can('edit_user', $user_id) || !wp_verify_nonce($nonce, 'sem_editorial_profile_' . $user_id)) {
			return;
		}
		foreach (self::FIELDS as $key => $field) {
			$value = isset($_POST[$key]) ? wp_unslash($_POST[$key]) : '';
			$value = 'url' === $field['type'] ? esc_url_raw($value) : sanitize_text_field($value);
			update_user_meta($user_id, $key, $value);
		}
	}
}

SEM_Editorial_Profile::register();

function sem_get_editorial_role(int $user_id): string {
	return sanitize_text_field((string) get_user_meta($user_id, 'sem_editorial_role', true));
}
