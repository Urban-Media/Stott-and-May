<?php
/**
 * Stott & May functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Stott_&_May
 */

if ( ! function_exists( 'stott_and_may_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function stott_and_may_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Stott & May, use a find and replace
		 * to change 'stott-and-may' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'stott-and-may', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'stott-and-may' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'stott_and_may_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'stott_and_may_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stott_and_may_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stott_and_may_content_width', 640 );
}
add_action( 'after_setup_theme', 'stott_and_may_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stott_and_may_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'stott-and-may' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'stott-and-may' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'stott-and-may' ),
		'id'            => 'footer-column-1',
		'description'   => esc_html__( 'This is the first column in the footer.', 'stott-and-may' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'stott-and-may' ),
		'id'            => 'footer-column-2',
		'description'   => esc_html__( 'This is the second column in the footer.', 'stott-and-may' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'stott-and-may' ),
		'id'            => 'footer-column-3',
		'description'   => esc_html__( 'This is the third column in the footer.', 'stott-and-may' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'stott_and_may_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stott_and_may_scripts() {
	wp_deregister_script('jquery');

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css' );

	wp_enqueue_style( 'stott-and-may-style', get_stylesheet_uri() );

	wp_enqueue_style( 'simplelineicons', '//cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css' );

	wp_enqueue_style( 'bxslider-style', '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css' );

	wp_enqueue_style( 'fancybox-style', get_template_directory_uri() . '/fancybox-master/jquery.fancybox.min.css' );

	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.2.1.slim.min.js', true );

	wp_enqueue_script( 'popper-script', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', true );

	wp_enqueue_script( 'stott-and-may-fonts', get_template_directory_uri() . '/js/fonts.js', array(), true );

	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.js', array(), true );

	wp_enqueue_script( 'owl-carousel-animate', get_template_directory_uri() . '/js/owl.animate.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-autoheight', get_template_directory_uri() . '/js/owl.autoheight.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-autoplay', get_template_directory_uri() . '/js/owl.autoplay.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-autorefresh', get_template_directory_uri() . '/js/owl.autorefresh.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-hash', get_template_directory_uri() . '/js/owl.hash.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-lazyload', get_template_directory_uri() . '/js/owl.lazyload.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-navigation', get_template_directory_uri() . '/js/owl.navigation.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-support', get_template_directory_uri() . '/js/owl.support.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'owl-carousel-video', get_template_directory_uri() . '/js/owl.video.js', array('owl-carousel-js'), true );

	wp_enqueue_script( 'chart-script', get_template_directory_uri() . '/js/chart.js', array('jquery'), true );

	wp_enqueue_script( 'stott-and-may-custom-js', get_template_directory_uri() . '/js/custom.js', array('tweenmax-js'), true );

	wp_enqueue_script( 'tweenmax-js', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js', array(), true );

	wp_enqueue_script( 'stott-and-may-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'stott-and-may-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', true );

	wp_enqueue_script( 'bxslider-script', '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', true );

	wp_enqueue_script( 'fancybox-script', get_template_directory_uri() . '/fancybox-master/jquery.fancybox.min.js', array('jquery'), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'stott_and_may_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*****************************
CUSTOM
*****************************/

// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
function vc_before_init_actions() {
    // Require new custom Element
    require_once( get_template_directory().'/vc-elements/hero-header.php' );
		require_once( get_template_directory().'/vc-elements/fullwidth-video.php' );
		require_once( get_template_directory().'/vc-elements/icon-carousel.php' );
		require_once( get_template_directory().'/vc-elements/blog-posts.php' );
		require_once( get_template_directory().'/vc-elements/resource-download.php' );
		require_once( get_template_directory().'/vc-elements/person-outline.php' );
		require_once( get_template_directory().'/vc-elements/basic-text.php' );
		require_once( get_template_directory().'/vc-elements/headline-text.php' );
		require_once( get_template_directory().'/vc-elements/slideshow.php' );
		require_once( get_template_directory().'/vc-elements/video-lightbox.php' );
		require_once( get_template_directory().'/vc-elements/stotters.php' );
		require_once( get_template_directory().'/vc-elements/slanted-image.php' );
		require_once( get_template_directory().'/vc-elements/charts.php' );
		require_once( get_template_directory().'/vc-elements/image-row.php' );
}
define('WP_SCSS_ALWAYS_RECOMPILE', true);

/*****************************/

//Hide Admin Bar
add_filter('show_admin_bar', '__return_false');

/*****************************/

add_action( 'init', 'create_markets_nonhierarchical_taxonomy', 0 );

function create_markets_nonhierarchical_taxonomy() {
	$labels = array(
		'name' => _x( 'Markets', 'taxonomy general name' ),
	  'singular_name' => _x( 'Market', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Markets' ),
	  'popular_items' => __( 'Popular Markets' ),
	  'all_items' => __( 'All Markets' ),
	  'parent_item' => null,
	  'parent_item_colon' => null,
	  'edit_item' => __( 'Edit Market' ),
	  'update_item' => __( 'Update Market' ),
	  'add_new_item' => __( 'Add New Market' ),
	  'new_item_name' => __( 'New Market Name' ),
	  'separate_items_with_commas' => __( 'Separate markets with commas' ),
	  'add_or_remove_items' => __( 'Add or remove markets' ),
	  'choose_from_most_used' => __( 'Choose from the most used markets' ),
	  'menu_name' => __( 'Markets' ),
	);

	// Now register the non-hierarchical taxonomy like tag
	register_taxonomy('markets','post',array(
		'hierarchical' => false,
	  'labels' => $labels,
	  'show_ui' => true,
	  'show_admin_column' => true,
	  'update_count_callback' => '_update_post_term_count',
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'market' ),
	));
}

/*****************************/

// Our custom post type function
function create_posttype() {
	register_post_type( 'stotters',
	// CPT Options
  	array(
    	'labels' => array(
      	'name' => __( 'Stotters' ),
        'singular_name' => __( 'Stotter' ),
				'all_items' => __( 'All Stotters'),
				'view_item' => __( 'View Stotter'),
				'add_new_item' => __( 'Add New Stotter' ),
				'add_new' => __( 'Add New' ),
				'edit_item' => __( 'Edit Stotter' ),
      ),
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
			'taxonomies' => array( 'markets' ),
			'hierarchical' => false,
      'public' => true,
			'menu_position' => 20,
			'has_archive'         => true,
			'menu_icon' => 'dashicons-universal-access',
      'has_archive' => true,
      'rewrite' => array('slug' => 'stotters'),
    )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
