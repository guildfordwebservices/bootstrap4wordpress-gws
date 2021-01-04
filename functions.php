<?php
	/**
	 * Bootstrap 4 on Wordpress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 4.4.1
	 * @autor 		Babobski
	 */

	define('BOOTSTRAP_VERSION', '4.4.1');

	/* ========================================================================================================================

	Add language support to theme

	======================================================================================================================== */
	add_action('after_setup_theme', 'my_theme_setup');
	function my_theme_setup(){
		load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
	}



	/* ========================================================================================================================

	Required external files

	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/bs4navwalker.php' );

	/* ========================================================================================================================

	Add html 5 support to wordpress elements

	======================================================================================================================== */
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	/* ========================================================================================================================

	Theme specific settings

	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	//add_image_size( 'name', width, height, crop true|false );

	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================

	Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	add_filter( 'body_class', array( 'BsWp', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================

	Custom Post Types - include custom post types and taxonomies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */



	/* ========================================================================================================================

	Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function bootstrap_script_init() {

		// Get theme version number (located in style.css)
		$theme = wp_get_theme();

		wp_register_script('bootstrap', get_template_directory_uri(). '/js/bootstrap.bundle.min.js', array( 'jquery' ), BOOTSTRAP_VERSION, true);
		wp_enqueue_script('bootstrap');

		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery', 'bootstrap' ), $theme->get( 'Version' ), true );
		wp_enqueue_script( 'site' );

		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.min.css', array(), BOOTSTRAP_VERSION, 'all' );
		wp_enqueue_style( 'bootstrap' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', array(), $theme->get( 'Version' ), 'screen' );
		wp_enqueue_style( 'screen' );
		
		wp_register_style( 'gws-custom', get_stylesheet_directory_uri().'/css/gws-custom.css', array(), 'all' );
		wp_enqueue_style( 'gws-custom' );
		
	}

		add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
		function enqueue_load_fa() {
		wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.11.2/css/all.css' );
		}

		
	/* ========================================================================================================================

	Security & cleanup wp admin

	======================================================================================================================== */

	//remove wp version
	function theme_remove_version() {
	return '';
	}

	add_filter('the_generator', 'theme_remove_version');

	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}

	add_filter('admin_footer_text', 'remove_footer_admin');

	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;

		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}

	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);

	// Remove default Dashboard widgets
	function disable_default_dashboard_widgets() {

		//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
		remove_meta_box('dashboard_activity', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');

		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');

	remove_action('welcome_panel', 'wp_welcome_panel');

	/* ========================================================================================================================

	Custom login

	======================================================================================================================== */

	// Add custom css
	function my_custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css" />';
	}
	add_action('login_head', 'my_custom_login');

	// Link the logo to the home of our website
	function my_login_logo_url() {
		return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	// Change the title text
	function my_login_logo_url_title() {
		return 'Bootstrap 4 on WordPress';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );


	/* ========================================================================================================================

	Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li class="media">
			<div class="media-left">
				<?php echo get_avatar( $comment ); ?>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</div>
		<?php endif;
	}


	/* ========================================================================================================================

	GWS WIDGETS

	======================================================================================================================== */

    function tutsplus_widgets_init() {
 
    // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'tutsplus' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ) );
 
    // Second Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'tutsplus' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ) );
 
    // Third Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'tutsplus' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ) );
 
    // Fourth Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'tutsplus' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ) );
         
}
 
    // Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
    add_action( 'widgets_init', 'tutsplus_widgets_init' );


    /* SIDEBAR WIDGET AREA */
	
	register_sidebar( array(
	'name' => 'Right Sidebar',
	'before_widget' => '<div id="Right Sidebar" class="card my-4">',
	'after_widget' => '</div>',
	'before_title' => '<h6  class="card-header text-center">',
	'after_title' => '</h6>',
	) );

/* ========================================================================================================================

	PAGNATION

	======================================================================================================================== */

    function njengah_number_pagination() {

    global $wp_query;
    $big = 9999999; // need an unlikely integer
    echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages) );
    }

/* ========================================================================================================================

	FONT AWESOME FUNCTION

	======================================================================================================================== */

    add_filter('widget_title', 'do_shortcode');


    add_shortcode('fa-menu', 'bn_shortcode_famenu');
    function bn_shortcode_famenu( $attr ){
    return '<i class="fas fa-bars"></i>';
    }

    add_shortcode('fa-blog', 'bn_shortcode_fablog');
    function bn_shortcode_fablog( $attr ){
    return '<i class="far fa-window-maximize"> </i>';
    }

    add_shortcode('fa-list', 'bn_shortcode_falist');
    function bn_shortcode_falist( $attr ){
    return '<i class="fa fa-list-alt"> </i>';
    }
