<?php

$ct_form_active = get_post_meta(get_the_ID(),'ct-form-active',true);
if($ct_form_active && $ct_form_active == '1') :

$ct_form_text = get_post_meta(get_the_ID(),'ct-form-text',true);

$ct_form_receiver = get_post_meta(get_the_ID(),'ct-form-receiver',true);
if($ct_form_receiver == ''){
    $footer_options = get_option('footer_options');
    $ct_form_receiver = 'sesa@enss.dk';
}

$ct_form_receiver_2 = get_post_meta(get_the_ID(),'ct-form-receiver-2',true);
if($ct_form_receiver_2 == ''){
    $footer_options = get_option('footer_options');
    $ct_form_receiver_2 = 'sesa@enss.dk';
}

$ct_form_receiver_3 = get_post_meta(get_the_ID(),'ct-form-receiver-3',true);
if($ct_form_receiver_3 == ''){
    $footer_options = get_option('footer_options');
    $ct_form_receiver_3 = 'kmh@enss.dk';
}

?>
<div id="sidebar-form">
    <form method="POST" class="ct-form" id="ct-form-<?php the_ID(); ?>" action="<?php echo get_template_directory_uri() ?>/ajax/form.php">
        <?php wp_nonce_field('smamo_nonce_this','nonce_form'); ?>
        <input type="hidden" name="locale" value="<?php echo get_locale(); ?>"/>
        <input type="hidden" name="post_id" value="<?php the_ID(); ?>"/>
        <input type="hidden" name="email_rec" value="<?php echo $ct_form_receiver ?>"/>
        <input type="hidden" name="email_rec_2" value="<?php echo $ct_form_receiver_2 ?>"/>
        <input type="hidden" name="email_rec_3" value="<?php echo $ct_form_receiver_3 ?>"/>
        <div>
            <strong><?php echo apply_filters('the_content',$ct_form_text); ?></strong>
        </div>
        <div>
            <label for="navn">Mit navn</label>
            <input name="navn" placeholder="Peter Jensen"/>
        </div>

        <div>
            <label for="email">Min e-mail</label>
            <input name="email" placeholder="peter@jensen.dk"/>
        </div>

        <div>
            <label for="telefon">Mit telefonnummer</label>
            <input name="telefon" placeholder="88 88 88 88"/>
        </div>
        
        <div>
            <label for="company">Jeg arbejder hos</label>
            <input name="company" placeholder="Firmanavn a/s"/>
        </div>

        <div class="radio">
            <span>Min funktion:</span>
            <div>
                <input type="radio" value="1" name="function">
                <label>Jeg er bygherre</label>
            </div>
            <div>
                <input type="radio" value="2" name="function">
                <label>Jeg er arkitekt/ingeniør</label>
            </div>
            <div>
                <input type="radio" value="3" name="function">
                <label>Jeg er en dygtig fagentreprenør, som ønsker fast samarbejde</label>
            </div>
        </div>
        <div class="g-recaptcha"  data-sitekey="6LcwvwsTAAAAAH6hQ4ljZJBuEQEakVg892daqxbG "></div>
        <a href="#" title="indsend">Send</a>
    </form>
</div>


<?php endif; ?>