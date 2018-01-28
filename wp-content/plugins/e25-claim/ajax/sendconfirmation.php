<?php
require_once( '../../../../wp-load.php' );
global $wpdb;

$typ = $_POST['typ'];
$id = $_POST['id'];
$cUserStsId = $_POST['cUserStsId'];

if($typ=="approval"){
    $wpdb->update( 
	'add_claim', 
	array( 
		'status' => $cUserStsId	// integer (number) 
	), 
	array( 'id' => $id ), 
	array( 
		'%d'	// value2
	), 
	array( '%d' ) 
    );
    
    if($cUserStsId==4){ //if accountant approved email will send to user
        $claims = $wpdb->get_row( "SELECT * FROM add_claim WHERE id=" . $id );
        $currentUDeatils = $wpdb->get_row("SELECT * FROM wp_users WHERE ID =" . $claims->uid);
        if($currentUDeatils->user_email){
            userNotifyEmail('approval' , $currentUDeatils->user_email);
        }
        echo $cUserStsId;
    }
    
}

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
    
    
    $claims = $wpdb->get_row( "SELECT * FROM add_claim WHERE id=" . $id );
    $currentUDeatils = $wpdb->get_row("SELECT * FROM wp_users WHERE ID =" . $claims->uid);
    if($currentUDeatils->user_email){
        userNotifyEmail('cancel' , $currentUDeatils->user_email);
    }   
}


/* user notification email*/
function userNotifyEmail($ref , $email){

    $message ="";	
    $subject ="";

    if($ref=="cancel"){
        $subject = "Claim Cancelled";
        $message = "Sorry!, Your Claim is cancelled, Please refer your dashboard to more details";
    }
    
    if($ref=="approval"){
        $subject = "Claim Approved";
        $message = "Your Claim is approved, Please refer your dashboard to more details";
    }
    

    wp_mail($email, $subject, $message);

}

