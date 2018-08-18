<?php 

// Contact Form 7 Importer
// Expected to be a full-fledged class
// More features intended
// Since version: 1.4

//add_action('redux/field/splite_opts/select/fieldset/after/import-popup-demos', 'add_click_to_import' );
//add_action('redux/field/splite_opts/render/before', 'add_click_to_import' );
add_action('redux/field/splite_opts/select/fieldset/before/splite_opts', 'add_click_to_import' );
function add_click_to_import($data) {
	if( $data['id'] != 'import-popup-demos' ) return; 
	//print_r($data);			
	//global $splite_opts;  print_r($splite_opts);	
	//$lastimported = isset($splite_opts['last_import']) ? $splite_opts['last_import'] : ''; 	
	$lastimported = '';
	$savedb = get_option('splite_last_import');
	if( isset($savedb) ) {
		$lastimported = 'Last Import: ' .date('H:i:s - d-m-Y', $savedb);		
	}
		
	 
	echo '<a href="#" class="button-primary" id="import-demo-link">Import</a>&nbsp;<span id="last-import">'.$lastimported.'</span>&nbsp;<span id="import-result"></span>';	
}

add_action('redux/page/splite_opts/header', 'add_script_to_header' );
function add_script_to_header() {
	echo "<style></style>";
	
	echo "<script>
	jQuery(document).ready(function() { // wait for page to finish loading 
		jQuery('#import-demo-link').click( function(e) {
			e.preventDefault();
			importDemos = jQuery('#import-popup-demos-select');
			spanResult = jQuery('#import-result');
			lastImport = jQuery('#last-import');
			reduxSave = jQuery('#redux_save');
			sectionConfig = jQuery('#1_section_group_li_a');
			spanResult.text('');
			lastImport.text('');
			jQuery(this).addClass('disable');
			
			jQuery.post(
				ajaxurl,
				{
					action : 'action_importDemo',
					options : importDemos.val(),
					choice : '0',
				},
				function( response ) {				
					if( response.success === true ) {
						spanResult.addClass('success').text('Imported');
						importDemos.val(2);
						setTimeout(function() {sectionConfig.click();}, 250);						
						setTimeout(function() {location.reload();}, 1000);					
					}
					else {
						spanResult.addClass('error').text(response.data);
					}			
					
				}  
			);
		});
	});
	</script>";
}

add_action( 'wp_ajax_action_importDemo', 'action_importDemo' );
function action_importDemo() {
	//print_r( $_POST['fields'] ); 
	
	// If Nothing is posted through AJAX
	if( !isset($_POST) OR !isset($_POST['options']) ) 
		wp_send_json_error( 'Try again. Nothing Sent to server.' ); 
	
	if( $_POST['options'] == '0' )
		wp_send_json_error( 'Not Imported.' ); 
	
	if( $_POST['options'] == '2' )
		wp_send_json_error( 'Not Imported.' ); 
	
	for( $i=1; $i<3; $i++) {
		$formId = splite_import_cf7_demo('Demo Form '.$i, $i);
	}
	
	if($formId) { wp_send_json_success( 'ok' );  }
	
}

function splite_import_cf7_demo($title, $id='') {	
	
	if( empty($id) ) return false; 
	
	while( get_page_by_title($title, 'OBJECT', 'wpcf7_contact_form') ) {
		$title .= '-'.$id; 
	}
	
	$contact_form = WPCF7_ContactForm::get_template( array(
		'title' => $title,
	));	
	$form = $contact_form->prop( 'form' );
	$mail = $contact_form->prop( 'mail' );
	$messages = $contact_form->prop( 'messages' );
	
	$messages['invalid_required'] = 'X'; 
	$messages['invalid_email'] = 'X'; 	
	$messages['invalid_number'] = 'X'; 	
	
	switch($id) {
		case 1: 
			$form = '<div class="col-md-6" style="overflow:hidden;">
	<p style="float:left;width:50%;padding-right:5px;">[text* first-name placeholder "First Name"]</p>
	<p style="float:left;width:50%;padding-left:5px;">[text* last-name placeholder "Last Name"]</p>
	<p style="float:left;width:50%;padding-right:5px;">[email* your-email placeholder "Email"]</p>
	<p style="float:left;width:50%;padding-left:5px;">[tel* your-phone placeholder "Phone"]</p>
	<p style="clear:both;display:block;">[textarea your-message placeholder "Message"]</p>
	<p>[submit "SUBMIT"]</p>
</div>';
			$mail['body'] = "Hello admin, 

A customer has contacted us. Here are the details and content of the request. 

<strong>First Name:</strong> [first-name]
<strong>Last Name:</strong> [last-name]
<strong>Email:</strong> [your-email]
<strong>Phone:</strong> [your-phone]

<strong>Message Body:</strong>
[your-message]


The admin is advised to go through the customer's request and revert him back soon.

</div>";
			break;
		
		case 2: 
			$form = '<div class="" style="overflow:hidden;">
	<h2 style="text-align:center;line-height:1.5em;margin-bottom:20px;">Happy to <strong>Help</h2>
	<p style="float:left;width:50%;padding-right:5px;">
		[text* your-name placeholder "Name"]
		[email* your-email placeholder "Email"]
	</p>
	<p style="float:left;width:50%;padding-left:5px;">[textarea your-message placeholder "Message"]</p>
	<p>[submit "SUBMIT"]</p>
</div>';
			$mail['body'] = "Hello admin, 

A customer has contacted us. Here are the details and content of the request. 

<strong>Full Name:</strong> [full-name]
<strong>Email:</strong> [your-email]

<strong>Message Body:</strong>
[your-message]


The admin is advised to go through the customer's request and revert him back soon.

</div>";
			break; 
		
		default: 
	}
	
	$contact_form->set_properties( array( 'mail' => $mail, 'form' => $form, 'messages' => $messages ) );
	
	$formId = $contact_form->save();	
	
	//global $splite_opts; $sp_opts['last_import'] = time(); 	
	update_option('splite_last_import', time());
	return $formId; 
}

?>