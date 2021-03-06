<?php
/**
 * Helios functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Helios
 */

if ( ! function_exists( 'helios_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function helios_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Helios, use a find and replace
		 * to change 'helios' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'helios', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'helios' ),
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
		add_theme_support( 'custom-background', apply_filters( 'helios_custom_background_args', array(
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
add_action( 'after_setup_theme', 'helios_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function helios_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'helios_content_width', 640 );
}
add_action( 'after_setup_theme', 'helios_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function helios_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'helios' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'helios' ),
		'before_widget' => '<div id="%1$s" class="6u widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'helios_widgets_init' );


/* 3 Column footer */

/* REGISTER WIDGETS ------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Left',
        'id'   => 'footer-left-widget',
        'description'   => 'Left Footer widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name' => 'Footer Center',
        'id'   => 'footer-center-widget',
        'description'   => 'Centre Footer widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name' => 'Footer Right',
        'id'   => 'footer-right-widget',
        'description'   => 'Right Footer widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));


}



/**
 * Enqueue scripts and styles.
 */
function helios_scripts() {
	wp_enqueue_style( 'helios-style', get_stylesheet_uri() );

	wp_enqueue_script( 'helios-jquery-script-main', get_template_directory_uri() . '/js/jquery.min.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-jquery-dropotron', get_template_directory_uri() . '/js/jquery.dropotron.min.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-scrolly-min', get_template_directory_uri() . '/js/jquery.scrolly.min.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-on-visible-script', get_template_directory_uri() . '/js/jquery.onvisible.min.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-skel-script', get_template_directory_uri() . '/js/skel.min.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-util-script', get_template_directory_uri() . '/js/util.js', array(), '20151215', true );
	wp_enqueue_script( 'helios-main-scripts', get_template_directory_uri() . '/js/main.js', array(), '20151215', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'helios_scripts' );

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

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );
 

//create a custom taxonomy name it topics for your posts
function create_topics_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Topics', 'taxonomy general name' ),
    'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Topics' ),
    'all_items' => __( 'All Topics' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Topic:' ),
    'edit_item' => __( 'Edit Topic' ), 
    'update_item' => __( 'Update Topic' ),
    'add_new_item' => __( 'Add New Topic' ),
    'new_item_name' => __( 'New Topic Name' ),
    'menu_name' => __( 'Topics' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('topics',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topic' ),
  ));
 
}

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'pre_link_description', 'wp_filter_kses' );
remove_filter( 'pre_link_notes', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );



// Display custom amount of posts 
function themeprefix_latest_posts() {
	global $post;
	$latest_posts = new WP_Query(array(
		'posts_per_page'      => 3, // Displays the latest 10 posts, change 10 to what you require
		'post_type'           => 'post', // Pulls posts from 'post' post type only
		'ignore_sticky_posts' => true, // Ignores the sticky posts
	));

	while ($latest_posts->have_posts()) :
		$latest_posts->the_post();
		?>

		<ul class="latest_custom_posts_list">
			<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
		</ul>

		<?php
	endwhile;
	// Reset Post Data
	wp_reset_postdata();
}


// Display posts from a specific category ID
function helios_display_cat_posts() {
	//$catquery = new WP_Query( 'cat=32&posts_per_page=3' );
	$catquery = new WP_Query( 
		array( 
			'cat'                 => 32,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 3,
		)
	);

	if ( $catquery->have_posts() ) {
		// The loop
		while ( $catquery->have_posts() ) :
			$catquery->the_post();

			?>
			<?php get_template_part( 'template-parts/content-home-featured' ); ?> <!-- Render this custom content page from child theme -->
		<?php
		endwhile;
	}
	else {
		// Nothing found..
	}
	// Reset Post Data
	wp_reset_postdata();
}