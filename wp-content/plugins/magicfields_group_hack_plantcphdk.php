<?php
/**
 * @package magicfields_group_hack_plantcphdk
 * @version 1.6
 */
/*
Plugin Name: magicfields_group_hack_plantcphdk
Plugin URI: http://plantcph.dk
Description: Allows you to collapse/expand groups that has multiple items 
Author: Jens Søgaard
Version: 0.1
Author URI: http://plantcph.dk
*/

function magicfields_group_hack_plantcphdk_js() {
	print '<script> 	
			var magicfields_group_hack_plantcphdk_js_expanded = true;
			function collapseGroups(){
				magicfields_group_hack_plantcphdk_js_expanded = false;
				jQuery(".mf_group.mf_duplicate_group .mf-field").css("display","none");
				
				jQuery(".mf_toolbox").click(function() {
					
					//console.log( jQuery(this).parent().find(".mf-field").css("display") );
					
					if( jQuery(this).parent().find(".mf-field").css("display") == "block"){
						jQuery(this).parent().find(".mf-field").css("display","none");
					} else {
						jQuery(this).parent().find(".mf-field").css("display","block");
					}
				});
			}

			function expandGroups(){
				magicfields_group_hack_plantcphdk_js_expanded = true;
				jQuery(".mf_group.mf_duplicate_group .mf-field").css("display","block");
			}
			
		
			

			
			var loadTimeout = setTimeout(function(){ collapseGroups(); }, 3000);
		</script>';
}

add_action( 'admin_head', 'magicfields_group_hack_plantcphdk_js' );

?>
