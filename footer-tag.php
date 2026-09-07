<footer class="bg-white">
	<div class="border-top pt-3 mt-3"><div class="container">
        <div class="row">
            <!-- Footer Widget -->
            <div class="col-sm-3 col-md-2 col-lg-2">
                <p class="h6">Naviga</p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'nav justify-content-start flex-column',
                    //'menu_id'			=> '',
                    'container'			=> '',
                    #'container_class'	=> 'border-bottom mb-1 py-3',
                    //'container_id'	=> '',
                    //'before'			=> '',
                    //'after'			=> '',
					'link_before'		=> '<span class="small">',
					'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> 'naviga', 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'nav-item',
                    'link_class'		=> 'nav-link link text-muted p-0 ps-0 pe-1',
                    'fallback_cb'		=> false));
                ?>
                <hr class="d-sm-none">
            </div>  
            <!-- Footer Widget -->
            <div class="col-sm-3 col-md-2 col-lg-2">
                <p class="h6">Contatti</p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'nav justify-content-start flex-column',
                    //'menu_id'			=> '',
                    'container'			=> '',
                    #'container_class'	=> 'border-bottom mb-1 py-3',
                    //'container_id'	=> '',
                    //'before'			=> '',
                    //'after'			=> '',
					'link_before'		=> '<span class="small">',
					'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> 'footer', 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'nav-item',
                    'link_class'		=> 'nav-link link text-muted p-0 ps-0 pe-1',
                    'fallback_cb'		=> false));
                ?>
                <hr class="d-sm-none">
            </div>          
            <!-- Footer Widget -->
            <div class="col-sm-3 col-md-2 col-lg-2">
            	<?php /*SITE */ if(!is_single()){?>
                <p class="h6">Social</p>
                <ul class="nav">
                	<?php if($option = sem_option_check('sem-social-url-facebook')){?>
                    <li class="nav-item h6">
                        <a class="nav-link d-flex text-facebook px-0" rel = "noreferrer noopener" href="<?php echo $option['sem-social-url-facebook'];?>">
                            <i class="fab fa-facebook-square fa-2x me-2 text-facebook"></i><span class="d-none my-auto link">Facebook</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($option = sem_option_check('sem-social-url-twitter')){?>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-twitter px-0" rel = "noreferrer noopener" href="<?php echo $option['sem-social-url-twitter'];?>">
                            <i class="fab fa-twitter-square fa-2x me-2 text-twitter"></i><span class="d-none my-auto link">Twitter</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($option = sem_option_check('sem-social-url-instagram')){?>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-instagram px-0" rel = "noreferrer noopener" href="<?php echo $option['sem-social-url-instagram'];?>">
                            <i class="fab fa-instagram-square fa-2x me-2 text-instagram"></i><span class="d-none my-auto link">Instagram</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($option = sem_option_check('sem-social-url-linkedin')){?>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-linkedin px-0" rel = "noreferrer noopener" href="<?php echo $option['sem-social-url-linkedin'];?>">
                            <i class="fab fa-linkedin fa-2x me-2 text-linkedin"></i><span class="d-none my-auto link">Linkedin</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($option = sem_option_check('sem-social-url-youtube')){?>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-youtube px-0" rel = "noreferrer noopener" href="<?php echo $option['sem-social-url-youtube'];?>">
                            <i class="fab fa-youtube-square fa-2x me-2 text-youtube"></i><span class="d-none my-auto link">YouTube</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
                <hr class="d-sm-none">
                <?php /*SITE */ }?>
            </div>
            <!-- Footer Widget -->
            <div class="col-sm-3 col-md-6 col-lg-6 text-start text-md-end">
                <p class="h5"><?php bloginfo('name');?></p>
                <?php if($option = sem_option_check('sem-publisher-sede')) 		{?>
                    <div class="mb-4 mt-4">
                        <h6 class="mb-0">Sede</h6>
                        <div class="mb-1 small"><?php echo $option['sem-publisher-sede'];?></div>
                    </div>
                <?php }?>
                <?php if($option = sem_option_check('sem-publisher-copyright')) {?> 
                    <div class="mb-4">
                        <h6 class="mb-0">Registrazione e Copyright</h6>
                        <div class="mb-1 small"><?php echo $option['sem-publisher-copyright'];?></div>
                    </div>
                <?php }?>
                <?php if($option = sem_option_check('sem-publisher-fiscale')) 	{?>
                    <div class="mb-4">
                        <h6 class="mb-0">Editore</h6>
                        <div class="mb-1 small"><?php echo $option['sem-publisher-fiscale'];?></div>
                    </div>
                <?php }?>        
            </div>              
        </div>
    </div></div>
    <?php if($option = sem_option_check('sem-agenzia-copyright')){?>
    <div class="bg-light border-top">
    	<div class="container">
        	<div class="row"><div class="col-12 small text-center text-muted">
            	<?php echo $option['sem-agenzia-copyright'];?>
            </div></div>
        </div>
    </div>
	<?php }?>
    <?php /*SINGLE */ if(is_single()){?>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom mb-2">
            <h5 class="offcanvas-title text-dark fw-bold flex-grow-1" id="offcanvasNavbarLabel"><?php bloginfo('name');?></h5>
            <a 
            class			= "flex-grow-2 text-black link" 
            data-bs-dismiss = "offcanvas" 
            aria-label		= "Close"
            >
            <span class="link">Chiudi&nbsp;</span><i class="fa-solid fa-close fa-xl"></i>
            </a>
        </div>                 
        <div class="offcanvas-body px-0">
        	<!-- Cerca -->
			<a class="small text-muted link p-2 text-start" href="<?php echo home_url('/'); ?>?s=" title="Cerca nel sito">
            	<span>Cerca nel sito - Vai alla pagina di ricerca</span>
			</a>
            <hr>
            <!-- Menu - Topic -->   
			<?php $is_assigned_name = 'topic';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>
            <!-- Menu - Argomenti -->   
			<?php $is_assigned_name = 'argomenti';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>
            <!-- Menu - Primo -->   
			<?php $is_assigned_name = 'primo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>
            <!-- Menu - Secondo -->   
			<?php $is_assigned_name = 'secondo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>
            <!-- Menu - Terzo -->   
			<?php $is_assigned_name = 'terzo';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>            
            <!-- Menu - Locali -->   
			<?php $is_assigned_name = 'localplus';$is_assigned = has_nav_menu($is_assigned_name);if($is_assigned){$is_assigned_menu = sec_menu_get_info($is_assigned_name);?>
                <p class="border-bottom border-1 text-black fw-bold p-2 text-uppercase"><?php echo $is_assigned_menu->name; ?></p>
                <?php 
                    wp_nav_menu( array( 
                    //'menu'			=> '',
                    'menu_class'		=> 'list-group list-group-horizontal flex-wrap border-no-last border-bottom',
                    //'menu_id'			=> '',
                    'container'			=> '', #remove div container
                    #'container_class'	=> '',
                    #'container_id'		=> '',
                    //'before'			=> '',
                    //'after'			=> '',
                    #'link_before'		=> '<span class="">',
                    #'link_after'		=> '</span>',
                    //'echo'			=> '',
                    //'depth'			=> '',
                    'theme_location'	=> $is_assigned_name, 
                    //'items_wrap'		=> '',
                    //'item_spacing'	=> '',
                    //'walker' 			=> new tie_mega_menu_walker(), 
                    'item_class'		=> 'list-group-item border-0 border-bottom flex-shrink-1 w-50 p-2',
                    'link_class'		=> 'link text-black',
                    'fallback_cb'		=> false));
                ?>    
            <?php }?>
        </div>
    </div>
    <?php /*SINGLE */ }?>  
</footer>
<?php wp_footer();?></body></html>