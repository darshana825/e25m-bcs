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
                    
                    <h1>Dashboard</h1>
                    <div class="mainWrapper">
                        <div class="linkWrapper">
                            Your Login as a <?php echo esc_html( $current_user->user_firstname ); ?> , <a href="<?php echo site_url('dashboard');?>">Dashboard</a>, <a href="<?php echo site_url('your-profile');?>">My Profile</a> , <a href="<?php echo site_url('add-claim'); ?>">Apply Claim</a>, <a href="<?php echo site_url('logout');?>">Logout</a>
                        </div>
                        <div class="bodyWrapper">
                            <div>
                                <h2>Pending Claim</h2>
                                <ul>
                                    <li></li>
                                </ul>
                            </div>
                            <div>
                                <h2>Approved Claim</h2>
                                <ul>
                                    <li></li>
                                </ul>
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
