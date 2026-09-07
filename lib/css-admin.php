<?php
/*
* Register css
*/
add_action('admin_enqueue_scripts',function(){wp_enqueue_style('sem-admin-css',SEXM_DIR_URL.'/css/admin-css.min.css',array(),SEXM_VDATA,'');});
#wp_enqueue_style('seodots-admin-css',SSO_DIR_URL.'resource/css/seodots.css',array(),$ver,'');