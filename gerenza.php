<?php
/**
* Template name: Contatti
*/
?>
<?php get_header('gerenza'); ?>
<main class="container site-main">
	<?php if(is_plugin_active('smart-seo-dots/smart-seo-dots.php')){if(function_exists('seodots_bootstrap_breadcrumbs')){seodots_bootstrap_breadcrumbs();}}?>
    <?php if($option = sem_option_check('sem-redazione-direttore-name')){?>
        <div class="mb-4">
            <div>direttore</div>  
            <div class="h3 font-weight-bold">
            	<?php echo $option['sem-redazione-direttore-name'];?>
            </div>
            <div class="text-muted">
            	<?php if($option = sem_option_check('sem-redazione-direttore-email')){echo $option['sem-redazione-direttore-email'];}?>
            </div>
        </div>
        <hr>
    <?php }?> 
    <div class="mb-4"><?php if (have_posts()) : while (have_posts()) : the_post(); the_content();endwhile;endif;?></div>
    <div class="mb-4">
        <h6 class="mb-0">Segreteria</h6>
        <div class="text-muted">
        	<?php if($option = sem_option_check('sem-redazione-segreteria-email')){echo $option['sem-redazione-segreteria-email'];}?>
        </div>
        <div class="text-muted">
        	<?php if($option = sem_option_check('sem-redazione-telefono')){echo $option['sem-redazione-telefono'];}?>
        </div>
    </div>
    <hr>
    <?php if($option = sem_option_check('sem-publisher-sede')) 		{?>
        <div class="mb-4" align="left">
            <h6 class="mb-0">Sede</h6>
            <div class=" text-muted"><?php echo $option['sem-publisher-sede'];?></div>
        </div>
    <?php }?>
    <?php if($option = sem_option_check('sem-publisher-copyright')) {?> 
        <div class="mb-4" align="left">
            <h6 class="mb-0">Registrazione e Copyright</h6>
            <div class="text-muted"><?php echo $option['sem-publisher-copyright'];?></div>
        </div>
    <?php }?>
    <?php if($option = sem_option_check('sem-publisher-fiscale')) 	{?>
        <div class="mb-4" align="left">
            <h6 class="mb-0">Editore</h6>
            <div class="text-muted"><?php echo $option['sem-publisher-fiscale'];?></div>
        </div>
    <?php }?> 
</main>
<?php get_footer('gerenza'); ?>