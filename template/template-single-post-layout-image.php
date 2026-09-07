<?php get_header('smart-site-builder');if ( have_posts() ) : while ( have_posts() ) : the_post();
	// == Exclude
	$e[]											= $post->ID;
	// == Get Category
	$category 										= get_post_primary_category($post->ID);
	$category 										= $category['primary_category'];
	#https://materialui.co/socialcolors
?>
<main id="main" class="container site-main layout-image overflow-hidden border-start border-end bg-white">
	<article id="post-<?php echo $post->ID;?>">
		<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){
            seodots_bootstrap_breadcrumbs($data = array( 'class' => 'mb-4' ));
        }}?>
		<?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-masthead',false);}?>
		<div class="row d-flex justify-content-between align-items-top">
            <div class="col-12 col-lg-6 order-lg-2 mb-4">
				<?php get_template_part('template-parts/single-featured-image', null, array('figure_class' => 'figure text-center d-table mx-auto mb-0', 'image_class' => 'img-fluid figure-img skip-lazy my-0', 'caption_class' => 'figure-caption text-center text-muted text-lowercase small')); ?>
            </div>        
        	<header class="col-12 col-lg-6 order-lg-1 mb-4">
            	<hgroup>
					<?php the_title('<h1 class="entry-title">','</h1>');?>
					<?php the_sub_title('<h2 class="text-start small fw-normal text-muted">','</h2>');?>
                </hgroup>
            </header>
        </div>
        <div class="d-md-flex justify-content-md-between align-items-center mb-4 border-top border-bottom">
            <?php get_template_part('template-parts/single-author-meta', null, array('class' => 'd-flex justify-content-start align-items-center small my-4')); ?>
            <div id="post-<?php echo $post->ID;?>-single-share" class="py-4 py-lg-0 border-only-xs-top text-muted">
                <?php get_template_part('template-parts/share-buttons'); ?>
            </div>        
        </div>
        <div class="row mb-4">
        	<div class="col-12 col-lg-8 col-xl-8 border-end">
            	<article id="post-<?php echo $post->ID;?>-article">
					<?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-title',false);}?> 
                    <?php #if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-above',false);}?>
                    <?php the_content();?>
                    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-bottom',false);}?>
                    <?php get_template_part('template-parts/single-tags'); ?>
                    <?php get_template_part('template-parts/single-author-box'); ?>
                    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-below',false);}?>                    
                </article>
            </div>
			<aside class="col-12 col-lg-4 col-xl-4 d-flex-column justify-content-center">
				<?php 	
                    $single_relative_link = new semComposeWidget($category->slug,$category->slug,'category','sololinks',NULL,NULL,$e);
                    if(isset($single_relative_link->esclude_post) and !empty($single_relative_link->esclude_post)){$e = $single_relative_link->esclude_post;}
                ?>
                <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-above',false);}?>
            </aside>
        </div>
        <aside>
        	<?php if($option = sem_option_check_true('sem-article-next-prev')){sec_post_next_previous();}?>
            <?php if($option = sem_option_check_true('sem-article-related-link')){?>
                <?php 	
                    $single_relative_link = new semComposeWidget($category->slug,$category->slug,'category','links',NULL,NULL,$e);
                    if(isset($single_relative_link->esclude_post) and !empty($single_relative_link->esclude_post)){$e = $single_relative_link->esclude_post;}
                ?>
                <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-links',false);}?>
            <?php }?>
            <?php if($option = sem_option_check_true('sem-article-related')){?> 
                <?php
                    $single_relative = new semComposeWidget($category->slug,$category->slug,'category','relativi',NULL,NULL,$e);
                    if(isset($single_relative->esclude_post) and !empty($single_relative->esclude_post)){$e = $single_relative->esclude_post;}
                ?>
                <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-related',false);}?>
            <?php }?>        
        </aside>            
    </article>
</main>
<?php endwhile;wp_reset_postdata();else:endif;get_footer('smart-site-builder');?>