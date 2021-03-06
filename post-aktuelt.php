<?php
/**
 * Template Name Posts: Nyheder
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
      <div id="content" class="two-columnn-main-two news-post" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	
    <div class="sidebar-right sidebar-news">
        
        <?php if ( dynamic_sidebar('post_widget_news') ) : elseif ( dynamic_sidebar('page_widget_news') ) : elseif ( dynamic_sidebar('sidebar-1') ) : else  : endif; ?>
        
        </div>
    
    </div><!-- #primary -->

<?php get_footer(); ?>