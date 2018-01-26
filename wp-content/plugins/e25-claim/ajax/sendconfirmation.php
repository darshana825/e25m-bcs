<?php
require_once( '../../../../wp-load.php' );
global $wpdb;

$typ = $_POST['typ'];
$id = $_POST['id'];

if($typ=="cancel"){
    
    $wpdb->update( 
	'add_claim', 
	array( 
		'status' => 0	// integer (number) 
	), 
	array( 'id' => $id ), 
	array( 
		'%d'	// value2
	), 
	array( '%d' ) 
    );
    
    $wpdb->update( 
	'add_claim_attachments', 
	array( 
		'status' => 0	// integer (number) 
	), 
	array( 'cid' => $id ), 
	array( 
		'%d'	// value2
	), 
	array( '%d' ) 
    );
    
    $currentUDeatils = $wpdb->get_row("SELECT * FROM wp_users WHERE ID =" . $id);
    if($currentUDeatils->user_email){
        userNotifyEmail('cancel' , $currentUDeatils->user_email);
    }   
}
     


/* user notification email*/
function userNotifyEmail($ref , $email){

    $message ="";	
    $subject ="";

    if($ref=="cancel"){
        $subject = "Claim Status";
        $message = "Sorry!, Your Claim is cancelled, Please refer your dashboard";
    }



    wp_mail($email, $subject, $message);


}

