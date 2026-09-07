<?php
/**
 * Full author biography used by single-post layouts.
 *
 * @package Smart_eMagazine
 */

$author_id = (int) get_the_author_meta('ID');
$networks  = array(
	'facebook'  => array('Facebook', 'fa-facebook-square'),
	'twitter'   => array('X', 'fa-square-x-twitter'),
	'instagram' => array('Instagram', 'fa-square-instagram'),
	'youtube'   => array('YouTube', 'fa-youtube-square'),
);
?>
<div class="single-author text-center text-sm-start mb-3" id="single-author" name="single-author">
	<div class="row d-flex justify-content-center justify-content-sm-start align-items-top">
		<div class="col-12 col-sm-2 text-center">
			<?php echo get_avatar($author_id, 100); ?>
		</div>
		<div class="col-12 col-sm-10">
			<p class="h5"><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="link"><span class="fw-bold"><?php echo esc_html(get_the_author()); ?></span></a></p>
			<p class="text-muted small"><?php echo esc_html(get_the_author_meta('user_description', $author_id)); ?></p>
			<div class="single-share">
				<?php foreach ($networks as $field => $network) : ?>
					<?php $url = get_the_author_meta($field, $author_id); ?>
					<?php if ($url !== '') : ?>
						<a class="link link-social-editor text-center text-primary me-2" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($network[0]); ?>" target="_blank" rel="nofollow noopener noreferrer"><i class="fa-brands <?php echo esc_attr($network[1]); ?> fa-lg" aria-hidden="true"></i></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
