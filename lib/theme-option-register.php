<?php
/* ------------------------------------------------------------------------ *
* Option	- default
* ------------------------------------------------------------------------ */ 
function sem_option_setting_default(){
	$defaults = array(
	);	
return apply_filters(SEXM_OPTION, $defaults);}
?>
<?php
/* ------------------------------------------------------------------------ *
* Option	- register
* ------------------------------------------------------------------------ */ 
if(false == get_option(SEXM_OPTION) or empty(get_option(SEXM_OPTION)) or (get_option(SEXM_OPTION) == null)){
	add_option(SEXM_OPTION, apply_filters(SEXM_OPTION,sem_option_setting_default()),'',false);
}
?>