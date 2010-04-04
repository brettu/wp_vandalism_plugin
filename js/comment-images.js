jQuery(document).ready(function($){
	$('#addCommentImage').click(function(){
		var imageLoc = prompt('Enter your picture file name & extension:');
		if ( imageLoc ) {
			$('#comment').val($('#comment').val() + '[img]' + "'<?php bloginfo('url') ?>'/wp-content/plugins/wp_vandalism_plugin/edited/" + imageLoc + '[/img]');
		}
		return false;
	});
});
