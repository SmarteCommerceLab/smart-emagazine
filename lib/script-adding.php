<?php 
/*
* Add scripts to wp_head() - ALL Page - Script : head-code
* if(is_home() or is_archive() or is_page() or is_single()){}
*/
if(!is_admin()){
	if(sem_option_check_true('sem-script-head-code-active')){
		if($option = sem_option_check('sem-script-head-code')){
			add_action('wp_head',function(){if($option = sem_option_check('sem-script-head-code')){
				// --
				#echo '<!-- This site is using Smart eMagazine Script Manager v'.SEXM_VERSION.' - Developed by Smart eCommerce - https://smartecommerce.it -->'; 
				echo "<!-- Smart eMagazine Script Manager / Script - Header - Section -->";
				// -- Lista Adv
				$repeater_Lista_agenzia	= json_decode($option['sem-script-head-code']);
				// ================================== Item-Reapeter
				foreach($repeater_Lista_agenzia as $repeater_item){unset($item);
					// -- Get Item Setting 
					$item['SLUG'] 	= $repeater_item->slug;
					$item['CODE']	= $repeater_item->code;
					$item['ACTIVE']	= $repeater_item->active; 
					$item['amp']	= $repeater_item->amp;
					$item['ampload']= true;
					// -- Item Active
					if(isset($item['ACTIVE']) and !empty($item['ACTIVE']) and $item['ACTIVE'] == "on"){
						// -- Item Post Active
						if(is_single()){global $post;
							// --
							if(get_post_meta($post->ID, "post-script-not-all-checkbox", true) == "" and get_post_meta($post->ID, "post-script-not-header-checkbox", true) == ""){
								// --
								$jr_script_not	= json_decode(get_post_meta($post->ID, "post-script-not-header-code-list-checkbox-value", true));
								// --
								if($jr_script_not){
									foreach($jr_script_not as $item_slug_value){if($item['SLUG']===$item_slug_value->slug){$item_found = true;break;}}
								}					
							}
						}
						// -- AMP
						if(is_plugin_active('amp/amp.php')){
							if(amp_is_request()){
								if($item['amp'] !== "on")	{$item['ampload'] = false;}
							}else{
								if($item['amp'] == "on")	{$item['ampload'] = false;}
							}
						}
						// -- Load Script PHP
						if(!isset($item_found) and ($item['ampload'] == true)){
							// -- php
							if(strpos($item['CODE'], '<' . '?') !== false){
								ob_start();eval( '?>' . $item['CODE'] );$item['CODE'] = ob_get_contents();ob_end_clean();echo $item['CODE'];
							}else{
								echo $item['CODE'];
							}
						}						
					}
				}
				echo "<!-- /Script - Header - Section -->";
			}},10);	
		}
	}
}
/*
* Add scripts to wp_footer() - ALL Page - Script : footer-code
* if(is_home() or is_archive() or is_page() or is_single()){}
*/
if(!is_admin()){
	if(sem_option_check_true('sem-script-footer-code-active')){
		if($option = sem_option_check('sem-script-footer-code')){
			add_action('wp_footer',function(){if($option = sem_option_check('sem-script-head-code')){
				// -- 
				echo "<!-- Smart eMagazine Script Manager / Script - Footer - Section -->";
				// -- Lista Adv
				$repeater_Lista_agenzia	= json_decode($option['sem-script-footer-code']);
				// ================================== Item-Reapeter
				foreach($repeater_Lista_agenzia as $repeater_item){
					// -- 
					unset($item);
					unset($item_found);
					// --
					if(!isset($repeater_item->amp) or empty($repeater_item->amp)){$repeater_item->amp = false;}
					// -- Get Item Setting 
					$item['SLUG'] 	= $repeater_item->slug;
					$item['CODE']	= $repeater_item->code;
					$item['ACTIVE']	= $repeater_item->active;
					$item['amp']	= $repeater_item->amp;
					$item['ampload']= true;
					// -- Item Active
					if(isset($item['ACTIVE']) and !empty($item['ACTIVE']) and $item['ACTIVE'] == "on"){
						// -- Item Post Active
						if(is_single()){global $post;
							if(get_post_meta($post->ID, "post-script-not-all-checkbox", true) == "" and get_post_meta($post->ID, "post-script-not-footer-checkbox", true) == ""){
								// --
								$jr_script_not = json_decode(get_post_meta($post->ID, "post-script-not-footer-code-list-checkbox-value", true));
								// --
								if($jr_script_not){
									foreach($jr_script_not as $item_slug_value){if($item['SLUG']===$item_slug_value->slug){$item_found = true;break;}}
								}					
							}
						}
						// -- AMP
						if(is_plugin_active('amp/amp.php')){
							if(amp_is_request()){
								if($item['amp'] !== "on")	{$item['ampload'] = false;}
							}else{
								if($item['amp'] == "on")	{$item['ampload'] = false;}
							}
						}
						// -- Load Script PHP
						if(!isset($item_found) and ($item['ampload'] == true)){
							// -- php
							if(strpos($item['CODE'], '<' . '?') !== false){
								ob_start();eval( '?>' . $item['CODE'] );$item['CODE'] = ob_get_contents();ob_end_clean();echo $item['CODE'];
							}else{
								echo $item['CODE'];
							}
						}						
					}
				}
				echo "<!-- /Script - Footer - Section -->";
			}},10);
		}
	}
}