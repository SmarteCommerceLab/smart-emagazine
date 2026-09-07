jQuery(document).ready(function ($) {'use strict';
	$(document).on('mousedown', function(){$("#wp-selected-count .selected-count").html(0);});
	$('#content').on('select',function(){$("#wp-selected-count .selected-count").html(document.getSelection().toString().length);});
	/*$('#taxonomy-category input[type=checkbox]').on('click', function(){alert($(this).attr('checked'));
		if($(this).attr('checked').value()!=='checked'){$('#taxonomy-category input[type=checkbox]').attr('disabled', false);}
	});
	$('#taxonomy-category').find('input[type=checkbox]:not(:checked)').attr('disabled',true);
	//$('#taxonomy-category input[type=checkbox]').each(function(){if($(this).attr('checked') !== 'checked'){$(this).attr('disabled', true);}})​;*/
});
