<?php
//https://github.com/jackocnr/intl-tel-input#demo-and-examples
//https://plugins.smyl.es/docs-kb/how-to-customize-the-phone-field-type/
//https://gist.github.com/ajskelton
//https://code.tutsplus.com/tutorials/a-guide-to-the-wordpress-theme-customizer-what-it-is-why-it-benefits-us--wp-32959
//http://www.html.it/pag/57009/i-metodi-del-theme-customizer-di-wordpress/
//https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-1
//https://github.com/maddisondesigns/customizer-custom-controls
?>
<?php
$sem_has_customizer_runtime = is_plugin_active( 'smart-bootstrap-manager/smart-bootstrap-manager.php' )
	&& ( defined( 'MZR_VERSION' ) || class_exists( 'Smart_Customizer_Control_Toggle_Checkbox' ) );

if ( $sem_has_customizer_runtime ) {
// -- Panel 	- Smart eMagazine
add_action('customize_register',function($wp_customize){
	// -------------------------------------------------------------------------------------------------------------/ Panel - Smart eMagazne
	$wp_customize->add_panel('smart-emagazine-website-panel',array(
		'title'					=> 'Smart eMagazine',
		'description'			=> '<strong>Imposta i settaggi per il Tema eMagazine</strong>',
	));
	// -------------------------------------------------------------------------------------------------------------/ Panel - Smart eMagazine Builder
	$wp_customize->add_panel('smart-emagazine-builder-panel',array(
		'title'					=> 'Smart eMagazine Builder',
		'description'			=> '<strong>Costruisci le Pagine del tuo sito</strong>',
	));	
});
// -- Section 	- Sito
add_action('customize_register',function($wp_customize){
	// -------------------------------------------------------------------------------------------------------------/ Section - Sito
	$wp_customize->add_section('Journal_website_section',array(
		'title'     			=> 'General',
		'panel'					=> 'smart-emagazine-website-panel',
	));
	// ----------------------------------------------------------------------/ Logo
	$wp_customize->add_setting('Journal_media_setting_id',array(
		'sanitize_callback' 	=> 'absint',
		'validate_callback' 	=> 'sem_validate_image',
	));
	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize,'Journal_media_setting_id',array(
		'label' 				=> __('Imposta Logo (500 x 100)px','Journal'),
		'section' 				=> 'Journal_website_section',
		'mime_type' 			=> 'image',
	)));
	$wp_customize->selective_refresh->add_partial('Journal_media_setting_id',array(
		'selector' 				=> '.Logo',
		'container_inclusive' 	=> false,
		'fallback_refresh' 		=> false
	));
	function sem_validate_image($validity,$value){
		// --
		$image_attributes = wp_get_attachment_image_src($value);
		$image = $image_attributes[0];
		// --
		$mimes = array(
		  'jpg|jpeg|jpe' 		=> 'image/jpeg',
		  'gif'          		=> 'image/gif',
		  'png'          		=> 'image/png',
		  'bmp'          		=> 'image/bmp',
		  'tif|tiff'     		=> 'image/tiff',
		  'ico'          		=> 'image/x-icon'
		);
		// --
		$file = wp_check_filetype($image,$mimes);
		if(!$value){$validity->add('required',__('Please choose an image'));} 
	return $validity;}
	// ----------------------------------------------------------------------/ categorie-to-query
	$wp_customize->add_setting('smart-emagazine-option[sem-not-include-category]',array(
		'type' 					=> 'option',
		'capability' 			=> 'edit_theme_options',
		'sanitize_callback' 	=> 'sanitize_text_field',
		'default' 				=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-not-include-category]',array(
		'type' 				=> 'text',
		'section' 			=> 'Journal_website_section',
		'settings'   		=> 'smart-emagazine-option[sem-not-include-category]',
		'label' 			=> __('Categorie'),
		'description' 		=> __('Escludi i contenuti delle categorie (ID,ID,...)'),
	));
	// ----------------------------------------------------------------------/ tag-to-query
	$wp_customize->add_setting('smart-emagazine-option[sem-not-include-tag]',array(
		'type' 				=> 'option',
	  	'capability' 		=> 'edit_theme_options',
	  	'sanitize_callback'	=> 'sanitize_text_field',
	  	'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-not-include-tag]',array(
	  'type' 				=> 'text',
	  'section' 			=> 'Journal_website_section',
	  'settings'   			=> 'smart-emagazine-option[sem-not-include-tag]',
	  'label' 				=> __('Tag'),
	  'description' 		=> __('Non mostrare i seguenti Tag (ID,ID,...)'),
	));
	// ----------------------------------------------------------------------/ content-size
	$wp_customize->add_setting('smart-emagazine-option[sem-content-wrapper-size]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '1280',
	));
	$wp_customize->add_control('sem-content-wrapper-size',array(
	  'type' 				=> 'text',
	  'section' 			=> 'Journal_website_section',
	  'settings'   			=> 'smart-emagazine-option[sem-content-wrapper-size]',
	  'label' 				=> __('Width(px)'),
	  'description' 		=> __('Imposta la larghezza del sito'),
	));	
});
// -- Section 	- Social
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- Social
	$wp_customize->add_section('journal_social_section',array(
		'title'      		=> 'Social',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ---------------------------------------------------------------------- facebook
	$wp_customize->add_setting('smart-emagazine-option[sem-social-url-facebook]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control('journal_social_facebook_url_setting_id',array(
		'type' 				=> 'text',
		'section' 			=> 'journal_social_section',
		'settings'   		=> 'smart-emagazine-option[sem-social-url-facebook]',
		'label' 			=> __('Facebook'),
		'description' 		=> __('Inserisci url pagina'),
	));
	// ---------------------------------------------------------------------- twitter
	$wp_customize->add_setting('smart-emagazine-option[sem-social-url-twitter]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-social-url-twitter]',array(
		'type' 				=> 'text',
		'section' 			=> 'journal_social_section',
		'settings'   		=> 'smart-emagazine-option[sem-social-url-twitter]',
		'label' 			=> __('Twitter'),
		'description' 		=> __('Inserisci ID Account'),
	));
	// ---------------------------------------------------------------------- youtube
	$wp_customize->add_setting('smart-emagazine-option[sem-social-url-youtube]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-social-url-youtube]',array(
		'type' 				=> 'text',
		'section' 			=> 'journal_social_section',
		'settings'   		=> 'smart-emagazine-option[sem-social-url-youtube]',
		'label' 			=> __('Youtube'),
		'description' 		=> __('Inserisci ID Canale'),
	));
	// ---------------------------------------------------------------------- linkedin
	$wp_customize->add_setting('smart-emagazine-option[sem-social-url-linkedin]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-social-url-linkedin]',array(
		'type' 				=> 'text',
		'section' 			=> 'journal_social_section',
		'settings'   		=> 'smart-emagazine-option[sem-social-url-linkedin]',
		'label' 			=> __('Linkedin'),
		'description' 		=> __('Inserisci Url'),
	));
	// ---------------------------------------------------------------------- instagram
	$wp_customize->add_setting('smart-emagazine-option[sem-social-url-instagram]',array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-social-url-instagram]',array(
		'type' 				=> 'text',
		'section' 			=> 'journal_social_section',
		'settings'   		=> 'smart-emagazine-option[sem-social-url-instagram]',
		'label' 			=> __('Instagram'),
		'description' 		=> __('Inserisci Url'),
	));
});
// -- Section 	- Script
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- script - Object
	$wp_customize->add_section('journal_script_section',array(
		'title'     		=> 'Script',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------/ Script - Head - Not Activated
	// ----------------------------------------------------------------------/ Script - repeater
	$wp_customize->add_setting('smart-emagazine-option[sem-script-head-code]',array(
		'type' 				=> 'option',	
		 'sanitize_callback'=> ''
	));
	$wp_customize->add_control(new Customizer_jRepeater($wp_customize,'smart-emagazine-option[sem-script-head-code]',array(
		'label'   			=> esc_html__('Head Script','jRepeater'),
		'description' 		=> __('Inserisci Gli Script in HEAD da aggiungere a tutte le pagine del sito, SENZA Abilitazione  ADV'),
		'section' 			=> 'journal_script_section',
	)));
	// ----------------------------------------------------------------------/ Script - Active
	$wp_customize->add_setting('smart-emagazine-option[sem-script-head-code-active]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-script-head-code-active]',array(
		'label' 			=> 'Active Head Script',
		'description' 		=> '',
		'section' 			=> 'journal_script_section'
	)));
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------/ Script - Footer - Not Activated
	// ----------------------------------------------------------------------/ Script - repeater
	$wp_customize->add_setting('smart-emagazine-option[sem-script-footer-code]',array(
		'type' 				=> 'option',
		'sanitize_callback' => ''
	));
	$wp_customize->add_control( new Customizer_jRepeater( $wp_customize,'smart-emagazine-option[sem-script-footer-code]', array(
		'label'   			=> esc_html__('Footer Script','jRepeater'),
		'description' 		=> __('Inserisci Gli Script in FOOTER da aggiungere a tutte le pagine del sito, SENZA Abilitazione  ADV'),
		'section' 			=> 'journal_script_section',
	)));
	// ----------------------------------------------------------------------/ Script - Active
	$wp_customize->add_setting('smart-emagazine-option[sem-script-footer-code-active]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-script-footer-code-active]',array(
		'label' 			=> 'Active Footer Script',
		'description' 		=> '',
		'section' 			=> 'journal_script_section'
	)));
});
// -- Section 	- Page
add_action('customize_register',function($wp_customize){$page_list = get_pages();
	foreach(get_pages() as $page_item) {#var_dump($page_item);#echo $page_item->post_title.':'.$page_item->ID.' - ';	
		$page_item->template = get_page_template_slug($page_item->ID);	
		if($page_item->template == 'smart-site-builder.php' or $page_item->template == 'smart-site-home.php'){
			// ---------------------------------------------------------------------- Label
			$wp_customize->add_section('sem-page-'.$page_item->ID.'-section' , array(
				'title'      		=> $page_item->post_title,
				'panel'		 		=> 'smart-emagazine-builder-panel',
			));
			// ---------------------------------------------------------------------- Script - repeater
			$wp_customize->add_setting('smart-emagazine-option[sem-page-'.$page_item->ID.'-compose-control-setting]', array(
				'type' 				=> 'option',
				'sanitize_callback' => ''
			));
			$wp_customize->add_control(new Mizer_Compose_Control($wp_customize,'smart-emagazine-option[sem-page-'.$page_item->ID.'-compose-control-setting]',array(
				'label'   			=> __($page_item->post_title),
				'description' 		=> __('Agguingi alla page i Widget per la creazione della pagina'),
				'section' 			=> 'sem-page-'.$page_item->ID.'-section'
			)));
		}
	}
});
// -- Section 	- Articoli
add_action('customize_register',function($wp_customize){
	// ----------------------------------------------------------------------/ Label
	$wp_customize->add_section( 'journal_article_section' , array(
		'title'     		=> 'Articoli',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ----------------------------------------------------------------------/ Image Size Control
	$wp_customize->add_setting('smart-emagazine-option[sem-article-image-size-control]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-article-image-size-control]',array(
		'label' 			=> __( 'Image size Control', 'Smart eMagazine' ),
		'description' 		=> __( 'Controllo dimensioni minime Immagine' ),
		'section' 			=> 'journal_article_section'
	)));
	// ----------------------------------------------------------------------/ Next-Previous Post
	$wp_customize->add_setting('smart-emagazine-option[sem-article-next-prev]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-article-next-prev]',array(
		'label' 			=> __( 'Next/Prev Article', 'Toggle_Switch_Control' ),
		'description' 		=> __( 'Attiva i Post Next e Previous' ),
		'section' 			=> 'journal_article_section'
	)));
	$wp_customize->selective_refresh->add_partial('sem_article_next_prev', array(
		'selector' 				=> '.next_prev_post',
		'container_inclusive' 	=> false,
		'fallback_refresh' 		=> false
	));
	// ----------------------------------------------------------------------/ Related - Active
	$wp_customize->add_setting('smart-emagazine-option[sem-article-related]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-article-related]',array(
		'label' 			=> __( 'Articoli correlati', 'Toggle_Switch_Control' ),
		'description' 		=> __( 'Mostra articoli relativi al contenuto' ),
		'section' 			=> 'journal_article_section'
	)));
	$wp_customize->selective_refresh->add_partial( 'sem_article_related', array(
		'selector' 				=> '.related',
		'container_inclusive' 	=> false,
		'fallback_refresh' 		=> false
	));
	// ----------------------------------------------------------------------/ Related Link - Active
	$wp_customize->add_setting('smart-emagazine-option[sem-article-related-link]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-article-related-link]',array(
		'label' 			=> __( 'Link correlati', 'Toggle_Switch_Control' ),
		'description' 		=> __( 'Mostra Link relativi al contenuto' ),
		'section' 			=> 'journal_article_section'
	)));
	$wp_customize->selective_refresh->add_partial( 'sem_article_related_link', array(
		'selector' 				=> '.related_link',
		'container_inclusive' 	=> false,
		'fallback_refresh' 		=> false
	));		
	// ----------------------------------------------------------------------/ Image Size Control
	#$wp_customize->add_setting( 'journal_articolo_image_size_control_list',	array(
		#'default' 			=> 'Editor',
		#'transport' 		=> 'refresh',
		#'sanitize_callback' => 'switch_sanitization'
	#));
	#$wp_customize->add_control('journal_articolo_image_size_control_list',	array(
		#'type' 				=> 'select',
		#'label' 			=> __( 'Image size Control', 'Toggle_Switch_Control' ),
		#'description' 		=> __( 'Controllo dimensioni minime Immagine' ),
		#'section' 			=> 'journal_article_section',
		#'choices'			=> array(
			#'disabled'	=> __( 'disabled'	, 'text-domain' ),
			#'Editor'	=> __( 'Editor'		, 'text-domain' ),
			#'Admin' 	=> __( 'Admin'		, 'text-domain' )
		#),
	#));
});
// -- Section 	- Redazione
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- Redazione
	$wp_customize->add_section('journal_redazione_section' , array(
		'title'      		=> 'Redazione',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ---------------------------------------------------------------------- Telefono
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-telefono]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-redazione-telefono]', array(#journal_contatti_telefono_setting_id
		'type' 				=> 'text',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-telefono]',
		'label' 			=> __( 'Telefono' ),
		'description' 		=> __( 'Inserisci il contatto telefono generale' ),
	));
	function journal_contatti_telefono_sanitize_number_absint( $number, $setting ) {$number = absint( $number );return ( $number ? $number : $setting->default );}
	// ---------------------------------------------------------------------- email-contatti
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-email]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
		'sanitize_callback' => 'journal_contatti_sanitize_email',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-redazione-email]', array(
		'type' 				=> 'email',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-email]',
		'label' 			=> __( 'e-Mail' ),
		'description' 		=> __( 'Iserisci e-mail generale' ),
		'input_attrs' 		=> array(
		'placeholder' 		=> __( 'email@domain.com' ),
	  ),
	));
	function journal_contatti_sanitize_email( $email, $setting ) {return ( is_email($email) ? $email : $setting->default );}
	// ---------------------------------------------------------------------- direttore
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-direttore-name]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' 			=> '',
	));
	$wp_customize->add_control( 'smart-emagazine-option[sem-redazione-direttore-name]', array(
		'type' 				=> 'text',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-direttore-name]',
		'label' 			=> __( 'Direttore' ),
		'description' 		=> __( 'Inserisci il nominativo del direttore' ),
	));
	// ---------------------------------------------------------------------- email-segreteria
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-segreteria-email]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
		'sanitize_callback' => 'journal_redazione_email_segreteria_sanitize_email',
	));
		$wp_customize->add_control( 'smart-emagazine-option[sem-redazione-segreteria-email]', array(
		'type' 				=> 'email',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-segreteria-email]',
		'label' 			=> __( 'Segretria' ),
		'description' 		=> __( 'Iserisci e-mail' ),
		'input_attrs' 		=> array(
		'placeholder' 		=> __( 'email@domain.com' ),
	  ),
	));
	function journal_redazione_email_segreteria_sanitize_email( $email, $setting ) {return ( is_email($email) ? $email : $setting->default );}
	// ---------------------------------------------------------------------- email-redazione
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-redazione-email]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
		'sanitize_callback' => 'journal_redazione_email_redazione_sanitize_email',
	));
	$wp_customize->add_control( 'smart-emagazine-option[sem-redazione-redazione-email]', array(
		'type' 				=> 'email',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-redazione-email]',
		'label' 			=> __( 'Redazione' ),
		'description' 		=> __( 'Iserisci e-mail' ),
		'input_attrs' 		=> array(
		'placeholder' => __( 'email@domain.com' ),
	  ),
	));
	function journal_redazione_email_redazione_sanitize_email( $email, $setting ) {return ( is_email($email) ? $email : $setting->default );}
	// ---------------------------------------------------------------------- email-direttore
	$wp_customize->add_setting('smart-emagazine-option[sem-redazione-direttore-email]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
		'sanitize_callback' => 'journal_redazione_email_direttore_sanitize_email',
	));
	$wp_customize->add_control( 'smart-emagazine-option[sem-redazione-direttore-email]', array(
		'type' 				=> 'email',
		'section' 			=> 'journal_redazione_section',
		'settings'   		=> 'smart-emagazine-option[sem-redazione-direttore-email]',
		'label' 			=> __( 'Direttore' ),
		'description' 		=> __( 'Iserisci e-mail' ),
		'input_attrs' 		=> array(
		'placeholder' 		=> __( 'email@domain.com' ),
	  ),
	));
	function journal_redazione_email_direttore_sanitize_email( $email, $setting ) {return ( is_email($email) ? $email : $setting->default );}
});
// -- Section 	- Publisher
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- Section - publisher
		$wp_customize->add_section('Journal_publisher_section' , array(
			'title'      		=> 'Editori',
			'panel'				=> 'smart-emagazine-website-panel',
		));
		// ----------------------------------------------------------------------/ copyright
		$wp_customize->add_setting('smart-emagazine-option[sem-publisher-copyright]', array(
			'type' 				=> 'option',
			'capability' 		=> 'edit_theme_options',
			'default' 			=> '',
		));
		$wp_customize->add_control('smart-emagazine-option[sem-publisher-copyright]', array(
			'type' 				=> 'textarea',
			'settings'   		=> 'smart-emagazine-option[sem-publisher-copyright]',
			'section' 			=> 'Journal_publisher_section',
			'label'				=> __( 'Copyright' ),
			'description' 		=> __( 'Inserisci la dicitura copyright' ),
		));
		// ----------------------------------------------------------------------/ sede
		$wp_customize->add_setting('smart-emagazine-option[sem-publisher-sede]', array(
			'type' 				=> 'option',
			'capability' 		=> 'edit_theme_options',
			'default' 			=> '',
		));
		
		$wp_customize->add_control('smart-emagazine-option[sem-publisher-sede]', array(
			'type' 				=> 'textarea',
			'settings'   		=> 'smart-emagazine-option[sem-publisher-sede]',
			'section' 			=> 'Journal_publisher_section',
			'label'				=> __( 'Sede' ),
			'description' 		=> __( 'Inserisci la sede della redazione' ),
		));
		// ----------------------------------------------------------------------/ fiscale
		$wp_customize->add_setting('smart-emagazine-option[sem-publisher-fiscale]', array(
			'type' 				=> 'option',
			'capability' 		=> 'edit_theme_options',
			'default' 			=> '',
		));
		$wp_customize->add_control('smart-emagazine-option[sem-publisher-fiscale]', array(
			'type' 				=> 'textarea',
			'settings'   		=> 'smart-emagazine-option[sem-publisher-fiscale]',
			'section' 			=> 'Journal_publisher_section',
			'label'				=> __( 'Dati Aziendali' ),
			'description' 		=> __( 'Inserisci la i dati fiscali dell\'azienda' ),
		));
});
// -- Section 	- Smart eCommerce
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- Smart eCommerce - Object
	$wp_customize->add_section( 'journal_script_section_sec' , array(
		'title'    			=> 'Agenzia',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ---------------------------------------------------------------------- Agenzia
	$wp_customize->add_setting('smart-emagazine-option[sem-agenzia-copyright]', array(
		'type' 				=> 'option',
		'capability' 		=> 'edit_theme_options',
		'default' 			=> '',
	));
	$wp_customize->add_control('smart-emagazine-option[sem-agenzia-copyright]', array(
		'type' 				=> 'textarea',
		'settings'   		=> 'smart-emagazine-option[sem-agenzia-copyright]',
		'section' 			=> 'journal_script_section_sec',
		'label'				=> __( 'Agenzia' ),
		'description' 		=> __( 'Inserisci la dicitura da aggiungere al Footer' ),
	));
});
// -- Section 	- Option
add_action('customize_register',function($wp_customize){
	// ------------------------------------------------------------------------------------------------------------- Section - Sito
	$wp_customize->add_section( 'Journal_Option_Section' , array(
		'title'      		=> 'Option',
		'panel'				=> 'smart-emagazine-website-panel',
	));
	// ----------------------------------------------------------------------/ reset call - Active
	$wp_customize->add_setting('smart-emagazine-option[sem-extra-reset-call]',array(
		'type' 				=> 'option',
		'default' 			=> 0,
		'transport' 		=> 'refresh',
		'sanitize_callback' => 'switch_sanitization'
	));
	$wp_customize->add_control(new Smart_Customizer_Control_Toggle_Checkbox($wp_customize,'smart-emagazine-option[sem-extra-reset-call]',array(
		'label' 			=> 'Reset Option Call',
		'description' 		=> 'Riporta alle condizioni di default le impostazioni del tema',
		'section' 			=> 'Journal_Option_Section'
	)));
	// ----------------------------------------------------------------------/	
	/*$wp_customize->add_setting( 'logo', array(
		'capability'        => 'edit_theme_options',
		'default'           => '',
		'sanitize_callback' => 'ic_sanitize_image',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo',
		array(
			'label'    		=> __( 'Logo', 'text-domain' ),
			'section' 		=> 'Journal_Option_Section',
			'settings' 		=> 'logo',
		)
	) );*/
});
?><?php }
