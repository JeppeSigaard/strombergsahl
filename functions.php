<?php
/**
 * Twenty Twelve functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Twenty Twelve setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	add_image_size('mb_image',300,199,array(0,0));
	add_image_size('slide-size',1248,576,true);
    add_image_size('news-size',750,320,true);
    add_image_size('news-small',400,235,true);
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
    
	$font_url = twentytwelve_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'twentytwelve-fonts', esc_url_raw( $font_url ), array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function twentytwelve_mce_css( $mce_css ) {
	$font_url = twentytwelve_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'twentytwelve_mce_css' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Default højre sidebar'),
		'id' => 'sidebar-1',
		'description' => __( 'Default widget-område. Bruges, hvis et widgetområde står tomt. Det er praktisk fordi temaet har brug for højrejusteret indhold.' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );


function register_my_menu() {
  register_nav_menu('header-menu',__( 'Højre topmenu' ));
  register_nav_menu('mobile-menu',__( 'Mobil menu' ));
  register_nav_menu('om-menu',__( 'Sidemenu - Om ENSS' ));
  register_nav_menu('kompetencer-menu',__( 'Sidemenu - Kompetencer' ));
  register_nav_menu('projekter-menu',__( 'Sidemenu - Projekter' ));
}
add_action( 'init', 'register_my_menu' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {
	register_sidebar( array(
		'name' => 'Forside swipe billeder',
		'id' => 'swipe_widget_img',
		'before_widget' => '<div class="front-swipe-image">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'indeholder swipe-billede 1-3. bibehold divider classes!',
	) );
	
	register_sidebar( array(
		'name' => 'Forside swipe tekst',
		'id' => 'swipe_widget_text',
		'before_widget' => '<div class="swipe-text">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'indeholder swipe-text 1-3. bibehold divider classes!',
	) );

	register_sidebar( array(
		'name' => 'Forside Kompetencer 1',
		'id' => 'home_widget_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Første af 3 widgets, der vises på forsiden. Fra tablet-visning og ned vises forsidens widgets som slideshow.',
	) );
	
	register_sidebar( array(
		'name' => 'Forside Kompetencer 2',
		'id' => 'home_widget_2',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Anden af 3 widgets, der vises på forsiden. Fra tablet-visning og ned vises forsidens widgets som slideshow.',
	) );
	
	register_sidebar( array(
		'name' => 'Forside Kompetencer 3',
		'id' => 'home_widget_3',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Tredje af 3 widgets, der vises på forsiden. Fra tablet-visning og ned vises forsidens widgets som slideshow.',
	) );
	
	register_sidebar( array(
		'name' => 'Forside Nyhedswidget',
		'id' => 'home_widget_news',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der viser nyheder på forsiden',
	) );
	
	register_sidebar( array(
		'name' => 'Forside Kontaktwidget',
		'id' => 'home_widget_kontakt',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der viser kontaktinfo på forsiden. Vises ikke i tablet og nedefter',
	) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Om os',
		'id' => 'page_widget_about',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på om-siden',
	) );
	
			register_sidebar( array(
				'name' => 'Underewidget Om os: Historie',
				'id' => 'page_widget_historie',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på historie-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
			
			register_sidebar( array(
				'name' => 'Underewidget Om os: Organisation',
				'id' => 'page_widget_organisation',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på organisations-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
			
			register_sidebar( array(
				'name' => 'Underewidget Om os: Målsætning',
				'id' => 'page_widget_maalsaetning',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på målsætnings-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
			
			register_sidebar( array(
				'name' => 'Underewidget Om os: Nøgletal',
				'id' => 'page_widget_noegletal',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på nøgletals-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
			
			register_sidebar( array(
				'name' => 'Underewidget Om os: Miljø',
				'id' => 'page_widget_miljoe',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på miljø-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
		
			register_sidebar( array(
				'name' => 'Underewidget Om os: Job',
				'id' => 'page_widget_job',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="rounded">',
				'after_title' => '</h2>',
				'description' => 'Widget, der vises højrejusteret på job-siden. Hvis widget-området er tomt, vises Om os-sidens widget',
			) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Projekter',
		'id' => 'page_widget_projekter',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på projektsider',
	) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Kompetencer',
		'id' => 'page_widget_kompetencer',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på kompetencesider',
	) );
	
			register_sidebar( array(
			'name' => 'Underwidget Kompetencer: Nybyggeri',
			'id' => 'page_widget_nybyggeri',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="rounded">',
			'after_title' => '</h2>',
			'description' => 'Widget, der vises højrejusteret på nybyggeri-siden. Hvis widget-området er tomt, vises Kompetence-sidens widget',
		) );
		
		register_sidebar( array(
			'name' => 'Underwidget Kompetencer: Om- og tilbygning',
			'id' => 'page_widget_om-tilbygning',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="rounded">',
			'after_title' => '</h2>',
			'description' => 'Widget, der vises højrejusteret på om- og tilbygnings-siden. Hvis widget-området er tomt, vises Kompetence-sidens widget',
		) );
		
		register_sidebar( array(
			'name' => 'Underwidget Kompetencer: Renovering',
			'id' => 'page_widget_renovering',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="rounded">',
			'after_title' => '</h2>',
			'description' => 'Widget, der vises højrejusteret på Renoverings-siden. Hvis widget-området er tomt, vises Kompetence-sidens widget',
		) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Aktuelt',
		'id' => 'page_widget_news',
		'before_widget' => '<div class="page-widget-news">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på nyhedssider',
	) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Artikler i aktuelt',
		'id' => 'post_widget_news',
		'before_widget' => '<div class="post-widget-news">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på nyhedsartikler',
	) );
	
	register_sidebar( array(
		'name' => 'Sidewidget højre: Kontakt',
		'id' => 'page_widget_kontakt',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		'description' => 'Widget, der vises højrejusteret på kontaktsiden',
	) );
	
	
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'page_widget_footer',
		'before_widget' => '<div class="site-info"><p>',
		'after_widget' => '</p></div>',
		'before_title' => '<span style="display:none;">',
		'after_title' => '</span>',
		'description' => 'Widget, der vises i footer',
	) );
	
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

// Ryd op i admin menuen
function remove_menus(){
  
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    	//Pages
  remove_menu_page( 'edit-comments.php' );             //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                     //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page('bws_plugins');
}
add_action( 'admin_menu', 'remove_menus' );


// Remove that junk from my wp_head
 remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
 remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
 remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
 remove_action('wp_head', 'feed_links', 2); // Removes the RSS feeds remember to add post feed maunally (if required) to header.php
 remove_action('wp_head', 'feed_links_extra', 3); // Removes all other RSS links
 remove_action('wp_head', 'index_rel_link'); // Removes the index page link
 remove_action('wp_head', 'start_post_rel_link', 10, 0); // Removes the random post link
 remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Removes the parent post link
 remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Removes the next and previous post links

add_action('wp_enqueue_scripts', 'no_more_jquery');
function no_more_jquery(){
    wp_deregister_script('jquery');
	wp_enqueue_script( 'jq', get_bloginfo('url').'/js/jquery.js', false, '', false );
}


require('functions/meta-box.php');
add_action( 'init', 'add_post_types' );
function add_post_types() {
	
	
	// Vi  tilføjer projekter til backend
	$labels = array(
		'name'               => _x( 'Projekter', 'post type general name', 'SMARMONKEY' ),
		'singular_name'      => _x( 'projekt', 'post type singular name', 'SMARMONKEY' ),
		'menu_name'          => _x( 'Projekter', 'admin menu', 'SMARMONKEY' ),
		'name_admin_bar'     => _x( 'Projekter', 'add new on admin bar', 'SMARMONKEY' ),
		'add_new'            => _x( 'Tilføj nyt projekt', 'spørgsmål/svar', 'SMARMONKEY' ),
		'add_new_item'       => __( 'Tilføj nyt projekt', 'SMARMONKEY' ),
		'new_item'           => __( 'Nyt projekt', 'SMARMONKEY' ),
		'edit_item'          => __( 'Rediger', 'SMARMONKEY' ),
		'view_item'          => __( 'Se projekt', 'SMARMONKEY' ),
		'all_items'          => __( 'Se alle', 'SMARMONKEY' ),
		'search_items'       => __( 'Find projekt', 'SMARMONKEY' ),
		'parent_item_colon'  => __( 'Forældre:', 'SMARMONKEY' ),
		'not_found'          => __( 'Dette er en demoudgave af projekter. Please ignore for now...', 'SMARMONKEY' ),
		'not_found_in_trash' => __( 'Papirkurven er tom.', 'SMARMONKEY' ),
	);

	$args = array(
		'menu_icon' 		 => 'dashicons-welcome-widgets-menus',
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'projekt' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 25,
		'supports'           => array( 'title')
	);
	
	register_post_type( 'projekt', $args );
	
	// Vi  tilføjer medarbejdere
	$labels = array(
		'name'               => _x( 'Medarbejdere', 'post type general name', 'SMARMONKEY' ),
		'singular_name'      => _x( 'medarbejder', 'post type singular name', 'SMARMONKEY' ),
		'menu_name'          => _x( 'Medarbejdere', 'admin menu', 'SMARMONKEY' ),
		'name_admin_bar'     => _x( 'Medarbejdere', 'add new on admin bar', 'SMARMONKEY' ),
		'add_new'            => _x( 'Tilføj ny medarbejder', 'spørgsmål/svar', 'SMARMONKEY' ),
		'add_new_item'       => __( 'Tilføj ny medarbejder', 'SMARMONKEY' ),
		'new_item'           => __( 'Ny medarbejder', 'SMARMONKEY' ),
		'edit_item'          => __( 'Rediger', 'SMARMONKEY' ),
		'view_item'          => __( 'Se medarbejder', 'SMARMONKEY' ),
		'all_items'          => __( 'Se alle', 'SMARMONKEY' ),
		'search_items'       => __( 'Find medarbejder', 'SMARMONKEY' ),
		'parent_item_colon'  => __( 'Forældre:', 'SMARMONKEY' ),
		'not_found'          => __( 'Medarbejderlisten er tom', 'SMARMONKEY' ),
		'not_found_in_trash' => __( 'Papirkurven er tom.', 'SMARMONKEY' ),
	);

	$args = array(
		'menu_icon' 		 => 'dashicons-businessman',
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'medarbejder' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 26,
		'supports'           => array( 'title')
	);

	register_post_type( 'medarbjeder', $args );
	
	// Vi  tilføjer ekstra slides til SMartBoard
	$labels = array(
		'name'               => _x( 'Ekstra slides', 'post type general name', 'SMARMONKEY' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'SMARMONKEY' ),
		'menu_name'          => _x( 'Esktra slides', 'admin menu', 'SMARMONKEY' ),
		'name_admin_bar'     => _x( 'Ekstra slides', 'add new on admin bar', 'SMARMONKEY' ),
		'add_new'            => _x( 'Tilføj nyt slide', 'spørgsmål/svar', 'SMARMONKEY' ),
		'add_new_item'       => __( 'Tilføj nyt slide', 'SMARMONKEY' ),
		'new_item'           => __( 'Nyt slide', 'SMARMONKEY' ),
		'edit_item'          => __( 'Rediger', 'SMARMONKEY' ),
		'view_item'          => __( 'Se slideshow', 'SMARMONKEY' ),
		'all_items'          => __( 'Ekstra slides', 'SMARMONKEY' ),
		'search_items'       => __( 'Find slide', 'SMARMONKEY' ),
		'parent_item_colon'  => __( 'Forældre:', 'SMARMONKEY' ),
		'not_found'          => __( 'Ingen ekstra slides', 'SMARMONKEY' ),
		'not_found_in_trash' => __( 'Papirkurven er tom.', 'SMARMONKEY' ),
	);

	$args = array(
		'menu_icon' 		 => 'dashicons-settings',
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => 'smartboard',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'smabd' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 50,
		'supports'           => array( 'title')
	);

	register_post_type( 'smabd', $args );
	
	
	
}

// Opret projektkategorier
add_action( 'init', 'make_project_tax' );

function make_project_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Kategorier', 'taxonomy general name' ),
		'singular_name'     => _x( 'kategori', 'taxonomy singular name' ),
		'search_items'      => __( 'Søg kategori' ),
		'all_items'         => __( 'Alle kategorier' ),
		'parent_item'       => __( 'forælder' ),
		'parent_item_colon' => __( 'foreælder:' ),
		'edit_item'         => __( 'Rediger' ),
		'update_item'       => __( 'Opdater' ),
		'add_new_item'      => __( 'Tilføj ny kategori' ),
		'new_item_name'     => __( 'Ny kategori' ),
		'menu_name'         => __( 'Kategorier' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'projektkategori' ),
	);

	register_taxonomy( 'projektkategori', array( 'projekt' ), $args );
}


require 'functions/smartboard.php';

require 'functions/byggerating.php';





/*  Thumbnail upscale
/* ------------------------------------ */ 
function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null; // let the wordpress default function handle this
 
    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
 
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );
 
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );

?>