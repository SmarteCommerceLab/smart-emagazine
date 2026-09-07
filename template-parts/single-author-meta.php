<?php
/**
 * Compact author and publication metadata used by single-post layouts.
 *
 * @package Smart_eMagazine
 */

$wrapper_class = isset($args['class']) ? (string) $args['class'] : 'd-flex justify-content-start align-items-center small';
$author_id     = (int) get_the_author_meta('ID');
$role          = sem_get_editorial_role($author_id);
?>
<div class="<?php echo esc_attr($wrapper_class); ?>">
	<?php echo get_avatar($author_id, 70, '', '', array('class' => 'd-block me-2 img-thumbnail rounded-circle')); ?>
	<div>
		<a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="d-block link">
			<small><?php echo esc_html(get_the_author()); ?></small>
			<?php if ($role !== '') : ?>
				<small class="d-block text-muted"><?php echo esc_html($role); ?></small>
			<?php endif; ?>
		</a>
		<time class="single-time text-muted text-lowercase small" datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished">
			<span><?php esc_html_e('Pubblicato il ', 'smart-emagazine'); ?></span><?php echo esc_html(get_the_date('j F, Y')); ?>
		</time>
	</div>
</div>
