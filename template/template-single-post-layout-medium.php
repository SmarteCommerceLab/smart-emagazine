<?php get_header('smart-site-builder');if ( have_posts() ) : while ( have_posts() ) : the_post();
	// == Exclude
	$e[]											= $post->ID;
	// == Get Category
	$category 										= get_post_primary_category($post->ID);
	$category 										= $category['primary_category'];
	#https://materialui.co/socialcolors
?>
<main id="main" class="container site-main layout-medium overflow-hidden border-start border-end bg-white">
    <article id="post-<?php echo $post->ID;?>">
		<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){
            seodots_bootstrap_breadcrumbs($data = array( 'class' => 'mb-4' ));
        }}?>
        <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-masthead',false);}?>
        <div class="row mb-3">
            <aside id="post-<?php echo $post->ID;?>-single-share" class="col-12 col-lg-1 col-xl-1 d-flex justify-content-start align-items-center flex-lg-column justify-content-lg-start text-muted mb-3">
                <?php get_template_part('template-parts/share-buttons'); ?>
            </aside> 
            <div class="col-12 col-lg-7 col-xl-7 border-start border-end">
                <header class="mb-3">
                    <hgroup>
                        <?php the_title('<h1 class="entry-title mb-2">','</h1>');?>
                        <?php the_sub_title('<h2 class="text-start small fw-normal mb-2 text-muted border-botton py-2 my-2">','</h2>');?>
                    </hgroup>
                </header>
                <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add($post->ID,'single-title',false);}?>   
                <div class="d-flex justify-content-start align-items-center small mb-3 border-xs-top pt-3">
                    <?php echo get_avatar( get_the_author_meta('ID'), $size = '70', $default = '', $alt = '', $args = array( 'class' => 'd-block me-2 img-thumbnail rounded-circle' ))?>
                    <div>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="d-block link">
                            <small><?php echo esc_html(get_the_author()); ?></small><?php $sem_role = sem_get_editorial_role((int) get_the_author_meta('ID')); if ($sem_role !== '') : ?><small class="d-block text-muted"><?php echo esc_html($sem_role); ?></small><?php endif; ?>
                        </a>
                        <time pubdate class="single-time text-muted text-lowercase small" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished" >
                            <span>Pubblicato il </span><?php echo get_the_date('j F, Y') ?>
                        </time>
                    </div>
                </div>                       
                <article id="post-<?php echo $post->ID;?>-article" class="border-top pt-3">
                    <?php if (has_post_thumbnail()){?>
                        <figure class="figure text-center d-table mx-auto border-only-xs-bottom pb-2 mb-2">
                            <?php the_post_thumbnail('large',array(
                                'decoding'		=> "async",
                                'fetchpriority'	=> "high",
                                'class'			=> "img-fluid figure-img skip-lazy my-0",
                                'alt'			=> get_the_title(),
                                'title'			=> get_the_title()
                            ));?>
                            <?php $caption = get_the_post_thumbnail_caption();if(isset($caption) and !empty($caption)){?>
                            <figcaption class="figure-caption text-center text-muted text-lowercase small"><span class="small"><?php echo get_the_post_thumbnail_caption();?></span></figcaption>
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