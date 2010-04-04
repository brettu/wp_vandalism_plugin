<?php
/*
* Plugin Name: WP Vandalism Plugin
* Plugin URI: http://www.brettu.com/
* Description: Plugin for editing/vandalizing photos with Pixlr and re-posting into the comments
* Author: Brett Weik-Ulrich
* Version: 1.0
* Author URI: http://www.brettu.com
*/


/*

    Copyright 2009 by Brett Weik-Ulrich <bweikulrich@mac.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function pixlr_link_input_fields($form_fields, $post, $url_type='') {
		 if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
		   	
			$pixlr_link = wp_get_attachment_url($post->ID);
			$pixlr_file = get_attachment_link($post->ID);
			
			$url = '';
			if ( $url_type == 'file' )
				$url = $pixlr_link;
			elseif ( $url_type == 'post' )
				$url = $pixlr_file;
				
			$form_fields = array(
				'post_title'   => array(
					'label'      => __('Title'),
					'value'      => $edit_post->post_title,
				),
				'post_excerpt' => array(
					'label'      => __('Caption'),
					'value'      => $edit_post->post_excerpt,
				),
				'post_content' => array(
					'label'      => __('Description'),
					'value'      => $edit_post->post_content,
					'input'      => 'textarea',
				),
				'url'          => array(
					'label'      => __('Your Links are Now Pixlr'),
					'input'      => 'html',
					'html'       => "
					<input type='text' class='urlfield'  name='attachments[$post->ID][url]' value='" . esc_attr($url) . "' /><br />
							<button type='button' class='button urlnone' title=''>" . __('None') . "</button>
<!--							<button type='button' class='button urlfile' title='" . esc_attr($pixlr_file) . "'>" . __('Post URL') . "</button> -->
							<button type='button' class='button urlpost' title='" . esc_attr($pixlr_link) . "'>" . __('File URL') . "</button>
						
							
							",
					'helps'      => __('Enter a link URL or click above for presets.'),
				),
				'menu_order'   => array(
					'label'      => __('Order'),
					'value'      => $edit_post->menu_order
				),
				'align' => array(
					'label' => __('Alignment'),
					'input' => 'html',
					'html'  => image_align_input_fields($post, get_option('image_default_align')),
				
				),

			
			);
			
			$form_fields['image-size'] = image_size_input_fields($post, get_option('image_default_size')); 

		 } 
		 return $form_fields;
}

function pixlr_wp_admin_header(){
	if(is_single()) {
	
		?>	
		<script type='text/javascript' src='<?php bloginfo('url') ?>/wp-content/plugins/drawing_app/js/pixlr_minified.js'></script><br />
		<script type="text/javascript">
					//Global setting edit these
					pixlr.settings.target = '<?php bloginfo('url') ?>/wp-content/plugins/drawing_app/save_post_modal.php';
					pixlr.settings.exit = '<?php bloginfo('url') ?>/wp-content/plugins/drawing_app/exit_modal.php';
					pixlr.settings.credentials = true;
					pixlr.settings.method = 'post';
				
		</script> 
		<script type="text/javascript" charset="utf-8">
				jQuery(document).ready(function($){
					$('#addCommentImage').click(function(){
						var imageLoc = prompt('Enter your picture file name & extension:');
						if ( imageLoc ) {
							$('#comment').val($('#comment').val() + '[img]' + '<?php bloginfo('url') ?>/wp-content/plugins/drawing_app/edited/' + imageLoc + '[/img]');
						}
						return false;
					});
				});


		</script>
		
		
<?php   }


}

function pixlr_image_replace($id, $alt, $title, $align,  $rel = false, $url='', $size='medium') {
 	 
 	 	$htmlalt = ( empty($alt) ) ? $title : $alt;
		$html_pixlr = get_image_tag($id, $htmlalt, $title, $align, $size);

          if ( $url )
 	           $html_pixlr = "<a href=\"javascript:pixlr.overlay.show({image:'" . $url . "'});\"><img src=\"" . $url . "\"/></a>"; 	    
			 
 	      return $html_pixlr;
 }

function embed_pixlr_images($content) {
			$content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\"  alt=\"" . basename("$1") . "\" />"', $content);
			return $content;			
}

//enables javascript to uploaded the image
function embed_pixlr_instructions($id) {
			echo '<p>Add your image to the comment by <a id="addCommentImage" href="#"><em>clicking here</em></a>.</p>';
			return $id;
}


add_filter('get_comment_text', 'embed_pixlr_images', 9, 1);
add_action('comment_form', 'embed_pixlr_instructions');
add_filter('wp_head', 'pixlr_wp_admin_header');
add_filter('attachment_fields_to_edit', 'pixlr_link_input_fields', 11, 3);
add_filter('image_send_to_editor', 'pixlr_image_replace', 9, 7);

?>