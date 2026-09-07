<?php
defined('ABSPATH') || exit;

add_action('add_meta_boxes', static function (): void {
	add_meta_box('sec_post_sub_title', __('Smart eMagazine - Testi aggiuntivi', SEM_TEXT_DOMAIN), 'sem_subtitle_metabox', 'post', 'post_after_title', 'high');
});

function sem_subtitle_metabox(WP_Post $post): void {
	wp_nonce_field('sem_save_subtitle', 'sem_subtitle_nonce');
	$value = get_post_meta($post->ID, 'post-sub-title-value', true);
	echo '<p><strong>' . esc_html__('Occhiello', SEM_TEXT_DOMAIN) . '</strong><br><span>' . esc_html__('Aggiungi un sottotitolo all articolo.', SEM_TEXT_DOMAIN) . '</span></p>';
	echo '<input class="widefat" type="text" name="post-sub-title-value" value="' . esc_attr((string) $value) . '" placeholder="' . esc_attr__('Aggiungi sottotitolo', SEM_TEXT_DOMAIN) . '" autocomplete="off">';
}

add_action('save_post_post', static function (int $post_id): void {
	if (!sem_can_save_metabox($post_id, 'sem_subtitle_nonce', 'sem_save_subtitle')) return;
	$value = isset($_POST['post-sub-title-value']) ? sanitize_text_field(wp_unslash($_POST['post-sub-title-value'])) : '';
	if ($value === '') delete_post_meta($post_id, 'post-sub-title-value');
	else update_post_meta($post_id, 'post-sub-title-value', $value);
});

add_action('edit_form_after_title', static function (): void {
	global $post, $wp_meta_boxes;
	if (!$post instanceof WP_Post) return;
	do_meta_boxes(get_current_screen(), 'post_after_title', $post);
	unset($wp_meta_boxes['post']['post_after_title']);
});
