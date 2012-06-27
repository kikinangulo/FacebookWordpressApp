<?php
/*
Plugin Name: MF to array
Plugin URI: http://plantcph.dk
Description: Gets all MF data and creates an array. Usage: $data = MF_to_array();
Author: Jens Søgaard
Version: 1.0
Author URI: http://plantcph.dk
*/

function cleanMfString($str)
{
	if( !safe_unserialize($str) ){
		return $str;
	} else {
		$str = safe_unserialize($str);
		return $str[0];
	}
}

function safe_unserialize($serialized)
{
    // unserialize will return false for object declared with small cap o
    // as well as if there is any ws between O and :
    if (is_string($serialized) && strpos($serialized, "\0") === false) {
        if (strpos($serialized, 'O:') === false) {
            // the easy case, nothing to worry about
            // let unserialize do the job
            return @unserialize($serialized);
        } else if (!preg_match('/(^|;|{|})O:[0-9]+:"/', $serialized)) {
            // in case we did have a string with O: in it,
            // but it was not a true serialized object
            return @unserialize($serialized);
        }
    }
    return false;
}

function mf_get_default_value($post_type, $meta_key){
	global $wpdb;
	$items = $wpdb->get_results('SELECT ID, post_title, post_content, post_type FROM wp_posts WHERE post_type = "'.$post_type.'" AND post_title = "en" AND post_status = \'publish\'');
	foreach($items as $item){
		return get($meta_key,1,1,$item->ID);
	}
}

function MF_to_array() {
	
	$mtime = microtime(); 
	$mtime = explode(" ",$mtime); 
	$mtime = $mtime[1] + $mtime[0]; 
	$starttime = $mtime; 
	
	
	global $wpdb;
	$data = array();
	
	// Get current lang	from session var
	if(!empty($_SESSION['lang'])){
		$lang = $_SESSION['lang'];
	} else {
		$lang = 'en';
	}
	
	$items = $wpdb->get_results('SELECT ID, post_title, post_content, post_type FROM wp_posts WHERE post_title = "'.$lang.'" AND post_type != "page" AND post_type != "post" AND post_status = \'publish\'');
	foreach($items as $item){
		// Find the page matching the language
			$data[$item->post_type] = array();
			$data[$item->post_type]['post_content'] = $item->post_content;
			// Loop through MF fields and groups
			$attribs = $wpdb->get_results('SELECT pm.meta_key, pm.meta_value, mf_pm.group_count
										FROM  `wp_mf_post_meta` AS mf_pm, wp_postmeta AS pm
										WHERE mf_pm.post_id = '.$item->ID.'
										AND mf_pm.meta_id = pm.meta_id ORDER BY mf_pm.group_count ASC');
			$vals = array();
		
			foreach($attribs as $a){
				//$field = get($a->meta_key, $a->group_count, 1, $item->ID);
				$field = $a->meta_value;
				
				$test = @unserialize($field);
				if ($test !== false) {
				    // Is serialized
					$field = $test[0];
				}
				
				// Check if it's an image
				$type=Array(1 => '.jpg', 2 => '.jpeg', 3 => '.png', 4 => '.gif'); //store all the image extension types in array
				$ext = explode(".",$field); //explode and find value after dot
				if(in_array(".".$ext[1],$type)) //check image extension not in the array $type
				{
					$field = "/ss12/wp-content/files_mf/" . $field;
				}
				
				
				// Check if value goes into array (if it's a "group")
				if( isset($data[$item->post_type][$a->meta_key]) ){
					if( !is_array($data[$item->post_type][$a->meta_key]) ){
						$data[$item->post_type][$a->meta_key] = array($data[$item->post_type][$a->meta_key], $field);
					} else {
						$data[$item->post_type][$a->meta_key][] = $field;
					}
				} else {
					$data[$item->post_type][$a->meta_key] = $field;
				}
			}
	}
	
	$mtime = microtime(); 
	$mtime = explode(" ",$mtime); 
	$mtime = $mtime[1] + $mtime[0]; 
	$endtime = $mtime; 
	$totaltime = ($endtime - $starttime); 
	if($_GET['dt'] == 1) echo "<!-- DEV ".$totaltime." seconds -->";
	
	return $data;
}

function MF_to_array_page($the_lang, $the_posttype) {
	
	$mtime = microtime(); 
	$mtime = explode(" ",$mtime); 
	$mtime = $mtime[1] + $mtime[0]; 
	$starttime = $mtime; 
	
	global $wpdb;
	$data = array();
	
	$items = $wpdb->get_results('SELECT ID, post_title, post_content, post_type FROM wp_posts WHERE post_title = "'.$the_lang.'" AND post_type = "'.$the_posttype.'" AND post_status = \'publish\'');
	foreach($items as $item){
		// Find the page matching the language
		//if( $item->post_title == $the_lang){
			$data[$item->post_type] = array();
			$data[$item->post_type]['post_content'] = $item->post_content;
			// Loop through MF fields and groups
			$attribs = $wpdb->get_results('SELECT pm.meta_key, pm.meta_value, mf_pm.group_count
										FROM  `wp_mf_post_meta` AS mf_pm, wp_postmeta AS pm
										WHERE mf_pm.post_id = '.$item->ID.'
										AND mf_pm.meta_id = pm.meta_id ORDER BY mf_pm.group_count ASC');
			$vals = array();
			foreach($attribs as $a){	
				//$field = get($a->meta_key, $a->group_count, 1, $item->ID);
				$field = $a->meta_value;
				
				$test = @unserialize($field);
				if ($test !== false) {
				    // Is serialized
					$field = $test[0];
				}
				
				// Check if it's an image
				$type=Array(1 => '.jpg', 2 => '.jpeg', 3 => '.png', 4 => '.gif'); //store all the image extension types in array
				$ext = explode(".",$field); //explode and find value after dot
				if(in_array(".".$ext[1],$type)) //check image extension not in the array $type
				{
					$field = "/ss12/wp-content/files_mf/" . $field;
				}
				
				
				if($field == ""){
					$field = mf_get_default_value($item->post_type, $a->meta_key);
				}
				if( isset($data[$item->post_type][$a->meta_key]) ){
					if( !is_array($data[$item->post_type][$a->meta_key]) ){
						$data[$item->post_type][$a->meta_key] = array($data[$item->post_type][$a->meta_key], $field);
					} else {
						$data[$item->post_type][$a->meta_key][] = $field;
					}
				} else {
					$data[$item->post_type][$a->meta_key] = $field;
				}
			}
		//}
	}
	
	$mtime = microtime(); 
	$mtime = explode(" ",$mtime); 
	$mtime = $mtime[1] + $mtime[0]; 
	$endtime = $mtime; 
	$totaltime = ($endtime - $starttime); 
	if($_GET['dt'] == 1) echo "<!-- DEV ".$totaltime." seconds -->";
	
	return $data;
}

if(isset($_GET['MF'])){
	print_r(MF_to_array());
}

?>