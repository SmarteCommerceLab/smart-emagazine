<?php #echo http_response_code(); ?>
<?php get_header('404'); ?>
<main class="container site-main mx-auto">
    <h1 class="display-1 text-primary text-center">
    <?php 
    echo http_response_code();
    #if (is_404() && '410' == http_response_code()){echo '410';}
    #if (is_404() && '404' == http_response_code()){echo '404';}
    ?>
    </h1>
    <h2 class="text-center">Oops! pagina non trovata</h2>
    <p class="text-center">La pagina cercata è stata rimossa o temporaneamente non disponibile.</p>
    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add(get_the_ID(),'single-title',false);}?>
    <?php sem_search_form_html();?>
    <?php
    // -------------------------------------------------- Get-Post
    $query = new WP_Query(array(
        'posts_per_page'   		=> 6,
        'showposts'				=> '',
        'cat'         			=> '',
        'tag_id' 		   		=> '',
        'post__not_in'          => '',
        'category_not_in' 		=> '',
        #'offset'           		=> 0,
        'ignore_sticky_posts' 	=> '',
        'orderby'          		=> 'date',
        'order'            		=> 'DESC',
        'post_type'        		=> 'post',
        'post_status'      		=> 'publish',
        'suppress_filters' 		=> true 
    ));
    ?>
    <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
    <?php $x=-1;if($query->have_posts()){?>
        <div class="row g-2 overflow-hidden">
        <?php while($query->have_posts()){$x++;$query->the_post();?>
            <div class="col-12 col-md-4 col-xxl-3- mb-3 border-only-xs-bottom">                    
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                    <?php the_post_thumbnail('medium',array(
                        'decoding'		=> "async",
                        'fetchpriority'	=> "high",
                        'class'			=> "img-fluid skip-lazy mb-2",
                        'alt'			=> get_the_title(),
                        'title'			=> get_the_title()
                    ));?>
                </a>
                <a class="d-block h5 link text-black text-start my-2" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                <div class="d-flex justify-content-between align-items-center small">   
                    <p class="nav-item text-muted small">di 
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                        <?php echo get_the_author(); ?>
                        </a>
                    </p>
                    <p class="nav-item text-muted small">
                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                <?php echo $post_tag_primary->name ?>
                            </a>
                        <?php }?>
                    </p>
                </div> 
            </div>                      	
        <?php }?>
        </div>
    <?php wp_reset_postdata();}?>
    <?php if(is_plugin_active('smart-advertising-manager/smart-advertising-manager.php')){echo adhost_adv_code_add(get_the_ID(),'single-bottom',false);}?>
</main>
<?php get_footer('404'); ?>