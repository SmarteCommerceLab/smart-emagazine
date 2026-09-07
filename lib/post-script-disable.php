<?php
/*
*
*/	
add_action('add_meta_boxes', function(){add_meta_box( 'post_script_not_box', 'Smart eMagazine - Article Script Manager', 'post_script_box_html', 'post');});
/*
*
*/
function post_script_box_html($post){?>
	<?php
	wp_nonce_field('sem_save_script_controls', 'sem_script_controls_nonce');
	// ==
	$post_script_not_checkbox_value 						= get_post_meta($post->ID, "post-script-not-all-checkbox", true);
	// ==
	$post_script_not_header_checkbox_value					= get_post_meta($post->ID, "post-script-not-header-checkbox", true);
	$post_script_not_footer_checkbox_value					= get_post_meta($post->ID, "post-script-not-footer-checkbox", true);
	// ==
	$post_script_not_single_sidebar_checkbox_value 			= get_post_meta($post->ID, "post-script-not-sidebar-checkbox", true);
	// == single Header Code Agenzie Checked
	$post_script_not_header_code_list_checkbox_value		= get_post_meta($post->ID, "post-script-not-"."header-code"."-list-checkbox-value", true);
	$post_script_not_footer_code_list_checkbox_value		= get_post_meta($post->ID, "post-script-not-"."footer-code"."-list-checkbox-value", true);
	// ==
	$post_script_not_sidebar_single_list_checkbox_value		= get_post_meta($post->ID, "post-script-not-"."sidebar-single"."-list-checkbox-value", true);
	?>
    <!-- All -->
    <div>
   		<p>
        <strong>GENERALE</strong></br>
        <span>Non caricare nessun script nel sito.</span></br>
        </p>
        <div>
            <?php if($post_script_not_checkbox_value == "")		{?>	<input name="post-script-not-all-checkbox" type="checkbox" value="true">			<?php }?>
            <?php if($post_script_not_checkbox_value == "true")	{?>	<input name="post-script-not-all-checkbox" type="checkbox" value="true" checked>	<?php }?>
            <label for="post-script-not-all-checkbox">disabilita Tutto</label>
        </div>
    </div>
    <!-- Script -->
    <div>
        <hr>
        <div>
            <p>
            <span>Non caricare gli script header e footer.</span></br>
            </p>
            <div>
                <?php if($post_script_not_header_checkbox_value == "")		{?>	<input name="post-script-not-header-checkbox" type="checkbox" value="true">			<?php }?>
                <?php if($post_script_not_header_checkbox_value == "true")	{?>	<input name="post-script-not-header-checkbox" type="checkbox" value="true" checked>	<?php }?>
                <label for="post-script-not-header-checkbox">Header</label>
            </div>
            <div>
                <?php if($post_script_not_footer_checkbox_value == "")		{?>	<input name="post-script-not-footer-checkbox" type="checkbox" value="true">			<?php }?>
                <?php if($post_script_not_footer_checkbox_value == "true")	{?>	<input name="post-script-not-footer-checkbox" type="checkbox" value="true" checked>	<?php }?>
                <label for="post-script-not-footer-checkbox">Footer</label>
            </div>
        </div>
    </div>
    <!-- Adv - Header -->
    <div>
        <hr>
        <div>
            <p>
            <span>Indica i singoli script da disabilitare dall'area <strong>HEADER</strong>.</span></br>
            </p>
            <?php
            // == Setting Code
				$Lista_Agenzie 	= json_encode(sem_option_check('sem-script-head-code'));
				#$Lista_Agenzie	= get_theme_mod('jr-script-head-code',json_encode(array()));
                $Lista_Not		= $post_script_not_header_code_list_checkbox_value;
                $Control_Class	= "header-code";
            ?>
            <div>       
                <?php
                    // == Riferimenti
                    $uniqid 		= uniqid();			
                    $jr_control		= "jr-".$Control_Class."-control-".$uniqid;				
                ?> 
                <div id="<?php echo $jr_control;?>" class="jr-<?php echo $Control_Class;?>-control">
                    <?php
                        // == Lista Agenzie
						$jr_script_head_code_json	 	= $Lista_Agenzie;
						$jr_script_head_code			= json_decode($jr_script_head_code_json);
                        // == Lista Agenzie NOT Loading
						$jr_script_head_code_not		= json_decode($Lista_Not);
                        // ==
						foreach($jr_script_head_code as $repeater_item){
                            // == 
                                unset($item);
                                unset($item_found);
                            // ==
                                $item_check['SLUG'] 	= $repeater_item->slug;
                            // ==
                                echo '<div class="jr-'.$Control_Class.'-item">';
                                    // == Cerca Adv disabilitate
									if(isset($jr_script_head_code_not) and !empty($jr_script_head_code_not)){
                                    	foreach($jr_script_head_code_not as $item_slug_value){if($item_check['SLUG']===$item_slug_value->slug){$item_found = true;break;}}
									}
                                    // == Imposta checkbox
                                    if(isset($item_found) and $item_found == true){
                                        echo '<input class="jr-'.$Control_Class.'-item-active" type="checkbox" value="on" slug="'.$item_check['SLUG'].'" checked>';
                                    }else{
                                        echo '<input class="jr-'.$Control_Class.'-item-active" type="checkbox" value="off" slug="'.$item_check['SLUG'].'">';
                                    }
                                    echo '<label>'.$item_check['SLUG'].'</label>';
                                echo '</div>';
                            }
                    ?>
                    <input 
                        type 	= 'text'
                        name	= 'post-script-not-<?php echo $Control_Class;?>-list-checkbox-value'
                        value	= '<?php echo $Lista_Not; ?>' 
                        class	= 'jr-<?php echo $Control_Class; ?>-list-json-value'
                        style 	= 'width:100%;margin-top:10px;'
                        readonly
                    />        
                </div>
            </div>
        </div>
    </div>
    <!-- Adv - Footer -->
    <div>
        <hr>
        <div>
            <p>
            <span>Indica i singoli script da disabilitare dall'area <strong>FOOTER</strong>.</span></br>
            </p>
            <?php
            // == Setting Code
				$Lista_Agenzie 	= json_encode(sem_option_check('sem-script-footer-code'));
                #$Lista_Agenzie = get_theme_mod('jr-script-footer-code',json_encode(array()));
                $Lista_Not		= $post_script_not_footer_code_list_checkbox_value;
                $Control_Class	= "footer-code";
            ?>
            <div>       
                <?php
                    // == Riferimenti
                    $uniqid 		= uniqid();			
                    $jr_control		= "jr-".$Control_Class."-control-".$uniqid;				
                ?> 
                <div id="<?php echo $jr_control;?>" class="jr-<?php echo $Control_Class;?>-control">
                    <?php
            
                        // == Lista Agenzie
                            $jr_script_footer_code_json 	= $Lista_Agenzie;
                            $jr_script_footer_code			= json_decode($jr_script_footer_code_json);
                        // == Lista Agenzie NOT Loading
                            $jr_script_footer_code_not		= json_decode($Lista_Not);
                        // ==
                            foreach($jr_script_footer_code as $repeater_item){
                            // == 
                                unset($item);
                                unset($item_found);
                            // ==
                                $item_check['SLUG'] 	= $repeater_item->slug;
								$item_check['ACTIVE']	= $repeater_item->active;
								$item_check['CODE']		= $repeater_item->code;
                            // ==
                                echo '<div class="jr-'.$Control_Class.'-item">';
                                    // == Cerca Adv disabilitate
									if(isset($jr_script_footer_code_not) and !empty($jr_script_footer_code_not)){
                                    	foreach($jr_script_footer_code_not as $item_slug_value){if($item_check['SLUG']===$item_slug_value->slug){$item_found = true;break;}}
									}
                                    // == Imposta checkbox
                                    if(isset($item_found) and $item_found == true){
                                        echo '<input class="jr-'.$Control_Class.'-item-active" type="checkbox" value="on" slug="'.$item_check['SLUG'].'" checked>';
                                    }else{
                                        echo '<input class="jr-'.$Control_Class.'-item-active" type="checkbox" value="off" slug="'.$item_check['SLUG'].'">';
                                    }
                                    echo '<label>'.$item_check['SLUG'].'</label>';
                                echo '</div>';
                            }
                    ?>
                    <input 
                        type 	= 'text'
                        name	= 'post-script-not-<?php echo $Control_Class;?>-list-checkbox-value'
                        value	= '<?php echo $Lista_Not; ?>' 
                        class	= 'jr-<?php echo $Control_Class; ?>-list-json-value'
                        style 	= 'width:100%;margin-top:10px;'
                        readonly
                    />        
                </div>
            </div>
        </div>
    </div>
    <!-- Save -->
    <div>
        <hr>
        <div align="right">
            <input id="publish" class="button-primary" type="submit" value="Aggiorna" accesskey="p" tabindex="5" name="save">
        </div>
    </div>
<?php }
/*
* https://wordpress.org/support/article/roles-and-capabilities/
* https://developer.wordpress.org/reference/functions/add_meta_box/
* https://alessioangeloro.it/creare-metabox-wordpress-aggiungere-informazioni-pagine-articoli-custom-post-type-altro/
************/
add_action('save_post_post', 'post_script_save_post_meta_box', 10, 2);
function post_script_save_post_meta_box($post_id, $post){
	if (!$post instanceof WP_Post || $post->post_type !== 'post' || !current_user_can('manage_options')) return;
	if (!sem_can_save_metabox((int) $post_id, 'sem_script_controls_nonce', 'sem_save_script_controls')) return;
	foreach (array('post-script-not-all-checkbox', 'post-script-not-header-checkbox', 'post-script-not-footer-checkbox') as $key) {
		if (isset($_POST[$key])) update_post_meta($post_id, $key, 'true');
		else delete_post_meta($post_id, $key);
	}
	foreach (array('post-script-not-header-code-list-checkbox-value', 'post-script-not-footer-code-list-checkbox-value', 'post-script-not-sidebar-single-list-checkbox-value') as $key) {
		if (isset($_POST[$key])) update_post_meta($post_id, $key, sem_sanitize_slug_list_json($_POST[$key]));
		else delete_post_meta($post_id, $key);
	}
}
