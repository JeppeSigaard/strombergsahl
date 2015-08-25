<?php
/**
 * Template Name: Projekter Underside Kontor
 */

get_header(); ?>
	<div id="primary" class="site-content">
      
        <div class="sidebar-left">
     
     		<?php wp_nav_menu( array( 'theme_location' => 'projekter-menu')); ?>
      
        </div><!-- venstre sidebar -->
        
		<div id="content" class="two-columnn-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
            
                    <div class="entry-content">
                    <div class="lcp_catlist">
                    
                    	<?php 

						$args = array(
							'posts_per_page'   => -1,
							'offset'           => 0,
							'category'         => '',
							'tax_query' => array(
								array(
												'taxonomy' => 'projektkategori',
												'field' => 'id',
												'terms' => '11'
												)),
												
							'orderby'          => 'post_date',
							'order'            => 'DESC',
							'post_type'        => 'projekt',
							'post_status'      => 'publish',
							'suppress_filters' => true ); 
						
						$myposts = get_posts( $args );?>
						
                        <!-- FOREACH LOOP STARTS HERE -->
						<?php include(locate_template('projekt-liste.php')); ?>
                        <!-- FOREACH LOOP ENDS HERE -->
                    	
                        </div>
                    
                    
                    
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                </article><!-- #post -->
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
       
       
     	<div class="sidebar-mobile">
     	<?php wp_nav_menu( array( 'theme_location' => 'projekter-menu', 'menu_class' => 'mobile-sidemenu')); ?>
     	</div><!-- mobil sidebar -->
	
    </div><!-- #primary -->

<?php get_footer(); ?>