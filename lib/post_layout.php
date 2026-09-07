<?php
/*
*
*/	
add_action('add_meta_boxes', function(){add_meta_box( 'post_layout_box', 'Smart eMagazine - Article Template', 'post_layout_box_html', 'post');});
/*
*
*/
function post_layout_box_html($post){?>
	<?php
	// ==
	$post_layout_selected_value			= get_post_meta($post->ID,'sem-post-layout-selected-value', true);
	// -- checked
	$sem_layout_single_default_checked 	= '';
	$sem_layout_single_line_checked 	= '';
	$sem_layout_single_side_checked 	= '';
	$sem_layout_single_image_checked 	= '';
	$sem_layout_single_medium_checked 	= '';
	// --
	if(isset($post_layout_selected_value) and !empty($post_layout_selected_value)){
		if($post_layout_selected_value == 'sem-layout-single-line')		{$sem_layout_single_line_checked 		= 'checked';}
		if($post_layout_selected_value == 'sem-layout-single-side')		{$sem_layout_single_side_checked 		= 'checked';}
		if($post_layout_selected_value == 'sem-layout-single-image')	{$sem_layout_single_image_checked 		= 'checked';}
		if($post_layout_selected_value == 'sem-layout-single-medium')	{$sem_layout_single_medium_checked 		= 'checked';}
	}else{$sem_layout_single_default_checked = 'checked';}
	?>
    <div>
        <div>
            <p>
            <strong>Layout</strong></br>
            <span>Modifica il layout della pagina Article per questo post.</span></br>
            </p>
        <hr>
        </div>
        <!-- -->
        <div class="sem-layout-selector"> 
        	<div class="sem-layout-selector-section">
                <label>
                    <input type="radio" class="sem-layout-selector-item" name="sem-post-layout-selected-value" value="" <?php echo $sem_layout_single_default_checked?>>
                    <img src="<?php echo SEXM_DIR_URL?>/img/smart-site-layout-default.png">
                </label>
                <p><small><strong>Regular</strong></small></p>
            </div>
			<div class="sem-layout-selector-section">
                <label>
                    <input type="radio" class="sem-layout-selector-item" name="sem-post-layout-selected-value" value="sem-layout-single-medium" <?php echo $sem_layout_single_medium_checked?>>
                    <img src="<?php echo SEXM_DIR_URL?>/img/smart-site-layout-medium.png">
                </label>
                <p><small><strong>Inside</strong></small></p>
            </div> 
            <div class="sem-layout-selector-section">
                <label>
                    <input type="radio" class="sem-layout-selector-item" name="sem-post-layout-selected-value" value="sem-layout-single-side" <?php echo $sem_layout_single_side_checked?>>
                    <img src="<?php echo SEXM_DIR_URL?>/img/smart-site-layout-side.png">
                </label>
                <p><small><strong>Sidebar</strong></small></p>
            </div>                       
            <div class="sem-layout-selector-section">
                <label>
                    <input type="radio" class="sem-layout-selector-item" name="sem-post-layout-selected-value" value="sem-layout-single-line" <?php echo $sem_layout_single_line_checked?>>
                    <img src="<?php echo SEXM_DIR_URL?>/img/smart-site-layout-line.png">
                </label>
                <p><small><strong>Linear</strong></small></p>
            </div>
			<div class="sem-layout-selector-section">
                <label>
                    <input type="radio" class="sem-layout-selector-item" name="sem-post-layout-selected-value" value="sem-layout-single-image" <?php echo $sem_layout_single_image_checked?>>
                    <img src="<?php echo SEXM_DIR_URL?>/img/smart-site-layout-image.png">
                </label>
                <p><small><strong>Image</strong></small></p>
            </div>
		<hr>
        </div>
        <!-- -->
        <div>
        	<p>
            	<small>le preferenze di layout si applicano solo a questo post, nessun altro articolo sarà personalizato</small>
            </p>
        <hr>
        </div>
        <!-- -->
        <div align="right">
            <input id="publish" class="button-primary" type="submit" value="Aggiorna" accesskey="p" tabindex="5" name="save">
        </div>
    </div>
<?php }
/*
* Salvataggio
*/
#sem_function_post_meta_save('sem-post-layout-selected-value');
/*
* Salvataggio
*/
add_action('save_post',function($post_id,$post){global $pagenow;
	// -- Verifica Permessi
	if(!current_user_can('edit_post',$post_id))return $post_id;
	// -- Verifica Pagina
	if(($pagenow != 'post.php') || (get_post_type() != 'post'))return $post_id;
	//-- Verifica POST Value
	if(!isset($_POST['sem-post-layout-selected-value']) or empty($_POST['sem-post-layout-selected-value'])){delete_post_meta($post_id,'sem-post-layout-selected-value');return $post_id;}
	// -- recupero valore
	$meta_value = get_post_meta($post_id,'sem-post-layout-selected-value',true);
	// -- recupero request
	if(isset($_POST['sem-post-layout-selected-value']) and !empty($_POST['sem-post-layout-selected-value'])){$new_meta_value = stripslashes($_POST['sem-post-layout-selected-value']);}
	// -- Verifica cambiamento
	if('' == $new_meta_value && $meta_value){
		delete_post_meta($post_id,'sem-post-layout-selected-value');
	}else{
		update_post_meta($post_id,'sem-post-layout-selected-value',$new_meta_value);
	}
}, 10, 2 );