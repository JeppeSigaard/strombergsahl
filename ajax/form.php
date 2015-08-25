<?php 

// vi skal ikke bruger header, men WP's funktionsbibliotek
define('WP_USE_THEMES', false); 

// Vores retur encodes til json, så det er nemt at bruge i javascript.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-Type: application/json');

// Hent wp-load, så vi får mulighed for at bruge wordpress' funktionsarkiv
require '../../../../wp-load.php';

// Klargør response array til senere json_encode();
$response = array();

// Nonce check
$retrieved_nonce = $_REQUEST['nonce_form'];
// $response['nonce_verify'] = wp_verify_nonce($retrieved_nonce, 'smamo_nonce_this' );
// $response['nonce'] = wp_strip_all_tags($_REQUEST['nonce_form']);
if(!wp_verify_nonce($retrieved_nonce, 'smamo_nonce_this' )){
    $response['error'] = 'Nonce check error.';
    echo json_encode($response);
    exit;
}


// Indstil formdata
$formdata = array(
    
    'locale' => (isset($_POST['locale'])) ? wp_strip_all_tags($_POST['locale']) : false,
    
    'post' => (isset($_POST['post_id'])) ? get_post(wp_strip_all_tags($_POST['post_id'])) : false,
    
    'email_rec' => (isset($_POST['email_rec']) && is_email($_POST['email_rec']) ) ? wp_strip_all_tags($_POST['email_rec']) : false,

    'navn' => (isset($_POST['navn'])) ? wp_strip_all_tags($_POST['navn']) : false,
    
    'email' => (isset($_POST['email']) && is_email($_POST['email']) ) ? wp_strip_all_tags($_POST['email']) : false,
    
    'telefon' => (isset($_POST['telefon'])) ? wp_strip_all_tags($_POST['telefon']) : false,
    
    'kommentar' => (isset($_POST['kommentar'])) ? esc_textarea($_POST['kommentar']) : false,
    
    'function' => '',
);

$function = (isset($_POST['function'])) ? wp_strip_all_tags($_POST['function']) : false;
if(!$function){
    
    $response['error'] = 'Vælg venligst en funktion';
    echo json_encode($response);
    exit;
    
}

$rendered_function = 'Ikke indstillet';
if($function === '1'){$rendered_function = 'bygherre';}
if($function === '2'){$rendered_function = 'arkitekt/ingeniør';}
if($function === '3'){$rendered_function = 'en dygtig fagentreprenør, som ønsker fast samarbejde';}

$formdata['function'] = $rendered_function;

// Indstil fejlmeddelelser
$error_msgs = array(
    
    'locale'   => 'locale not set',
    
    'captcha' => array(
        'da_DK' => 'Bekræft venligst at du ikke er en robot',
        'en_US' => 'Please confrm that you are human',
    ),
    
    'post' => array(
        'da_DK' => 'Der opstod en fejl under indlæsning af formularens data. Prøv venligst igen',
        'en_US' => 'An unexpected error occured, please try again'
    ),
    
    'email_rec' => array(
        'da_DK' => 'Modtageradresse er ikke indstillet korrekt',
        'en_US' => 'Receiver address not received'
    ),
    
    'navn' => array(
        'da_DK' => 'Indtast venligst dit navn',
        'en_US' => 'Please enter your name'
    ),
    
    'email' => array(
        'da_DK' => 'Indtast venligst en gyldig emailadresse',
        'en_US' => 'Please enter a valid email email address'
    ),
    
    'telefon' => array(
        'da_DK' => 'Indtast et telefonnummer',
        'en_US' => 'Please enter a phone number'
    ),
);

// Afbryd ved manglende data
if(!$formdata['locale']){

    $response['error'] = $error_msgs['locale'];
    echo json_encode($response);
    exit;

}


// reCaptcha
$siteKey = '6LcwvwsTAAAAAH6hQ4ljZJBuEQEakVg892daqxbG';
$secret = '6LcwvwsTAAAAADR6l5u0RujLVDr8x7ay_uF10V9c';

require_once __DIR__ . '/../grc/autoload.php';
$recaptcha = new \ReCaptcha\ReCaptcha($secret);
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
if (!$resp->isSuccess()){
    
    $response['error'] = $error_msgs['captcha'][$locale];
    echo json_encode($response);
    exit;
    
}


// Tjek for manglende felter
foreach($formdata as $key => $val){
    
    if(!$val && $key !== 'kommentar'){
        
        $response['error'] = $error_msgs[$key][$locale];
        echo json_encode($response);
        exit;
    }
    
}

// opret sikkerhedskopi
$make_post = wp_insert_post(array(
    'post_type' => 'email',
    'post_title' => $formdata['navn'].' '.date_i18n('Y/m/d H:i:s',time()),
    'post_status' => 'publish',
),true);

if(is_wp_error($make_post)){
    $response['error'] = $make_post->get_error_message();
    echo json_encode($response);
    exit;
}

if($formdata['locale']){update_post_meta($make_post, 'locale', $formdata['locale']);}
if($formdata['email_rec']){update_post_meta($make_post, 'email_rec', $formdata['email_rec']);}
if($formdata['post']){update_post_meta($make_post, 'post_id', $formdata['post']->ID);}
if($formdata['navn']){update_post_meta($make_post, 'navn', $formdata['navn']);}
if($formdata['email']){update_post_meta($make_post, 'email', $formdata['email']);}
if($formdata['telefon']){update_post_meta($make_post, 'telefon', $formdata['telefon']);}
if($formdata['function']){update_post_meta($make_post, 'kommentar', $formdata['function']);}

// Send emails
function sendEmail( $from_name, $from, $to, $subject, $message ){
    $header = "From: ".$from_name." <".$from.">\r\n"; 
    $header.= "MIME-Version: 1.0\r\n"; 
    $header.= "Content-Type: text/html; charset=utf-8\r\n"; 
    $header.= "X-Priority: 1\r\n"; 
    $email = wp_mail($to, $subject, $message, $header);
    return $email;
}



$titel = 'Ny meddelelse fra '.$formdata['navn'].' : "'.apply_filters('the_title',$formdata['post']->post_title).'"';

$body = 'Der er modtaget en ny meddelelse på siden "'.apply_filters('the_title',$formdata['post']->post_title).'" på '.get_bloginfo('url').'<br/>';
$body .= '--------------------<br/><br/>';
$body .= '<strong>Modtaget data</strong><br/>';
$body .= 'Navn: '.$formdata['navn'].'<br/>';
$body .= 'E-mail: '.$formdata['email'].'<br/>';
$body .= 'Telefon: '.$formdata['telefon'].'<br/>';
$body .= 'Jeg er: '.$formdata['function'].'<br/><br/>';
$body .= '--------------------<br/><br/>';
$body .= 'Venlig hilsen serveren';


$kopi = ($formdata['locale'] == 'da_DK') ? 'Kopi: ' : 'Copy: ' ;

// Send mail til email_rec
$send = sendEmail( $formdata['navn'], $formdata['email'], $formdata['email_rec'], $titel, $body );
if(!$send){
    $response['error'] = 'Kunne ikke sende beskeden til Grønbech, prøv igen';
    echo json_encode($response);
    exit;
}

// Send kopi til afsender
$send_copy = sendEmail( get_bloginfo('name'), $formdata['email_rec'], $formdata['email'], $kopi.$titel, $body );
if(!$send){
    $response['error'] = 'Kunne ikke sende kopi af beskeden';
    echo json_encode($response);
    exit;
}


// Send succesmeddelelse
$response['success'] = ($formdata['locale'] == 'da_DK') ? 'Tak for din henvendelse' : 'Thank you for your message' ;
echo json_encode($response);
exit;