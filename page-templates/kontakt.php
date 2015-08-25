<?php
/**
 * Template Name: Kontakt Template
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
        
		<div class="two-columnn-main-two" id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
            
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php 
						$count = 0;
						$mb_args = array(
							'posts_per_page'   => -1,
							'offset'           => 0,
							'orderby'          => 'menu_order',
							'order'            => 'DESC',
							'post_type'        => 'medarbjeder',
							'post_status'      => 'publish',
							'suppress_filters' => true ); 
						
						$medarb = get_posts( $mb_args );
						foreach ( $medarb as $mb ) : 
						
						// Probably works...?
						$count++; $dir = 'left'; if($count == 2){$dir = 'right'; $count = 0;}
						
						// opret billede
						$image_url = wp_get_attachment_image_src( get_post_meta($mb->ID,'mb_image',true), 'mb_image');
						?>
							
							<div class="bc-container new-bc bc-<?php echo $dir; ?>">
                            	<p class="bc-name"><?php echo get_post_meta($mb->ID,'mb_stilling',true); ?></p>
                           		<p class="bc-name"><?php echo get_post_meta($mb->ID,'mb_navn',true); ?></p>
                            	
								<?php $tlf = get_post_meta($mb->ID,'mb_telefon',true); if($tlf !== '') :?>
                                <p class="bc-position">T: <?php echo $tlf ?></p>
                                <?php endif; ?>
                            	
                                <?php $email = get_post_meta($mb->ID,'mb_email',true); if($email !== '') :?>
                                <p class="bc-position">E: <?php echo $email ?></p>
                            	<?php endif; ?>
                                <p>
                                    <img src="<?php echo $image_url[0]; ?>" alt="<?php echo get_post_meta($mb->ID,'mb_navn',true); ?>" />
                                    
                                    <?php $cv = wp_get_attachment_url(get_post_meta($mb->ID,'mb_cv',true)); if (get_post_meta($mb->ID,'mb_cv',true) !== '') :?>
                                    <a href="<?php echo $cv ?>" target="_blank">Læs CV</a>
                                    <?php endif; ?>
                                </p>
                           </div>
						
						<?php endforeach; ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                </article><!-- #post -->

				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
       
       <div class="sidebar-right">
        
        <?php if ( dynamic_sidebar('page_widget_kontakt') ) : elseif ( dynamic_sidebar('sidebar-1') ) : else  : endif; ?>
        
        </div>
       
     	<div class="sidebar-mobile">
     	</div><!-- mobil sidebar -->
	
    </div><!-- #primary -->

<?php get_footer(); ?>