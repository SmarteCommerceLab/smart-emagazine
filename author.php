<?php get_header('author'); ?>
<main class="container site-main border-start border-end">
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){seodots_bootstrap_breadcrumbs();}}?>
	<div class="row">
    	<div class="col-12 col-sm-3">
            <div class="single-author text-center text-sm-start mb-3" name="single-author">
				<div class="text-center mb-3">
                    <?php echo get_avatar( get_the_author_meta('ID'), 150);?>
                </div>
                <p class="h5">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                        <span class="fw-bold"><?php echo get_the_author(); ?></span>
                    </a>
                </p>
                <p class="text-muted small"><?php echo get_the_author_meta('user_description',$post->post_author);?></p>
                <hr>
                <div class="single-share d-flex justify-content-center justify-content-sm-start">
                    <?php if(!empty(get_the_author_meta( 'facebook', $post->post_author ))) 	{?>
                        <a 
                        class	= "link link-social-editor text-center text-primary p-2" 
                        href	= "<?php echo get_the_author_meta( 'facebook', $post->post_author );?>" 
                        title 	= "Facebook" 
                        target 	= "_blank" 
                        rel 	= "nofollow"
                        ><i class="fa-brands fa-facebook fa-xl"></i></a>
                    <?php }?>
                    <?php if(!empty(get_the_author_meta( 'twitter', $post->post_author ))) 		{?>
                        <a 
                        class	= "link link-social-editor text-center text-primary p-2" 
                        href	= "<?php echo get_the_author_meta( 'twitter', $post->post_author );?>" 
                        title 	= "Instagram" 
                        target 	= "_blank" 
                        rel 	= "nofollow"
                        ><i class="fa-brands fa-square-instagram fa-xl"></i></a>
                    <?php }?>
                    <?php if(!empty(get_the_author_meta( 'instagram', $post->post_author ))) 	{?>
                        <a 
                        class	= "link link-social-editor text-center text-primary p-2" 
                        href	= "<?php echo get_the_author_meta( 'instagram', $post->post_author );?>" 
                        title 	= "Twitter" 
                        target 	= "_blank" 
                        rel 	= "nofollow"
                        ><i class="fa-brands fa-square-x-twitter fa-xl"></i></a>
                    <?php }?>
                    <?php if(!empty(get_the_author_meta( 'youtube', $post->post_author ))) 		{?>
                        <a 
                        class	= "link link-social-editor text-center text-primary p-2" 
                        href	= "<?php echo get_the_author_meta( 'youtube', $post->post_author );?>" 
                        title 	= "Youtube" 
                        target 	= "_blank" 
                        rel 	= "nofollow"
                        ><i class="fa-brands fa-youtube fa-xl"></i></a>
                    <?php }?>
                </div>
                <hr>
            </div>        
        </div>
    	<div class="col-12 col-sm-9 border-start mb-3">
			<?php sem_search_form_html();?>  
            <div class="row">
                <?php $e = (array) null;if($wp_query->have_posts()){while($wp_query->have_posts()){$wp_query->the_post();global $post;$e[] = $post->ID;?>
                    <div class="col-12 col-md-6 col-xl-4 my-1">  
                        <div class="row d-flex justify-content-center align-items-center mb-2">
                            <div class="col-4 col-md-12">
                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid mx-auto d-block mb-lg-1','alt' => '','title' => ''));?>
                            </div>
                            <div class="col-8 col-md-12">
                                <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center small">
                                    <ul class="nav align-items-center">
                                        <li class="nav-item text-muted small"><?php setlocale(LC_TIME, 'ita', 'it_IT.utf8'); the_time('j F Y');?></li>
                                    </ul>
                                    <?php $post_tag = get_the_tags($post->ID);
                                        if(isset($post_tag) and !empty($post_tag)){foreach ($post_tag as $post_tag_item){if($post_tag_item->slug != 'Featured' and $post_tag_item->slug != 'featured'){
                                        echo '<a href="'.get_tag_link($post_tag_item->term_id).'" class="d-block small text-first-capitalize text-primary link">'.$post_tag_item->name.'</a>';
                                    break;}}}?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>      
                <?php }}?>
            </div>
            <?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('wp_seodots_nopaging_load_more')){wp_seodots_nopaging_load_more($e);}}?>
        </div>
    </div>
    <?php if(is_plugin_active('smart-bootstrap-manager/smart-bootstrap-manager.php')){?><div class="px-4 mb-1"><?php if(function_exists('wp_bs_pagination')){wp_bs_pagination();}?></div><?php }?>
</main>
<?php get_footer('author');?>