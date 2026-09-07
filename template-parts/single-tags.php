<?php
/**
 * Taxonomy links used by single-post layouts.
 *
 * @package Smart_eMagazine
 */

$tags = get_the_tags();
if (! $tags || is_wp_error($tags)) {
	return;
}
?>
<div class="single-tag text-center mb-3 border-bottom">
	<ul class="list-inline text-primary-hover mt-2 mt-lg-3 py-2">
		<li class="list-inline-item fw-bold"><i class="fa-solid fa-tags" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Tag:', 'smart-emagazine'); ?></span></li>
		<?php foreach ($tags as $tag) : ?>
			<li class="list-inline-item">
				<a class="link text-first-capitalize text-primary" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
