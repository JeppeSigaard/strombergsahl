<?php
/**
 * Template Name: Smamo test Forside Template
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

	<div id="primary" class="site-content home-page">
		<div id="content" role="main">
            <section id="introduktion">
            <?php $test=get_posts('category_name=breaking'); if ($test) : query_posts('cat=18&posts_per_page=1'); if(have_posts()) : while(have_posts()) : the_post();?>
            <div class="breaking-right">
            	<div class="breaking-right-inner">
            	<?php $img = get_post_meta($post->ID, 'Featured Thumbnail', true);?><img src="<?php echo $img; ?>"/>
                </div>
            </div>
            <div class="breaking-left">
            	<div class="breaking-post" id="post-<?php the_ID(); ?>">
            		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            		<div class="breaking-entry">
					<?php the_excerpt();?>
            		</div>
                    <div class="breaking-rm-center">
                    <a href="<?php the_permalink(); ?>" class="breaking-read-more">Læs mere</a>
                    </div>
            	</div>
            </div>
			<?php endwhile; endif; else :?>
            <div class="front-swipe">
            	<?php if ( dynamic_sidebar('swipe_widget_img') ) : else : endif; ?>
                <div class="front-swipe-text">
                    <?php if ( dynamic_sidebar('swipe_widget_text') ) : else : endif; ?>

                    <?php $options = get_option( 'bygge_rating_settings' ); ?>
                    <div id="byggerating">
                        <span id="byggetitle">Bygge Rating</span>
                        <div class="rating" id="rating-0">
                            <div class="rating-mark mark-<?php echo $options['bygge_rating_text_field_0'] ?>"><?php echo strtoupper($options['bygge_rating_text_field_0']); ?></div>
                            <div class="rating-txt">Tidsfrister</div>
                        </div>
                        <div class="rating" id="rating-1">
                            <div class="rating-mark mark-<?php echo $options['bygge_rating_text_field_1'] ?>"><?php echo strtoupper($options['bygge_rating_text_field_1']); ?></div>
                            <div class="rating-txt">Mangler</div>
                        </div>
                        <div class="rating" id="rating-2">
                            <div class="rating-mark mark-<?php echo $options['bygge_rating_text_field_2'] ?>"><?php echo strtoupper($options['bygge_rating_text_field_2']); ?></div>
                            <div class="rating-txt">Arbejdsulykker</div>
                        </div>
                        <div class="rating" id="rating-3">
                            <div class="rating-mark mark-<?php echo $options['bygge_rating_text_field_3'] ?>"><?php echo strtoupper($options['bygge_rating_text_field_3']); ?></div>
                            <div class="rating-txt">Kundetilfredshed</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            </section>
            
            <hr class="pyntestreg"/>
            <section id="referencer">
            <div class="front-vi-bygger">
            <h2>Vi bygger for</h2>
            <a href="http://www.kk.dk/" target="blank" style="background-image:url(http://enss.dk/wp-content/uploads/2013/10/kobenhavnkommune.png);"></a>
            <a href="http://www.tivoli.dk/" target="blank" style="background-image:url(http://enss.dk/wp-content/uploads/2013/10/tivoli.png);"></a>
            <a href="http://www.foodtravelexperts.com/denmark/" target="blank" style="background-image:url(http://enss.dk/wp-content/uploads/2013/10/SSP.png);"></a>
            <a href="http://www.atp.dk/" target="blank" style="background-image:url(http://enss.dk/wp-content/uploads/2013/10/atp.png);"></a>
            <a href="http://www.ku.dk/" target="blank" style="background-image:url(http://enss.dk/wp-content/uploads/2013/10/kobenhavnsuniversitet.png);"></a>
            </div>
            </section>
            <hr class="pyntestreg"/>
            <section id="kompetencer">
            <div class="front-kompetencer-container">
            <div id="front-kompetencer-slider">
            <span id="kompetencer-count">1</span>
            <div class="kompetencer-arr komp-larr"></div>
            <div class="kompetencer-arr komp-rarr"></div>
            <ul>
                <li id="komp-slide-1" class="active">Nybyggeri</li>
                <li id="komp-slide-2">Om- & tilbygning</li>
                <li id="komp-slide-3">Renovering</li>
            </ul>
            </div>
                <div class="front-kompetencer front-kompetencer-1 active"><?php if ( dynamic_sidebar('home_widget_1') ) : else : endif; ?></div>
                <div class="front-kompetencer front-kompetencer-2"><?php if ( dynamic_sidebar('home_widget_2') ) : else : endif; ?></div>
                <div class="front-kompetencer front-kompetencer-3"><?php if ( dynamic_sidebar('home_widget_3') ) : else : endif; ?></div>
            </div>
            </section>
            <hr class="pyntestreg"/>
            <section id="nyheder">
            <div class="front-nyheder">
                <div class="front-nyheder-left">
                    <?php 
                        $front_news = get_posts(array(
                            
                            'posts_per_page' => 4,
                            'offset'        => 0,
                            'post_type'     => 'post',
                            'orderby'       => 'post_date',
                            'order'         => 'DESC',
                        ));
                        
                        $post_num = 0;
                        foreach($front_news as $post){
                            $post_num ++;
                            setup_postdata($post);
                        
                        if ($post_num == 1): ?>
                            
                    <div>
                        <ul>
                            <li>
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>  
                                <p><?php echo wp_trim_words(get_the_excerpt(),$num_words = 30, $more = null); ?></p>
                                <a class="news-more" href="<?php echo get_the_permalink(); ?>">Læs mere</a>
                            </li>
                            
                            <?php elseif ($post_num == 2) : ?>
                            
                            <li>
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>  
                                <p><?php echo wp_trim_words(get_the_excerpt(),$num_words = 30, $more = null); ?></p>
                                <a class="news-more" href="<?php echo get_the_permalink(); ?>">Læs mere</a>
                            </li>
                        </ul>
                    
                    </div> 
                            
                        <?php elseif ($post_num == 3) : ?>
                    <div>
                        <ul>
                            <li>
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>  
                                <p><?php echo wp_trim_words(get_the_excerpt(),$num_words = 30, $more = null); ?></p>
                                <a class="news-more" href="<?php echo get_the_permalink(); ?>">Læs mere</a>
                            </li>
                        
                    
                        <?php elseif ($post_num == 4) : ?>
                        
                            <li>
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>  
                                <p><?php echo wp_trim_words(get_the_excerpt(),$num_words = 30, $more = null); ?></p>
                                <a class="news-more" href="<?php echo get_the_permalink(); ?>">Læs mere</a>
                            </li>
                        </ul>
                    </div>
                    
                    
                        <?php else : endif;
                        
                        
                        }
                        wp_reset_postdata();     
                    ?>              
                </div>
                <div class="front-nyheder-kontakt">
                <?php if ( dynamic_sidebar('home_widget_kontakt') ) : else : endif; ?>
                </div>
            </div>
            </section>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>