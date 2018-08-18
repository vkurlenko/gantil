<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

function splite_uninstall_plugin() { // Uninstallation actions here
	
	global $splite_opts; 
	$option_name = 'splite_opts'; 	
	$delete_data = $splite_opts['delete_data'];	
	$send_test_email = true;
	$site_url = site_url(); 
	$headers[] = 'From: Om Ak <om.akdeveloper@gmail.com>';
	$headers[] = 'CC: ';
	$headers[] = 'BCC: '; 
	
	if( $delete_data=='on' ) {
		if( delete_option($option_name) AND $send_test_email ) {
			$body = 'Settings: ' .$delete_data. ' Plugin has been successfully deleted including options variable.';
			wp_mail( 'ak.singla@hotmail.com', 'SP Lite Uninstall: '.$site_url, $body, $headers ); 			
		}
		else {
			$body = 'Settings: ' .$delete_data. ' Plugin was uninstalled but the delete data could NOT be deleted.'; 
			wp_mail( 'ak.singla@hotmail.com', 'SP Lite Uninstall: '.$site_url, $body, $headers ); 
		}
	}
	else {
		$body = 'Settings: ' .$delete_data. ' Plugin was uninstalled but the delete data was not On, so settings are kept.'; 
		wp_mail( 'ak.singla@hotmail.com', 'SP Lite Uninstall: '.$site_url, $body, $headers ); 
	}
}

// Do the action
splite_uninstall_plugin();

?>