<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.0' );

// Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support
// add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu', 'search-form', 'skip-links', 'rems' ) );
add_theme_support( 'genesis-accessibility', array( 'headings', 'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * Fixes Genesis bug - when using static front page and blog page (admin reading settings) Home page is <p> tag and Blog page is <h1> tag
 *
 * Replaces "is_home" with "is_front_page" to correctly display Home page wit <h1> tag and Blog page with <p> tag
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 *
 * @edited by Sridhar Katakam
 * @link http://www.sridharkatakam.com/use-inline-logo-instead-background-image-genesis/
 *
************************************/
add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
function custom_header_inline_logo( $title, $inside, $wrap ) {

	$logo = '<img src="' . get_stylesheet_directory_uri() . '/images/logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="300" height="60" />';

	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );

	// Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	// A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
	$wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );

}

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'custom_scripts_styles_mobile_responsive' );
function custom_scripts_styles_mobile_responsive() {

	wp_enqueue_script( 'responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'autoscroller-timer', get_stylesheet_directory_uri() . '/js/jquery.timers.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'autoscroller', get_stylesheet_directory_uri() . '/js/jquery.autoScroller.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_style( 'dashicons' );

}

// Customize the previous page link
add_filter ( 'genesis_prev_link_text' , 'sp_previous_page_link' );
function sp_previous_page_link ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Previous Page', CHILD_DOMAIN );
}

// Customize the next page link
add_filter ( 'genesis_next_link_text' , 'sp_next_page_link' );
function sp_next_page_link ( $text ) {
	return __( 'Next Page', CHILD_DOMAIN ) . g_ent( ' &raquo; ' );
}

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

/**** Custom By Gal ******/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' ); // Remove logo

remove_action( 'genesis_after_header', 'genesis_do_nav' ); // Remove primary nav from defualt hook
add_action( 'genesis_before_header', 'genesis_do_nav' );

// Register Custom Post Type
function custom_post_type_news() {

	$labels = array(
		'name'                => _x( 'News Items', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'News Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'News Item', 'text_domain' ),
		'name_admin_bar'      => __( 'News Item', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Item', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'News Item', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,

		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'news_item', $args );

}
add_action( 'init', 'custom_post_type_news', 0 );

/**** Clients  Custom Post Type *****/
// Register Custom Post Type
function custom_post_type_clients() {

    $labels = array(
        'name'                => _x( 'clients', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'client', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Clients', 'text_domain' ),
        'name_admin_bar'      => __( 'Post Type', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
        'all_items'           => __( 'All Items', 'text_domain' ),
        'add_new_item'        => __( 'Add New Item', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New Item', 'text_domain' ),
        'edit_item'           => __( 'Edit Item', 'text_domain' ),
        'update_item'         => __( 'Update Item', 'text_domain' ),
        'view_item'           => __( 'View Item', 'text_domain' ),
        'search_items'        => __( 'Search Item', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'client', 'text_domain' ),
        'description'         => __( 'Post Type Description', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', ),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-universal-access',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'clients', $args );

}
add_action( 'init', 'custom_post_type_clients', 0 );
/* Add Top Image */

function do_top_image(){
	global $wp_query;
	$id= $wp_query->post->ID;
	$imageUrl=get_field('top_image',$id);
	if ($imageUrl=="")
		$imageUrl=get_stylesheet_directory_uri()."/images/top-images/home.png";
//	php stop here
	?>
    <div class="top-area">
        <a href="<?php echo get_home_url() ?> " class="logo" title="עמוד הבית">
            <img src="<?php  echo get_stylesheet_directory_uri()?>/images/logo.png"/>
        </a>
		<img class="top-image" src="<?php echo $imageUrl?>"/>
    </div>
<?php
//	php start here
}
add_action('genesis_header','do_top_image');

// Add Shortcode
// Add Shortcode
function custom_shortcode_landing() {

    $return = '<div class="land-rental box">';
    $return .= '<h3>שטחים להשכרה</h3> </div>';
    return $return;

}
add_shortcode( 'custom_shortcode_landing', 'custom_shortcode_landing' );


add_image_size( 'client-thumb', 300, 200,false  );
