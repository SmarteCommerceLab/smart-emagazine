jQuery(document).ready(function ($) {
    'use strict';	
	// ==================================================================================================== Header List */
		// -- Setting Control
		var jr_head = $('.jr-header-code-control');
		// -- check control
		jr_head.on('change','.jr-header-code-item-active'	, function () {
			var jr_parent_id	= $(this).closest(".jr-header-code-control").attr( "id" );
			if(this.checked){this.value='on';}else{this.value='off';}
			jr_header_json_string(jr_parent_id);
		return false;});
	// ==================================================================================================== Footer List */
		// -- Setting Control
		var jr_footer = $('.jr-footer-code-control');
		// -- check control
		jr_footer.on('change','.jr-footer-code-item-active'	, function () {
			var jr_parent_id	= $(this).closest(".jr-footer-code-control").attr( "id" );
			if(this.checked){this.value='on';}else{this.value='off';}
			jr_footer_json_string(jr_parent_id);
		return false;});
	// ==================================================================================================== sidebar Single List */
		// -- Setting Control
		var jr_single_sidebar = $('.jr-sidebar-single-control');
		// -- check control
		jr_single_sidebar.on('change','.jr-sidebar-single-item-active'	, function () {
			var jr_parent_id	= $(this).closest(".jr-sidebar-single-control").attr( "id" );
			if(this.checked){this.value='on';}else{this.value='off';}
			jr_single_sidebar_json_string(jr_parent_id);
		return false;});
});
// == Header - Json String
function jr_header_json_string(jr_parent_id){
	'use strict';
	// global variables
	var values = [];
	var jr = jQuery("#"+jr_parent_id);
	var item_found = false;
	// ==
	jr.find('.jr-header-code-list-json-value').val('');	
	// iter item
	jr.find('.jr-header-code-item').each(function () {
		// get value
		var th = jQuery(this);
		var slug 						= th.find('.jr-header-code-item-active')	.attr("slug");
		var active 						= th.find('.jr-header-code-item-active')	.val();
		// create array
		if ((active === 'on') && slug !== ''){values.push({'slug' : slug});item_found = true;}
	});
	// create json string 
	jr.find('.jr-header-code-list-json-value').val(JSON.stringify(values));
	if(item_found === false){jr.find('.jr-header-code-list-json-value').val('');}
	// update message to edit post
	jr.find('.jr-header-code-list-json-value').trigger('change');		
}
// == Footer - Json String
function jr_footer_json_string(jr_parent_id){
	'use strict';
	// global variables
	var values = [];
	var jr = jQuery("#"+jr_parent_id);
	var item_found = false;
	// ==
	jr.find('.jr-footer-code-list-json-value').val('');	
	// iter item
	jr.find('.jr-footer-code-item').each(function () {
		// get value
		var th = jQuery(this);
		var slug 						= th.find('.jr-footer-code-item-active')	.attr("slug");
		var active 						= th.find('.jr-footer-code-item-active')	.val();
		// create array
		if ((active === 'on') && slug !== ''){values.push({'slug' : slug});item_found = true;}
	});
	// create json string 
	jr.find('.jr-footer-code-list-json-value').val(JSON.stringify(values));
	if(item_found === false){jr.find('.jr-footer-code-list-json-value').val('');}
	// update message to edit post
	jr.find('.jr-footer-code-list-json-value').trigger('change');		
}
// == sidebar Single - Json String
function jr_single_sidebar_json_string(jr_parent_id){
	'use strict';
	// global variables
	var values = [];
	var jr = jQuery("#"+jr_parent_id);
	var item_found = false;
	// ==
	jr.find('.jr-sidebar-single-list-json-value').val('');	
	// iter item
	jr.find('.jr-sidebar-single-item').each(function () {
		// get value
		var th = jQuery(this);
		var slug 						= th.find('.jr-sidebar-single-item-active')	.attr("slug");
		var active 						= th.find('.jr-sidebar-single-item-active')	.val();
		// create array
		if ((active === 'on') && slug !== ''){values.push({'slug' : slug});item_found = true;}
	});
	// create json string 
	jr.find('.jr-sidebar-single-list-json-value').val(JSON.stringify(values));
	if(item_found === false){jr.find('.jr-sidebar-single-list-json-value').val('');}
	// update message to edit post
	jr.find('.jr-sidebar-single-list-json-value').trigger('change');		
}