<?php
defined('ABSPATH') || exit;

add_action('add_meta_boxes', static function (): void {
	add_meta_box('post_layout_box', __('Smart eMagazine - Layout articolo', SEM_TEXT_DOMAIN), 'sem_layout_metabox', 'post');
});

function sem_layout_metabox(WP_Post $post): void {
	wp_nonce_field('sem_save_layout', 'sem_layout_nonce');
	$current = (string) get_post_meta($post->ID, 'sem-post-layout-selected-value', true);
	$layouts = array(
		'' => array('Regular', 'smart-site-layout-default.png'),
		'sem-layout-single-medium' => array('Inside', 'smart-site-layout-medium.png'),
		'sem-layout-single-side' => array('Sidebar', 'smart-site-layout-side.png'),
		'sem-layout-single-line' => array('Linear', 'smart-site-layout-line.png'),
		'sem-layout-single-image' => array('Image', 'smart-site-layout-image.png'),
	);
	echo '<p>' . esc_html__('Scegli il layout usato soltanto da questo articolo.', SEM_TEXT_DOMAIN) . '</p><div class="sem-layout-selector">';
	foreach ($layouts as $value => $layout) {
		echo '<label class="sem-layout-selector-section"><input type="radio" name="sem-post-layout-selected-value" value="' . esc_attr($value) . '" ' . checked($current, $value, false) . '>';
		echo '<img src="' . esc_url(SEXM_DIR_URL . '/img/' . $layout[1]) . '" alt=""><span><strong>' . esc_html($layout[0]) . '</strong></span></label>';
	}
	echo '</div>';
}

add_action('save_post_post', static function (int $post_id): void {
	if (!sem_can_save_metabox($post_id, 'sem_layout_nonce', 'sem_save_layout')) return;
	$allowed = array('', 'sem-layout-single-medium', 'sem-layout-single-side', 'sem-layout-single-line', 'sem-layout-single-image');
	$value = isset($_POST['sem-post-layout-selected-value']) ? sanitize_key(wp_unslash($_POST['sem-post-layout-selected-value'])) : '';
	if (!in_array($value, $allowed, true) || $value === '') delete_post_meta($post_id, 'sem-post-layout-selected-value');
	else update_post_meta($post_id, 'sem-post-layout-selected-value', $value);
});
