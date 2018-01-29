<?php
/**
 * Template Name : Dashboard
 
 */

if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
}else{
    auth_redirect();
}

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
                        
//				get_template_part( 'template-parts/page/content', 'page' );
//
//				// If comments are open or we have at least one comment, load up the comment template.
//				if ( comments_open() || get_comments_number() ) :
//					comments_template();
//				endif;
?>
                    
                    
                    <div class="mainWrapper">
                        <div class="linkWrapper">
                            Your Login as a <b><?php echo esc_html( $current_user->user_firstname ); ?></b> , <a class="currentPage" href="<?php echo site_url('dashboard');?>">Dashboard</a>, <a href="<?php echo site_url('your-profile');?>">My Profile</a> , <a href="<?php echo site_url('add-claim'); ?>">Apply Claim</a>, <a href="<?php echo site_url('logout');?>">Logout</a>
                        </div>
                        <h1>Dashboard</h1>
                        <div class="bodyWrapper">
                            <div>
                                <h2>Pending Claim</h2>
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
                                  //  echo "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status NOT IN (0,4)";
                                    $i=1;
                                     $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status NOT IN (0,4)" );
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
                                        <td style="text-align:left">
					<div class="viewSts">
                                            <a class="statusBtn" data-target="#Modal_<?php echo $i; ?>" data-toggle="modal">View</a>
                                            <?php
                                            $pmSts = "";
                                            $hodSts = "";
                                            $accSts = "";
                                            if($claim->status==1){
                                                $pmSts = "Pending"; $hodSts="Pending"; $accSts="Pending";
                                            }else if($claim->status==2){
                                                $pmSts = "Approved"; $hodSts="Pending"; $accSts="Pending";
                                            }else if($claim->status==3){
                                                $pmSts = "Approved"; $hodSts="Approved"; $accSts="Pending";
                                            }else if($claim->status==4){
                                                $pmSts = "Approved"; $hodSts="Approved"; $accSts="Approved";
                                            }
                                            ?>
                                            <div class="statusView modal fade" id="Modal_<?php echo $i; ?>">
                                                <div>Project Manager - <?php echo $pmSts; ?></div>
                                                <div>Head of Delivery - <?php echo $hodSts; ?></div>
                                                <div>Accountant - <?php echo $accSts; ?></div>
                                            </div>
					</div>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                    }
                                    ?>
                                </table>
                            </div>
                            <div>
                                <h2>Approved Claim</h2>
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
                                  //  echo "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status NOT IN (0,4)";
                                    $i=1;
                                     $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status=4" );
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
                                    </tr>
                                    <td style="text-align:left"><a>Approved</a></td>
                                    <?php $i++;
                                    }
                                    ?>
                                </table>
                            </div>
                            <div>
                                <h2>Canceled Claim</h2>
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
                                  //  echo "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status NOT IN (0,4)";
                                    $i=1;
                                     $claims = $wpdb->get_results( "SELECT * FROM add_claim WHERE uid='".$current_user->ID."' AND status=0" );
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
                                        <td style="text-align:left"><a>Cancelled</a></td>
                                    </tr>
                                    <?php $i++;
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
