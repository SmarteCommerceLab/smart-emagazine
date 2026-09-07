<?php get_header('smart-site-builder');if ( have_posts() ) : while ( have_posts() ) : the_post();
	// == Exclude
	$e[]											= $post->ID;
	// == Get Category
	$category 										= get_post_primary_category($post->ID);
	$category 										= $category['primary_category'];
	#https://materialui.co/socialcolors
?>
<main id="main" class="container site-main layout-default overflow-hidden border-start border-end bg-white">
	<article id="post-<?php echo $post->ID;?>">
		<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){
            seodots_bootstrap_breadcrumbs($data = array( 'class' => 'mb-4' ));
        }}?>
		<?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-masthead',false);}?>
        <div class="row">
        	<header class="col-12 col-lg-8 border-lg-end mb-4">
                <hgroup>
                    <?php the_title('<h1 class="entry-title">','</h1>');?>
                    <?php the_sub_title('<h2 class="text-start small fw-normal text-muted">','</h2>');?>     
                </hgroup>
            </header>
            <div class="col-12 col-lg-4">
            	<div class="d-flex justify-content-start align-items-center border-only-xs-top border-only-md-top py-4 py-lg-0 small">
					<?php echo get_avatar( get_the_author_meta('ID'), $size = '70', $default = '', $alt = '', $args = array( 'class' => 'd-block me-2 img-thumbnail rounded-circle' ))?>
                    <div>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="d-block link">
                            <small><?php echo get_the_author(); ?></small>
                        </a>
                        <time pubdate class="single-time text-muted text-lowercase small" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished" >
                            <span>Pubblicato il </span><?php echo get_the_date('j F, Y') ?>
                        </time>
                    </div>                
                </div>
            </div>
        </div>
        <div class="row">
            <aside class="col-12 col-md-1">
            	<div class="d-flex justify-content-start align-items-center text-muted flex-md-column mb-4 border-only-xs-top border-only-xs-bottom py-4 py-md-0">
                    <a 
                    class	= "link link-social link-social-facebook text-center text-muted p-2 me-2 m-xl-0 border" 
                    href	= "https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" 
                    title 	= "<?php the_title(); ?>" 
                    target 	= "_blank" 
                    rel 	= "noopener"
                    ><i class="fa-brands fa-facebook fa-xl"></i></a>
                    <a 
                    class	= "link link-social link-social-twitter text-center text-muted p-2 me-2 m-xl-0 border"
                    href	= "https://twitter.com/intent/tweet?url=<?php the_permalink();?>"
                    title 	= "<?php the_title(); ?>" 
                    target 	= "_blank" 
                    rel 	= "noopener" 
                    ><i class="fa-brands fa-x-twitter fa-xl"></i></a>
                    <a 
                    class	= "link link-social link-social-whatsapp text-center text-muted p-2 me-2 m-xl-0 border"
                    href	= "whatsapp://send?text=<?php the_permalink();?>" 
                    title 	= "<?php the_title(); ?>" 
                    target 	= "_blank" 
                    rel 	= "noopener" 
                    ><i class="fa-brands fa-whatsapp fa-xl"></i></a>
                    <a 
                    class	= "link link-social link-social-linkedin text-center text-muted p-2 me-2 m-xl-0 border"
                    href	= "https://www.linkedin.com/cws/share?url=<?php the_permalink();?>"
                    title 	= "<?php the_title(); ?>" 
                    target 	= "_blank" 
                    rel 	= "noopener" 
                    ><i class="fa-brands fa-linkedin-in fa-xl"></i></a>
                    <a 
                    class	= "link link-social link-social-primary text-center text-muted p-2 border"
                    onclick	= 'window.navigator.share({title: "Condividi adesso: "+document.documentURI,text: "",url: "",});'
                    title 	= 'Condividi adesso'
                    ><i class="fa-solid fa-share-nodes fa-xl"></i></a>                
                </div>
            </aside>
            <div class="col-12 col-md-11 col-lg-7 border-start border-end">
            	<article id="post-<?php echo $post->ID;?>-article">
					<?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-title',false);}?>
                    <?php if (has_post_thumbnail()){?>
                        <figure class="figure text-center d-table mx-auto">
                            <?php the_post_thumbnail('large',array(
                                'decoding'		=> "async",
                                'fetchpriority'	=> "high",
                                'class'			=> "img-fluid figure-img mx-auto- d-block- skip-lazy mb-3- my-0",
                                'alt'			=> get_the_title(),
                                'title'			=> get_the_title()
                            ));?>
                            <?php $caption = get_the_post_thumbnail_caption();if(isset($caption) and !empty($caption)){?>
                            <figcaption class="figure-caption text-start text-muted text-lowercase small"><span class="small"><?php echo get_the_post_thumbnail_caption();?></span></figcaption>
                            <?php }?>
                        </figure>
                    <?php }?>
                    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-above',false);}?>
                    <?php the_content();?>
                    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-bottom',false);}?>
                    <div class="single-tag text-center mb-3 border-bottom">
                        <ul class="list-inline text-primary-hover mt-2 mt-lg-3 py-2">
                            <li class="list-inline-item fw-bold"><i class="fa-solid fa-tags"></i>&nbsp;</li>                    
                            <?php $wpbtags = get_the_tags($post->ID);foreach ($wpbtags as $tag) {?>
                                <li class="list-inline-item">
                                <a class="link text-first-capitalize text-primary" href="<?php echo get_tag_link($tag->term_id) ?>" title="<?php echo $tag->name ?>"><?php echo $tag->name ?></a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="single-author text-center text-sm-start mb-3" name="single-author">
                        <div class="row d-flex justify-content-center justify-content-sm-start align-items-top">
                            <div class="col-12 col-sm-2 text-center">
                                <?php echo get_avatar( get_the_author_meta('ID'), 100)?>
                            </div>
                            <div class="col-12 col-sm-10">
                                <p class="h5">
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                        <span class="fw-bold"><?php echo get_the_author(); ?></span>
                                    </a>
                                </p>
                                <p class="text-muted small"><?php echo get_the_author_meta('user_description',$post->post_author);?></p>
                                <div class="single-share">
                                    <?php if(!empty(get_the_author_meta( 'facebook', $post->post_author ))) 	{?>
                                        <a 
                                        class	= "link link-social-editor text-center text-primary me-2" 
                                        href	= "<?php echo get_the_author_meta( 'facebook', $post->post_author );?>" 
                                        title 	= "Facebook" 
                                        target 	= "_blank" 
                                        rel 	= "nofollow"
                                        ><i class="fa-brands fa-facebook-square fa-lg"></i></a>
                                    <?php }?>
                                    <?php if(!empty(get_the_author_meta( 'twitter', $post->post_author ))) 		{?>
                                        <a 
                                        class	= "link link-social-editor text-center text-primary me-2" 
                                        href	= "<?php echo get_the_author_meta( 'twitter', $post->post_author );?>" 
                                        title 	= "Twitter" 
                                        target 	= "_blank" 
                                        rel 	= "nofollow"
                                        ><i class="fa-brands fa-square-x-twitter fa-lg"></i></a>
                                    <?php }?>
                                    <?php if(!empty(get_the_author_meta( 'instagram', $post->post_author ))) 	{?>
                                        <a 
                                        class	= "link link-social-editor text-center text-primary me-2" 
                                        href	= "<?php echo get_the_author_meta( 'instagram', $post->post_author );?>" 
                                        title 	= "Instagram" 
                                        target 	= "_blank" 
                                        rel 	= "nofollow"
                                        ><i class="fa-brands fa-square-instagram fa-lg"></i></a>
                                    <?php }?>
                                    <?php if(!empty(get_the_author_meta( 'youtube', $post->post_author ))) 		{?>
                                        <a 
                                        class	= "link link-social-editor text-center text-primary me-2" 
                                        href	= "<?php echo get_the_author_meta( 'youtube', $post->post_author );?>" 
                                        title 	= "Youtube" 
                                        target 	= "_blank" 
                                        rel 	= "nofollow"
                                        ><i class="fa-brands fa-youtube-square fa-lg"></i></a>
                                    <?php }?>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-below',false);}?>
                </article> 
                <aside>
                	<?php if($option = sem_option_check_true('sem-article-related-link')){?>
                        <?php 	
                            $single_relative_link = new semComposeWidget($category->slug,$category->slug,'category','links',NULL,NULL,$e);
                            if(isset($single_relative_link->esclude_post) and !empty($single_relative_link->esclude_post)){$e = $single_relative_link->esclude_post;}
                        ?>
                        <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-links',false);}?>
                    <?php }?>
                    <?php if($option = sem_option_check_true('sem-article-next-prev')){sec_post_next_previous();}?>
                    <?php if($option = sem_option_check_true('sem-article-related')){?> 
                        <?php
                            $single_relative = new semComposeWidget($category->slug,$category->slug,'category','relativi',NULL,NULL,$e);
                            if(isset($single_relative->esclude_post) and !empty($single_relative->esclude_post)){$e = $single_relative->esclude_post;}
                        ?>
                        <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-related',false);}?>
                    <?php }?>                
                </aside>       
            </div>        
            <aside class="col-12 col-lg-4">
            	<div class="d-flex-column justify-content-center">
					<?php 	
                        $single_relative_link = new semComposeWidget($category->slug,$category->slug,'category','sololinks',NULL,NULL,$e);
                        if(isset($single_relative_link->esclude_post) and !empty($single_relative_link->esclude_post)){$e = $single_relative_link->esclude_post;}
                    ?>                
                </div>
            </aside>
        </div>
    </article>
</main>
<?php endwhile;wp_reset_postdata();else:endif;get_footer('smart-site-builder');?>