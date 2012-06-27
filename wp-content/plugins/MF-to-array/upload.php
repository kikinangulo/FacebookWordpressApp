<?
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
function page(){
	global $wpdb;
	
	// Get current lang	
	if(isset($_POST['lang'])){
		$lang = $_POST['lang'];
	} else {
		$lang = 'en';
	}
	
	// Get pages
	$pages = array(
		'upload'
	);
	
	$data = array();
	foreach($pages as $page){
		// Get the page
		$items = $wpdb->get_results('SELECT ID, post_title, post_content FROM wp_posts WHERE post_type = \''.$page.'\' AND post_status = \'publish\'');
		foreach($items as $item){
			if( get('language', 1, 1, $item->ID) == $lang){
				$data[$page] = array();
				$data[$page]['post_content'] = $item->post_content;
				// Loop through MF fields and groups
				$attribs = $wpdb->get_results('SELECT pm.meta_key, pm.meta_value
											FROM  `wp_mf_post_meta` AS mf_pm, wp_postmeta AS pm
											WHERE mf_pm.post_id = '.$item->ID.'
											AND mf_pm.meta_id = pm.meta_id');
				$vals = array();
				foreach($attribs as $a){
					$field = get($a->meta_key,1,1,$item->ID);
					if(strpos($a->meta_key,'step_3') !== false ){
						$a->meta_key = str_replace("step_3","step3",$a->meta_key);
					}
					$data[$page][$a->meta_key] = $field;
				}
			}
		}
	}
	

	print json_encode($data['upload']);	
}
page();
?>