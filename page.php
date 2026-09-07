<?php get_header('page'); ?>
<main class="container site-main">
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){seodots_bootstrap_breadcrumbs();}}?>
    <div class="p-1">
    <?php while ( have_posts() ) : the_post();?>
		<?php if (has_post_thumbnail()){?>
            <figure class="figure text-center d-table mx-auto">
                <?php the_post_thumbnail('large',array(
                    'decoding'		=> "async",
                    'fetchpriority'	=> "high",
                    'class'			=> "img-fluid figure-img mx-auto- d-block-"
                ));?>
                <?php $caption = get_the_post_thumbnail_caption();if(isset($caption) and !empty($caption)){?>
                <figcaption class="figure-caption text-start text-muted text-lowercase small"><span class="small"><?php echo get_the_post_thumbnail_caption();?></span></figcaption>
                <?php }?>
            </figure><hr>
        <?php }?>
   		<div class="p-1"><?php the_content();?></div>
    <?php endwhile;?>
    </div>
</main>
<?php get_footer('page'); ?>