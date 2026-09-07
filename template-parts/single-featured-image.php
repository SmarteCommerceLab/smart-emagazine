<?php
/**
 * Featured image and caption used by single-post layouts.
 *
 * @package Smart_eMagazine
 */

if (! has_post_thumbnail()) {
	return;
}

$figure_class  = isset($args['figure_class']) ? (string) $args['figure_class'] : 'figure text-center d-table mx-auto';
$image_class   = isset($args['image_class']) ? (string) $args['image_class'] : 'img-fluid figure-img skip-lazy my-0';
$caption_class = isset($args['caption_class']) ? (string) $args['caption_class'] : 'figure-caption text-start text-muted text-lowercase small';
$caption       = get_the_post_thumbnail_caption();
?>
<figure class="<?php echo esc_attr($figure_class); ?>">
	<?php
	the_post_thumbnail(
		'large',
		array(
			'decoding'      => 'async',
			'fetchpriority' => 'high',
			'class'         => $image_class,
			'alt'           => get_the_title(),
			'title'         => get_the_title(),
		)
	);
	?>
	<?php if ($caption !== '') : ?>
		<figcaption class="<?php echo esc_attr($caption_class); ?>"><span class="small"><?php echo esc_html($caption); ?></span></figcaption>
	<?php endif; ?>
</figure>
