<?php
/*
Plugin Name: MagicFields Duplicator
Plugin URI: http://plantcph.dk
Description: Duplicates a custom posttype and it's content to a new post/page
Author: Jens Søgaard
Version: 0.1
Author URI: http://plantcph.dk
*/

add_action('admin_menu', 'magicfields_duplicator_menu');
function magicfields_duplicator_menu() {
	add_menu_page('MagicFields Duplicator', 'MagicFields Duplicator', 'manage_options', 'magicfields_duplicator', 'magicfields_duplicator_options');
}

function magicfields_duplicator_options() {
	$debug = false;
	global $wpdb;
	
	$new_post_id = 0;
	$new_pm_id = 0;
	
	if($_GET['action'] == "duplicate"){
		if($_POST['new_title'] == "" || $_POST['source_post'] == ""){
			$message = "<h2>Error. Please complete the form.</h2><br/>";
		} else {
			// Loop over wp_posts
			$items = $wpdb->get_results('SELECT * FROM wp_posts WHERE post_status = "publish" AND post_type != "nav_menu_item" AND post_type != "post" AND post_type != "page" AND ID = '.intval($_POST['source_post']).' LIMIT 1');
			foreach($items as $item){
				// Indsæt ny række i wp_posts
				$exlude_fields = array('post_title','ID','post_modified_gmt','post_modified');
				$fields = array(
								'post_title' => $_POST['new_title']
							);
				$field_types = array(
								'%s'
							);
				foreach($item as $k => $v){
					if( !in_array($k, $exlude_fields) ){
						$fields[$k] = $v;
						$field_types[] = '%s';
					}
				}
			
				if(!$wpdb->insert(
						'wp_posts',
						$fields,
						$field_types
					))
				{
					die("Error inserting into posts");
				}
				$new_post_id = $wpdb->insert_id;
				if($new_post_id == "" || $new_post_id == false) die("ERROR. New post id not returned");
				/* */
			}
			
				
			// Loop over wp_postmeta
			$items = $wpdb->get_results('SELECT * FROM wp_postmeta WHERE post_id = '.intval($_POST['source_post']));
			foreach($items as $item){
				// Indsæt nye rækker i wp_postmeta
				
				$meta_id = $item->meta_id;
				
				$exlude_fields = array('meta_id','post_id');
				$fields = array(
								'post_id' => $new_post_id
							);
				$field_types = array(
								'%s'	
							);
				foreach($item as $k => $v){
					if( !in_array($k, $exlude_fields) ){
						$fields[$k] = $v;
						$field_types[] = '%s';
					}
				}
				
				if(!$wpdb->insert(
						'wp_postmeta',
						$fields,
						$field_types
					))
				{
					die("Error inserting into postmeta");
				}
				$new_pm_id = $wpdb->insert_id;
				if($new_pm_id == "" || $new_pm_id == false || is_null($new_pm_id) ) die("ERROR. New postmeta id not returned");
				/* */
			
				// Loop over wp_mf_post_meta
				$items = $wpdb->get_results('SELECT * FROM wp_mf_post_meta WHERE meta_id = '.$meta_id);
				foreach($items as $item){
				
					// Indsæt rækker i wp_mf_post_meta
					$exlude_fields = array('meta_id','post_id');
					$fields = array(
									'meta_id' => $new_pm_id,
									'post_id' => $new_post_id
								);
					$field_types = array(
									'%s',
									'%s'
								);
					foreach($item as $k => $v){
						if( !in_array($k, $exlude_fields) ){
							$fields[$k] = $v;
							$field_types[] = '%s';
						}
					}
			
					if(!$wpdb->insert(
							'wp_mf_post_meta',
							$fields,
							$field_types
						))
					{
						die("Error inserting into mf_post_meta");
					}
				}
			}
				
			$message = "<h2>Item has been duplicated</h2><br/>";
		}
	}
	
	
	echo '<div class="wrap">';
		echo '<h1>MagicFields Duplicator</h1>';
		echo $message;
	
		print '<form method="post" action="admin.php?page=magicfields_duplicator&action=duplicate">';
			print 'Select item to duplicate ' . showPosttypesDropdown() .'<br>';
			print 'New title <input type="text" name="new_title"> (must be filled)';
			
			print '<br><input type="submit" name="Duplicate" value="Duplicate">';
		print '</form>';
	print '</div>';
}

function showPosttypesDropdown(){
	global $wpdb;
	
	$html = '<select name="source_post">';
	$items = $wpdb->get_results('SELECT ID, post_type, post_title FROM wp_posts WHERE post_status = "publish" AND post_type != "nav_menu_item" AND post_type != "post" AND post_type != "page"');
	foreach($items as $item){
		$html .= '<option value="'.$item->ID.'">'.$item->post_type. ' - ' .$item->post_title.'</option>';
	}
	$html .= '</select>';
	return $html;
}
?>