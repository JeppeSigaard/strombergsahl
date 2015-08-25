<?php foreach ( $myposts as $post ) : ?>
<div>
    <div class="ps-slider-anchor ps-anchor-<?php echo $post->ID ?>">
        <div class="ps-slider-anchor">
        <a href="<?php echo get_the_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a>
        </div>
  	</div>
    <!--<div class="ps-print-btn print-<?php echo $post->ID ?>" style="opacity: 1;"></div>-->
    	<div class="lcp_contentcontent_<?php echo $post-ID?>">
            <div class="project-slider">
                <div class="ps-images ps-left">
                    <div class="ps-images-wrap">
                    <?php $pics = get_post_meta(get_the_ID(),'project_img',false);$pic_i = 0;?>
                    <?php foreach ($pics as $pic) : 
                    $first_pic = '';
                    $pic_i++; 
                    if ($pic_i == 1) : $first_pic = ' active'; endif;
                    
                    $img = wp_get_attachment_image_src( $pic, 'full');?>
                    
                    <img class="ps-image-<?php echo $pic_i; ?><?php echo $first_pic ?>" src="<?php echo $img[0]; ?>"/>
                    <?php endforeach;?>
        
                    </div>
                    <div class="ps-images-ctrl">
                        <div class="ps-images-btn ps-btn-1 active">1</div>
                        <div class="ps-images-btn ps-btn-2">2</div>
                        <div class="ps-images-btn ps-btn-3">3</div>
                    </div>
                </div>
                <div class="ps-list ps-right">
                    <h3>FAKTA</h3>
                    <ul>
                        
                        <?php $f_1 = get_post_meta($post->ID,'project_f_1',true); if ($f_1) : ?>
                        <li><strong>Bygherre</strong></li>
                        <li><?php echo $f_1 ?></li>
                        <?php endif; ?>
                        
                        <?php $f_2 = get_post_meta($post->ID,'project_f_2',true); if ($f_2) : ?>
                        <li><strong>Arkitekt</strong></li>
                        <li><?php echo $f_2 ?></li>
                        <?php endif;  ?>
                        
                        <?php $f_2_1 = get_post_meta($post->ID,'project_f_2_1',true); if ($f_2_1) : ?>
                        <li><strong>Totalrådgiver</strong></li>
                        <li><?php echo $f_2_1 ?></li>
                        <?php endif;  ?>
                        
                        <?php $f_3 = get_post_meta($post->ID,'project_f_3',true); if ($f_3) : ?>
                        <li><strong>Ingeniør</strong></li>
                        <li><?php echo $f_3; ?></li>
                        <?php endif; ?>
                        
                        <?php $f_4 = get_post_meta($post->ID,'project_f_4',true); if ($f_4) : ?>
                        <li><strong>Byggetid</strong></li>
                        <li><?php echo $f_4; ?></li>
                        <?php endif; ?>
                        
                        <?php $f_5 = get_post_meta($post->ID,'project_f_5',true); if ($f_5) : ?>
                        <li><strong>Entrepriseform</strong></li>
                        <li><?php echo $f_5; ?></li>
                        <?php endif; ?>
                        
                        <?php $f_6 = get_post_meta($post->ID,'project_f_6',true); if ($f_6) : ?>
                        <li><strong>Byggesum</strong></li>
                        <li><?php echo $f_6; ?></li>
                        <?php endif; ?>
                        
                        <?php $f_7 = get_post_meta($post->ID,'project_f_7',true); if ($f_7) : ?>
                        <li><strong>Areal</strong></li>
                        <li><?php echo $f_7; ?></li>
                        <?php endif; ?>
                        
                        <?php $f_8 = get_post_meta($post->ID,'project_f_8',true); if ($f_8) : ?>
                        <li><strong>Beliggenhed</strong></li>
                        <li><?php echo $f_8; ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="ps-desc ps-left">
                <h2 id="n14"><?php echo get_post_meta($post->ID,'project_heading',true); ?></h2>
                <?php echo get_post_meta($post->ID,'project_description',true); ?>
            </div>
        <div class="ps-ref ps-right"><a href="<?php echo wp_get_attachment_url(get_post_meta($post->ID,'project_pdf',true)) ?>" target="_blank">Hent projektbeskrivelse</a></div>
    </div>
    
    
    </div>
</div>
<?php endforeach; ?>