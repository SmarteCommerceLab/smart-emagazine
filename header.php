<?php 
// == Logo
	$image_attribute 					= wp_get_attachment_image_src(get_theme_mod( 'Journal_media_setting_id'), 'full', false, '');
// == Advertising
	//-- Disable
	if(is_single()){
		$post_adv_not_checkbox_value 	= false;
		$post_adv_not_checkbox_value 	= get_post_meta($post->ID, "post-adv-not-all-checkbox"	, true);
	}
?>
<!doctype html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo get_site_icon_url()?>"/>
    <title><?php wp_title();?></title>
    <meta charset="<?php bloginfo('charset');?>">
	<?php wp_head();?>
</head>
<body <?php body_class();?>><?php wp_body_open(); ?>
	<?php /*SINGLE */ if(is_single()){if(get_theme_mod('journal_sidebar',false)==true and $post_adv_not_checkbox_value == ""){if(is_active_sidebar('single-header')){dynamic_sidebar('single-header');}}}?>
    <header class="sticky-top bg-white border-bottom">
        <nav class="header-main mx-auto navbar navbar-expand-lg">
            <div class="container">
            	<!-- Altri-Link -->
				<?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'navbar-nav justify-content-center flex-grow-2',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    //'container_id'	=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="small- text-muted link">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> 'utili', 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    //'item_class'		=> '',
                    'link_class'		=> 'px-0 pe-2 text-black link',
                    'fallback_cb'		=> false));
                ?>            
            	<!-- Logo-Link -->
				<a 
                href	= "<?php echo get_home_url(); ?>" 
                title 	= "Homepage" 
                >
                	<img 
                    	class 	= "d-block img-fluid m-auto flex-grow-1" 
                        src 	= "<?php echo $image_attribute[0];?>" 
                        alt 	= "<?php bloginfo('name');?>" 
                        title 	= "<?php bloginfo('name');?>" 
                        style 	= "height:40px;width:200px;" 
                        height 	= "40"
                        width 	= "200"
					>
                </a>
            	<!-- Menu-Link -->
                <a 
                class			= "flex-grow-2 text-black link" 
                data-bs-toggle	= "offcanvas" 
                data-bs-target	= "#offcanvasNavbar" 
                aria-controls	= "offcanvasNavbar"
                >
                <i class="fa-solid fa-bars-staggered fa-xl"></i>
                </a>                
            </div>
        </nav>
    </header>
    <div class="border-bottom border-1 shadow-sm mb-3 bg-white">
		<?php
            wp_nav_menu( array( 
            #'menu'				=> '',
            'menu_class'		=> 'nav flex-nowrap justify-content-md-center overflow-auto overflow-width-none mx-auto',
            #'menu_id'			=> '',
            'container'			=> 'div', #remove div container
            'container_class'	=> 'border-bottom d-flex border-1 bg-white',
            #'container_id'		=> '',
            #'before'			=> '',
            #'after'			=> '',
            'link_before'		=> '<span class="text-nowrap text-black link fw-bold h6">',
            'link_after'		=> '</span>',
            #'echo'				=> '',
            #'depth'			=> '',
            'theme_location'	=> 'topic', 
            #'items_wrap'		=> '',
            #'item_spacing'		=> '',
            #'walker' 			=> new tie_mega_menu_walker(), 
            #'item_class'		=> '',
            #'link_class'		=> '',
            'fallback_cb'		=> false));
        ?>
        <?php
            wp_nav_menu( array( 
            #'menu'				=> '',
            'menu_class'		=> 'nav flex-nowrap justify-content-md-center overflow-auto overflow-width-none mx-auto',
            #'menu_id'			=> '',
            'container'			=> 'div', #remove div container
            'container_class'	=> 'border-bottom d-flex border-1 bg-white',
            #'container_id'		=> '',
            #'before'			=> '',
            #'after'			=> '',
            'link_before'		=> '<span class="text-nowrap text-black link small">',
            'link_after'		=> '</span>',
            #'echo'				=> '',
            #'depth'			=> '',
            'theme_location'	=> 'argomenti', 
            #'items_wrap'		=> '',
            #'item_spacing'		=> '',
            #'walker' 			=> new tie_mega_menu_walker(), 
            #'item_class'		=> '',
            'link_class'		=> 'px-2',
            'fallback_cb'		=> false));
        ?>
    </div>
	<?php /*SITE */  if(!is_single()){?>  
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom mb-2">
            <h5 class="offcanvas-title text-primary fw-bold flex-grow-1" id="offcanvasNavbarLabel"><?php bloginfo('name');?></h5>
            <a 
            class			= "flex-grow-2 text-primary link" 
            data-bs-dismiss = "offcanvas" 
            aria-label		= "Close"
            >
            <i class="fa-solid fa-close fa-2x"></i>
            </a>
        </div>                 
        <div class="offcanvas-body overflow-width-none">
        	<!-- Cerca -->
            <?php sem_search_form_html();?>
            <!-- Menu - Primo -->   
			<?php $is_assigned_name = 'primo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
            <div class="mb-3">
                <div class="position-relative border-line mb-2">
                    <p class="h6 text-left text-uppercase text-nowrap mb-2 pb-1"><?php echo $is_assigned_menu->name; ?></p>              
                </div>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    'link_before'		=> '<small>',
                    'link_after'		=> '</small>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 py-1 px-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?> 
			</div>  
            <?php }?>
            <!-- Menu - Secondo -->   
			<?php $is_assigned_name = 'secondo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
            <div class="mb-3">
                <div class="position-relative border-line mb-2">
                    <p class="h6 text-left text-uppercase text-nowrap mb-2 pb-1"><?php echo $is_assigned_menu->name; ?></p>              
                </div>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    'link_before'		=> '<small>',
                    'link_after'		=> '</small>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 py-1 px-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?> 
			</div>  
            <?php }?>
            <!-- Menu - Terzo -->   
			<?php $is_assigned_name = 'terzo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
            <div class="mb-3">
                <div class="position-relative border-line mb-2">
                    <p class="h6 text-left text-uppercase text-nowrap mb-2 pb-1"><?php echo $is_assigned_menu->name; ?></p>              
                </div>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    'link_before'		=> '<small>',
                    'link_after'		=> '</small>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 py-1 px-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?> 
			</div>  
            <?php }?>            
            <!-- Menu - Locali -->   
			<?php $is_assigned_name = 'localplus';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
            <div class="mb-3">
                <div class="position-relative border-line mb-2">
                    <p class="h6 text-left text-uppercase text-nowrap mb-2 pb-1"><?php echo $is_assigned_menu->name; ?></p>              
                </div>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    'link_before'		=> '<small>',
                    'link_after'		=> '</small>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 py-1 px-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?> 
			</div>  
            <?php }?>
        </div>
    </div>
    <?php }?>