<?php get_header('category'); ?>
<?php 
	// ================================ categoria
	$category 		= get_queried_object();
	// ================================ SUB
	$subly = get_categories(array(
		'child_of'      => $category->term_id,
		'hide_empty'	=> true,
		'hierarchical' 	=> 1,
		'depth'			=> 1,
		'parent' 		=> $category->term_id,
		'orderby' 		=> 'name',
		'order'   		=> 'ASC'
	));
	// ================================ Exclude ID
	$e 				= (array) null;
	$paged 			= get_query_var('paged') ? get_query_var('paged') : 0;
?>
<main class="container site-main overflow-hidden">
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){seodots_bootstrap_breadcrumbs();}}?>
    <h1 class="display-5 text-center"><?php echo get_queried_object()->name;?></h1>
        <p><?php echo get_queried_object()->description;?></p> 
    <hr>
    <?php if($paged == 0){$category_primary_post = new semComposeWidget($category->slug,$category->slug,'category','open',NULL,NULL,NULL);$e = $category_primary_post->esclude_post;}?>
    <?php if($paged == 0 and count($subly)>0){foreach($subly as $item){
		$category_secondary_post = new semComposeWidget($item->slug,$item->slug,'category','gruppoxl',NULL,NULL,$e);
		$e = $category_secondary_post->esclude_post;
	}}?>
    <?php if($paged == 0){?><p>Tutte le notizie di <span class="h4 text-primary"><strong><?php echo $category->name; ?></strong></span></p><hr><?php }?>
    <div class="row">
        <?php $e = (array) null;if($wp_query->have_posts()){while($wp_query->have_posts()){$wp_query->the_post();global $post;$e[] = $post->ID;?>
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
        <?php }}?>
    </div>
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('wp_seodots_nopaging_load_more')){wp_seodots_nopaging_load_more($e);}}?>
    <?php if(is_plugin_active('smart-bootstrap-manager/smart-bootstrap-manager.php')){?><div class="px-4 mb-1"><?php if(function_exists('wp_bs_pagination')){wp_bs_pagination();}?></div><?php }?>
</main>
<?php get_footer('category');?>