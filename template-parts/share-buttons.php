<?php
/**
 * Condivisione articolo centralizzata, senza dipendenze JavaScript esterne.
 *
 * @package Smart_eMagazine
 */

if (!defined('ABSPATH')) {
	exit;
}

$share_url   = rawurlencode(get_permalink());
$share_title = rawurlencode(get_the_title());
$channels    = array(
	array('label' => 'Facebook', 'icon' => 'fa-brands fa-facebook-f', 'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url),
	array('label' => 'X', 'icon' => 'fa-brands fa-x-twitter', 'url' => 'https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_title),
	array('label' => 'WhatsApp', 'icon' => 'fa-brands fa-whatsapp', 'url' => 'https://api.whatsapp.com/send?text=' . $share_title . '%20' . $share_url),
	array('label' => 'LinkedIn', 'icon' => 'fa-brands fa-linkedin-in', 'url' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url),
);
?>
<div class="sem-share-buttons d-flex flex-row flex-md-column gap-2 mb-4" aria-label="<?php esc_attr_e('Condivisione articolo', SEM_TEXT_DOMAIN); ?>">
	<?php foreach ($channels as $channel) : ?>
		<a class="link link-social text-center text-muted p-2 border"
			href="<?php echo esc_url($channel['url']); ?>"
			title="<?php echo esc_attr(sprintf(__('Condividi su %s', SEM_TEXT_DOMAIN), $channel['label'])); ?>"
			aria-label="<?php echo esc_attr(sprintf(__('Condividi su %s', SEM_TEXT_DOMAIN), $channel['label'])); ?>"
			target="_blank" rel="noopener noreferrer nofollow">
			<i class="<?php echo esc_attr($channel['icon']); ?> fa-xl" aria-hidden="true"></i>
		</a>
	<?php endforeach; ?>
	<button class="link link-social text-center text-muted p-2 border sem-native-share" type="button"
		title="<?php esc_attr_e('Condividi', SEM_TEXT_DOMAIN); ?>"
		aria-label="<?php esc_attr_e('Condividi', SEM_TEXT_DOMAIN); ?>"
		onclick="if(navigator.share){navigator.share({title:document.title,url:location.href})}">
		<i class="fa-solid fa-share-nodes fa-xl" aria-hidden="true"></i>
	</button>
</div>
