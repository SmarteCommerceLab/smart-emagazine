<?php
/*
* Option - adhost-setting-option[adhost-adv-reset-active]
*/
if($option = sem_option_check('sem-extra-reset-call')){if($option['sem-extra-reset-call'] == true){if(is_admin()){?>
<?php
/* ------------------------------------------------------------------------ *
* Option	- Delete
* ------------------------------------------------------------------------ */	// -- General
	// -- Option List
	$list = array(SEXM_OPTION);
	// -- Option List Delete
	foreach($list as $name){delete_option($name);}
	// -- Option Delete
	delete_option(SEXM_OPTION);
?>
<?php
/* ------------------------------------------------------------------------ *
* Option	- premode
* ------------------------------------------------------------------------ */ 
function sem_option_setting_reset(){
	# - default String
	/* ------------------------------------------------------------------------ */	
	/* ------------------------------------------------------------------------ */
	# - default Array
	$defaults = array(
	);	
return apply_filters(SEXM_OPTION, $defaults);}
?>
<?php
/* ------------------------------------------------------------------------ *
* Option	- register
* ------------------------------------------------------------------------ */ 
if(false == get_option(SEXM_OPTION) or empty(get_option(SEXM_OPTION)) or (get_option(SEXM_OPTION) == null)){
	add_option(SEXM_OPTION, apply_filters(SEXM_OPTION,sem_option_setting_reset()),'',false);
}
?>
<?php }}}