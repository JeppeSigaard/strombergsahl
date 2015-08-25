<?php define('WP_USE_THEMES', false); require('../../../../wp-load.php'); ?>
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