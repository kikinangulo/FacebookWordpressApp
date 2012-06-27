<?
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
function shoes(){
	global $wpdb;
	
	// Get current lang	
	if(isset($_POST['lang'])){
		$lang = $_POST['lang'];
	} else {
		$lang = 'en';
	}
	
	// Get pages
	$pages = array(
		'shoes'
	);
	
	$data = array();
	foreach($pages as $page){
		// Get the page
		$items = $wpdb->get_results('SELECT ID, post_title, post_content FROM wp_posts WHERE post_type = \''.$page.'\' AND post_status = \'publish\'');
		foreach($items as $item){
			if( get('language', 1, 1, $item->ID) == $lang){
				$data[$page] = array();
				// Get multi groups of shoes
				$shoes = get_group('shoe', $item->ID);
				$s_num = 0;
				foreach($shoes as $shoe){
					if($shoe['shoe_default_index'][1] == 'null' || $shoe['shoe_default_index'][1] == '0'){ $shoe['shoe_default_index'][1] = 12; }
					
					$shoe['shoe_shoe_thumbnail'][1] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_shoe_thumbnail'][1]);
					
					$shoe['shoe_product_picture_1'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_1'][1]['original']);
					$shoe['shoe_product_picture_2'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_2'][1]['original']);
					$shoe['shoe_product_picture_3'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_3'][1]['original']);
					$shoe['shoe_product_picture_4'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_4'][1]['original']);
					$shoe['shoe_product_picture_5'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_5'][1]['original']);
					$shoe['shoe_product_picture_6'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_6'][1]['original']);
					$shoe['shoe_product_picture_7'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_7'][1]['original']);
					$shoe['shoe_product_picture_8'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_8'][1]['original']);
					$shoe['shoe_product_picture_9'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_9'][1]['original']);
					$shoe['shoe_product_picture_10'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_10'][1]['original']);
					$shoe['shoe_product_picture_11'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_11'][1]['original']);
					$shoe['shoe_product_picture_12'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_12'][1]['original']);
					$shoe['shoe_product_picture_13'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_13'][1]['original']);
					$shoe['shoe_product_picture_14'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_14'][1]['original']);
					$shoe['shoe_product_picture_15'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_15'][1]['original']);
					$shoe['shoe_product_picture_16'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_16'][1]['original']);
					$shoe['shoe_product_picture_17'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_17'][1]['original']);
					$shoe['shoe_product_picture_18'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_18'][1]['original']);
					$shoe['shoe_product_picture_19'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_19'][1]['original']);
					$shoe['shoe_product_picture_20'][1]['original'] = str_replace("http://ecco.plantcph.dk", "", $shoe['shoe_product_picture_20'][1]['original']);
					
					
					$data[$page][$s_num] = array();
					$data[$page][$s_num]['shoe_product_name'] = $shoe['shoe_product_name'][1];
					$data[$page][$s_num]['shoe_default_index'] = $shoe['shoe_default_index'][1];
					$data[$page][$s_num]['shoe_product_link'] = $shoe['shoe_product_link'][1];
					$data[$page][$s_num]['shoe_shoe_thumbnail'] = $shoe['shoe_shoe_thumbnail'][1];
					$data[$page][$s_num]['pictures'] = array(
							$shoe['shoe_product_picture_1'][1]['original'],
							$shoe['shoe_product_picture_2'][1]['original'],
							$shoe['shoe_product_picture_3'][1]['original'],
							$shoe['shoe_product_picture_4'][1]['original'],
							$shoe['shoe_product_picture_5'][1]['original'],
							$shoe['shoe_product_picture_6'][1]['original'],
							$shoe['shoe_product_picture_7'][1]['original'],
							$shoe['shoe_product_picture_8'][1]['original'],
							$shoe['shoe_product_picture_9'][1]['original'],
							$shoe['shoe_product_picture_10'][1]['original'],
							$shoe['shoe_product_picture_11'][1]['original'],
							$shoe['shoe_product_picture_12'][1]['original'],
							$shoe['shoe_product_picture_13'][1]['original'],
							$shoe['shoe_product_picture_14'][1]['original'],
							$shoe['shoe_product_picture_15'][1]['original'],
							$shoe['shoe_product_picture_16'][1]['original'],
							$shoe['shoe_product_picture_17'][1]['original'],
							$shoe['shoe_product_picture_18'][1]['original'],
							$shoe['shoe_product_picture_19'][1]['original'],
							$shoe['shoe_product_picture_20'][1]['original']
						);	
						
					$data[$page][$s_num]['product_button'] = get("product_button",1,1,$item->ID);
					//$data[$page][$s_num]['default_index'] = get(" v",1,1,$item->ID);
						
					$s_num++;
				}
			}
		}
	}
	
	if($_GET['id'] != ""){
		$shoe = array();
		$shoe = $data['shoes'][$_GET['id']];
		$data = array();
		$data['shoes'][0] = $shoe;
		print json_encode($data['shoes']);	
	} else {
		print json_encode($data['shoes']);	
	}
}
shoes();
?>