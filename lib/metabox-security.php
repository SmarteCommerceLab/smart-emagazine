<?php
defined('ABSPATH') || exit;

function sem_can_save_metabox(int $post_id, string $nonce_field, string $action): bool {
	if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return false;
	if (!current_user_can('edit_post', $post_id) || !isset($_POST[$nonce_field])) return false;
	return wp_verify_nonce(sanitize_text_field(wp_unslash($_POST[$nonce_field])), $action) !== false;
}

function sem_sanitize_slug_list_json($value): string {
	$decoded = json_decode((string) wp_unslash($value), true);
	if (!is_array($decoded)) return '[]';
	$clean = array();
	foreach ($decoded as $item) {
		$slug = is_array($item) ? sanitize_key((string) ($item['slug'] ?? '')) : '';
		if ($slug !== '') $clean[] = array('slug' => $slug);
	}
	return wp_json_encode($clean);
}
