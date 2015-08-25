<?php
/**
 * Template Name: Aktuelt
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
<?php 
     
global $post;
$get_articles = get_posts(array(
    
    'posts_per_page'    => 1,
    'offset'            => 0,
    'post_type'         => 'post',

));

    foreach($get_articles as $news):
        
        setup_postdata($news); ?>
    <div id="content" class="two-columnn-main-two news-main" role="main">
    <article>
    <header class="entry-header">
        <h2 class="news-title">
        <a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_title($news->ID); ?></a>
    </h2>
    <div class="news_date"><?php echo get_the_date('d\. F Y',$news->ID) ?></div>
    <?php the_post_thumbnail($news->ID); ?>
    </header>
    <?php the_content($news->ID); ?>
    </article>
   
        </div><!-- #content -->
     <?php endforeach; wp_reset_postdata();?>
    <div class="sidebar-right sidebar-news half-side">
        
        <?php if ( dynamic_sidebar('page_widget_news') ) : elseif ( dynamic_sidebar('sidebar-1') ) : else  : endif; ?>
        
        </div> 
    </div><!-- #primary -->

<?php get_footer(); ?>