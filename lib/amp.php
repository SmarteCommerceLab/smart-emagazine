<?php
/*
* Remove AMP to AMP Link
*/
add_filter('amp_to_amp_linking_enabled', '__return_false');
/*======================================================= Primo sviluppo di amp in proprio
/* define('AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );
// -- registra un endpoint
add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
// -- redirect endpoint template
add_filter( 'template_include',function($template){
    if(get_query_var( AMP_QUERY_VAR, false ) !== false ) {
        if(is_single()){
            $template = SEM_DIR_PATH.'/single-amp.php';
        } 
    }
    return $template;
}, 99 );*/