<?php
/*
* Check e Retrive value of Option Control
*/
# if($option = sem_option_check('')){}
function sem_option_check($field){
	$option = get_option(SEXM_OPTION);
	if(isset($option) and !empty($option) and $option !== null){
		if(isset($option[$field]) and !empty($option[$field]) and $option[$field] !== null){
			return $option;
		}
	}
};
/*
* Check e Retrive value of Option Control
*/
# if($option = sem_option_check_true('')){}
function sem_option_check_true($field){$option = get_option(SEXM_OPTION);
	if(isset($option) and !empty($option) and $option !== null){
		if(isset($option[$field]) and !empty($option[$field]) and $option[$field] !== null){
			if($option[$field] == true){return $option;}
		}
	}
};
?>