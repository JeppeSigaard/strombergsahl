<?php
/**
 * Template Name: Aktuelt overblik
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
    $original_post_id = $news->ID;
    setup_postdata($news); ?>
    <div id="content" class="two-columnn-main-two news-main" role="main">
    <article>
        <div class="entry-content">
            <h1 class="news-title">
            <a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo get_the_title($news->ID); ?></a>
        </h2>
        <div class="news_date"><?php echo get_the_date('d\. F Y',$news->ID) ?></div>
        <?php echo get_the_post_thumbnail($news->ID,'full'); ?>
        <?php the_content($news->ID); ?>
        </div>
    </article>
   
        </div><!-- #content -->
<?php endforeach; wp_reset_postdata();?>
<?php
$num_posts = 0;
$hidden_post = ' first-three';
$get_articles = get_posts(array(
    
    'posts_per_page'    => 15,
    'offset'            => 0,
    'post_type'         => 'post',
    'exclude'     => $original_post_id,

));

foreach($get_articles as $news) : 
        $num_posts ++;
        if ($num_posts == 4):
            $hidden_post = ' hidden';
        ?>
       <a href="#" id="post-news-show-more">Vis flere nyheder</a><div style="clear:both;"></div>
        <?php endif;?>
        <div class="sidebar-right sidebar-news half-side<?php echo $hidden_post; ?>">
        <div class="page-widget-news">
            <ul>
                <li>
                    <a href="<?php echo get_the_permalink($news->ID) ?>" title="<?php echo get_the_title($news->ID) ?>">
                        <?php echo get_the_title($news->ID) ?>
                    </a>
                    <span class="side-news_date"><?php echo get_the_date('d\. F Y',$news->ID) ?></span>
                    <?php if(has_post_thumbnail($news->ID)): ?>
                    <?php echo get_the_post_thumbnail($news->ID,'news-small'); ?>
                    <p>
                        <?php echo wp_trim_words($news->post_content,$num_words = 20, $more = null); ?>
                    </p>
                    <?php else : ?>
                    <p>
                        <?php echo wp_trim_words($news->post_content,$num_words = 30, $more = null); ?>
                    </p>
                    <?php endif;?>
                </li>
        </ul>
        
        </div>
        </div>
                
<?php endforeach; ?>

<?php get_footer(); ?>