<?php
/**
 * Template Name: Nyhedsbrev
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
    <div id="content" class="two-columnn-main-two news-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
   </div><!-- #content -->
<?php
$num_posts = 0;
$hidden_post = '';
$get_articles = get_posts(array(
    
    'posts_per_page'    => 3,
    'offset'            => 0,
    'post_type'         => 'post',
));

foreach($get_articles as $news) : 
        $num_posts ++;?>
        <div class="sidebar-right sidebar-news half-side<?php echo $hidden_post; ?>">
        <div class="page-widget-news">
            <ul>
                <li>
                    <a href="<?php echo get_the_permalink($news->ID) ?>" title="<?php echo get_the_title($news->ID) ?>">
                        <?php echo get_the_title($news->ID) ?>
                    </a>
                    <span class="side-news_date"><?php echo get_the_date('d\. F Y',$news->ID) ?></span>
                    <?php if(has_post_thumbnail($news->ID)): ?>
                    <?php echo get_the_post_thumbnail($news->ID,'news-size'); ?>
                    <p>
                        <?php echo wp_trim_words($news->post_content,$num_words = 20, $more = null); ?>
                    </p>
                    <?php else : ?>
                    <p>
                        <?php echo wp_trim_words($news->post_content,$num_words = 45, $more = null); ?>
                    </p>
                    <?php endif;?>
                </li>
        </ul>
        
        </div>
        </div>
                
<?php endforeach; ?>

<?php get_footer(); ?>