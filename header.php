<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $current_id = $wp_query->post->ID; ?>
<meta charset="utf8" />
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo get_the_permalink($current_id); ?>" />
<?php if (has_post_thumbnail($current_id)) : ?>
<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id($current_id) ); ?>" />
<?php else :?>
<meta property="og:image" content="http://enss.dk/square.png" />
<?php endif;?>
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/webfontkit/stylesheet.css"/>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/wp-content/themes/enss/contentslider.css"/>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/wp-content/themes/enss/slider.css"/>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/wp-content/themes/enss/breaking.css"/>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/wp-content/themes/enss/mailchimp.css"/>
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/wp-content/themes/enss/scss/main.css"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'url' ); ?>/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<!--<script src="<?php echo get_bloginfo( 'url' ); ?>/js/masonry.js"></script>-->
<script src="<?php echo get_bloginfo( 'url' ); ?>/js/enss.js"></script>
<script src="<?php echo get_bloginfo('url');?>/js/html5shiv.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/ob/outdatedBrowser.min.css">     
<script type="text/javascript" src="<?php bloginfo( 'url' ); ?>/js/fancybox/jquery.fancybox.pack.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45736246-1', 'enss.dk');
  ga('send', 'pageview');

</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body <?php body_class(); ?>>
<div id="mobile-menu">
<a class="mobile-btn mobile-expand"><img src="http://enss.dk/wp-content/uploads/2013/10/mobil-menu.png"/></a>
<a href="tel:70203747" class="mobile-btn mobile-call"><img src="http://enss.dk/wp-content/uploads/2013/10/mobil-ring.png"/></a>
<?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'menu_class' => 'mobile-menu')); ?>
</div>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
           <?php wp_nav_menu( array( 'theme_location' => 'header-menu')); ?>
		</hgroup>

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	<div id="nav-fixed">
     <hr class="pyntestreg"/>
    <nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->
         <hr class="pyntestreg"/>
    </div>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">