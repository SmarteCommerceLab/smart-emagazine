<?php
/*
* Template name: Smart Site Home
*/
?>
<?php get_header('smart-site-builder');?>
<main class="container site-main">
	<?php
        echo "<!-- Page Builder Compose -->";
        // ================================== Compose
        $e = (array) null;
        #var_dump(get_queried_object());
        // -- 
		#echo 'sem-page-'.get_queried_object()->ID.'-compose-control-setting';
		if(get_queried_object()){if(get_queried_object()->ID){if($option = sem_option_check('sem-page-'.get_queried_object()->ID.'-compose-control-setting')){
			$compose_lista = json_decode($option['sem-page-'.get_queried_object()->ID.'-compose-control-setting']);
		}}}
        // --
        if(isset($compose_lista) and !empty($compose_lista)){foreach($compose_lista as $repeater_item){
            $compose_gruppo_articoli = new semComposeWidget($repeater_item->name,$repeater_item->slug,$repeater_item->tax,$repeater_item->widget,$repeater_item->code,$repeater_item->sticky,$e);
            $e = $compose_gruppo_articoli->esclude_post;
        }}
    ?>
</main>
<?php get_footer('smart-site-builder'); ?>