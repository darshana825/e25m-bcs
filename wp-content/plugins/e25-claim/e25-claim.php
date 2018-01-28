<?php
/**
 * @package e25-claim
 */
/*
  Plugin Name: E25 Claim
  Description: this is a custom plugin by eight25media.
  Version: 1.0.0
  Author: D.K. Himas Khan
  Author URI:
  Text Domain: E25 Claim
 */


if (!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php");
}

define('App_plugin__DIR', plugin_dir_path(__FILE__));

//wp_enqueue_style( 'tfkapp-admin-style', plugins_url('css/tfk-admin-css.css',__FILE__));

add_action('admin_menu', 'register_my_custom_menu_page');

function register_my_custom_menu_page() {
    add_menu_page('Claim', 'Claim Details', 'manage_options_claim', 'claim-plugin', 'app_init', 'dashicons-list-view');
   // add_submenu_page('claim-plugin', 'My Custom Page 1', 'Claim Details', 'manage_options', 'e25-claim/tfkappuser.php');

}

function app_init() {

    require_once(ABSPATH . "wp-load.php");
    global $wpdb;
    $urlpath = plugins_url() . '/tfkapp/tfkappajax/uploads/acheckerpdf/';
    ?>

    <table style="width:100%;">
        <tr>
            <th></th>
            <th style="text-align:left;  height: 45px;">UserName</th>
            <th style="text-align:left">User Email</th> 
            <th style="text-align:left">Date</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Type</th>
            <th>Project Details</th>
            <th>Other Employee's</th>
            <th>Bill Attachment's</th>
            <th>Status</th>
        </tr>


        <?php
        /* user status : "1" waiting for PM approval, "2" waiting for HOD approval, "3" waiting for Accountant approval */
        $cUserStsId = "";
        if( current_user_can('administrator')){
            $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE status!=0" );
            $cUserStsId = 1;
        } else if( current_user_can('editor')) {
            $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE status=2" );
            $cUserStsId = 3;
        } else if( current_user_can('author')) {
            $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE status=1" );
            $cUserStsId = 2;
        }else if( current_user_can('contributor')) {
            $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE status IN (3,4)" );
            $cUserStsId = 4;
        }
        
        $i = 1;
        
        foreach ($claims as $claim) {

            $getUser = $wpdb->get_row("SELECT * FROM wp_users WHERE ID =" . $claim->uid);
            
            $customPostTitle = get_page_by_title($claim->project, OBJECT, 'projects');
          //  echo $customPostTitle->ID
            
            $getAttachments = $wpdb->get_results("SELECT * FROM add_claim_attachments WHERE status=1 AND cid =" . $claim->id);
            ?>

            <tr>
                <td><?php echo $i; ?>.)</td>
                <td style="text-align:left; height:40px;"><?php echo $getUser->user_login; ?></td>
                <td style="text-align:left"><?php echo $getUser->user_email; ?></td> 
                <td style="text-align:left"><?php echo $claim->date; ?></td>
                <td style="text-align:left"><?php echo "LKR ".$claim->amount; ?></td>
                <td style="text-align:left"><?php echo $claim->description; ?></td>
                <td style="text-align:left"><?php echo $claim->type; ?></td>
                <td style="text-align:left"><?php echo $claim->project." (";  echo get_the_category( $customPostTitle->ID )[0]->name.")"; ?></td>
                <td style="text-align:left"><?php echo $claim->others ?></td>
                <td style="text-align:left">
                    <ul>
                        <?php
                        $v=1;
                          foreach ($getAttachments as $getAttachment){
                        ?>
                        <li><a href="<?php echo $getAttachment->file; ?>" target="_blank">Attachment <?php echo $v; ?></a></li>
                          <?php $v++; } ?>
                    </ul>
                </td>
                <td style="text-align:left"><a onclick="return confirm_approval('<?php echo $claim->id; ?>')" class="appBtn">Approved</a> <a onclick="return confirm_cancel('<?php echo $claim->id; ?>')" class="canBtn">Cancel</a></td>
            </tr>

            <?php $i++;
        }
        ?>

    </table>
<script>
    
// approve cliam
function confirm_approval(cid){
    var conf = confirm('are you sure?');
    if(conf){
        id = cid;
        jQuery.ajax({
            url:"<?php echo get_site_url(); ?>/wp-content/plugins/e25-claim/ajax/sendconfirmation.php",
            type:'post',  
            dataType: 'text',            

            data: {id:id,typ:'approval',cUserStsId:'<?php echo $cUserStsId; ?>'},
            success:function(results)
            {  
               // alert(results);
                if(results==4){
                    alert('Email Sent Successfully');
                }
                location.reload(); 
            }
        });  
    } 
}
    
    
// cancel claim
function confirm_cancel(cid){
    var conf = confirm('are you sure?');
    if(conf){
        id = cid;
        jQuery.ajax({
            url:"<?php echo get_site_url(); ?>/wp-content/plugins/e25-claim/ajax/sendconfirmation.php",
            type:'post',  
            dataType: 'text',            

            data: {id:id,typ:'cancel'},
            success:function(results)
            {  
                //alert(results);
                alert('Email Sent Successfully');
                location.reload(); 
            }
        });  
    } 
}
</script>

    <?php
}
