<?php
/**
 * Template Name: Projekter Undersider Template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<div id="primary" class="site-content">
      
        <div class="sidebar-left">
     
     		<?php wp_nav_menu( array( 'theme_location' => 'projekter-menu')); ?>
      
        </div><!-- venstre sidebar -->
        
		<div id="content" class="two-columnn-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
       
       
     	<div class="sidebar-mobile">
     	<?php wp_nav_menu( array( 'theme_location' => 'projekter-menu', 'menu_class' => 'mobile-sidemenu')); ?>
     	</div><!-- mobil sidebar -->
	
    </div><!-- #primary -->

<?php get_footer(); ?>