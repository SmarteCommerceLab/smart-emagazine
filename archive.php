<?php get_header(); ?>
<main class="container site-main">
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){seodots_bootstrap_breadcrumbs();}}?>
	<?php sem_search_form_html();?> 
    <div class="row mb-5">
        <?php if (have_posts()) : while (have_posts()) : the_post();if($post->post_type == 'post'):?>
            <div class="col-12 col-md-6 col-xl-4 my-1">  
                <div class="row d-flex justify-content-center align-items-center mb-2">
                    <div class="col-4">
                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid mx-auto d-block mb-lg-1','alt' => '','title' => ''));?>
                    </div>
                    <div class="col-8">
                        <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center small">
                            <ul class="nav align-items-center">
                                <li class="nav-item text-muted small me-2">di <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link"><?php echo get_the_author(); ?></a></li>
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
        <?php endif;endwhile;endif;?>
    </div>
    <?php if(is_plugin_active('smart-bootstrap-manager/smart-bootstrap-manager.php')){?><div class="px-4 mb-1"><?php if(function_exists('wp_bs_pagination')){wp_bs_pagination();}?></div><?php }?>
</main>
<?php get_footer();?>