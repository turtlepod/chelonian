<?php
/**
 *****************************************
 * TAMATEBAKO
 * ---------------------------------------
 * @author    David Chandra Purnama
 * @version   0.1.0
 * @copyright Genbu Media
 * @link      http://shellcreeper.com
 *****************************************
 * TABLE OF CONTENTS:
 * 
 * #01 - LOAD HYBRID CORE
 * #02 - CONTENT
 * #03 - SETUP
 * #04 - SET DEFAULTS
 * #05 - SCRIPTS AND STYLE
 * #06 - CONTEXT
 * #07 - TEMPLATE FUNCTIONS
 * #08 - UTILLITY
 * #09 - REGISTER THEME SUPPORT
 * #10 - DEBUG
 * 
******************************************/


/* #01 - LOAD HYBRID CORE
******************************************/


/* Load the Hybrid Core framework and launch it. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();


/* #02 - SETUP
******************************************/


/* Load theme general setup */
add_action( 'after_setup_theme', 'tamatebako_setup', 5 );

/**
 * General Setup
 * @since 0.1.0
 */
function tamatebako_setup(){

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Hybrid Core */
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'loop-pagination' );

	/* Set Consistent Read More */
	add_filter( 'excerpt_more', 'tamatebako_disable_excerpt_more' );
	add_filter( 'the_excerpt', 'tamatebako_add_excerpt_more' );
	add_filter( 'the_content_more_link', 'tamatebako_content_more', 10, 2 );

	/* Edit Link */
	add_filter( 'edit_post_link', 'tamatebako_edit_post_link', 10, 2 );
	add_filter( 'edit_comment_link', 'tamatebako_edit_comment_link', 10, 2 );

	/* WP Link Pages */
	add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages' );

	/* Sidebar Defaults Args */
	add_filter( 'hybrid_sidebar_defaults', 'tamatebako_sidebar_defaults' );

	/* Script */
	add_action( 'wp_head', 'tamatebako_head_script' );
	add_action( 'wp_enqueue_scripts', 'tamatebako_enqueue_js' );
	add_action( 'wp_enqueue_scripts', 'tamatebako_register_css', 1 );

	/* Admin: TinyMCE Editor Style */
	add_filter( 'tiny_mce_before_init', 'tamatebako_tinymce_body_class' );

	/* Additional Body Classes */
	add_filter( 'body_class', 'tamatebako_body_class' );

	/* Additional Widgets Classes */
	add_filter( 'dynamic_sidebar_params', 'tamatebako_widget_class' );

	/* HTML 5 */
	$html5 = array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	);
	add_theme_support( 'html5', $html5 );
}


/* #03 - CONTENT
******************************************/

/**
 * Disable / Remove Auto Excerpt More
 * @since 0.1.0
 */
function tamatebako_disable_excerpt_more( $more ) {
	return '&hellip;';
}

/**
 * Add Excerpt More In All Excerpt
 * @since 0.1.0
 */
function tamatebako_add_excerpt_more( $excerpt ) {
	$string = tamatebako_string( 'read-more' );
	if ( !empty( $string ) ){
		return $excerpt . '<span class="more-link-wrap"><a class="more-link" href="' . get_permalink() . '"><span>' . $string . '</span></a></span>';
	}
	return $excerpt;
}

/**
 * Content More
 * @since 0.1.0
 */
function tamatebako_content_more( $more_link, $more_link_text ){
	$string = tamatebako_string( 'read-more' );
	if ( !empty( $string ) ){
		return '<span class="more-link-wrap">' . str_replace( $more_link_text, '<span>' . tamatebako_string( 'read-more' ) . '</span>', $more_link ) . '</span>';
	}
	return $more_link;
}

/**
 * Edit Post Link
 * @since 0.1.0
 */
function tamatebako_edit_post_link( $link, $post_id ){
	$string = tamatebako_string( 'edit' );
	if ( empty( $string ) ){
		return $link;
	}
	if ( 'Edit This' == strip_tags( $link ) ){
		$link = '<a class="post-edit-link" href="' . get_edit_post_link( $post_id ) . '">' . $string . '</a>';
	}
	return $link;
}

/**
 * Edit Post Link
 * @since 0.1.0
 */
function tamatebako_edit_comment_link( $link, $comment_id ){
	$string = tamatebako_string( 'edit' );
	if ( empty( $string ) ){
		return $link;
	}
	if ( 'Edit This' == strip_tags( $link ) ){
		$link = '<a class="comment-edit-link" href="' . get_edit_comment_link( $comment_id ) . '">' . $string . '</a>';
	}
	return $link;
}

/**
 * WP Link Pages
 * @since 0.1.0
 */
function tamatebako_wp_link_pages( $args ){
	$args['before'] = '<p class="wp-link-pages">';
	$args['after'] = '</p>';
	return $args;
}


/* #04 - SET DEFAULTS
******************************************/


/**
 * Filter Register Sidebar Args in Hybrid Core
 * @since 0.1.0
 */
function tamatebako_sidebar_defaults( $args ){
	$args['before_title'] = '<div class="widget-title">';
	$args['after_title'] = '</div>';
	return $args;
}

/* Override theme layout customize */
add_action( 'after_setup_theme', 'tamatebako_override_theme_layouts_customize_setup', 14 );

/**
 * Override Theme Layouts Customize and fix theme layout post meta.
 * 
 * @since 0.2.0
 */
function tamatebako_override_theme_layouts_customize_setup(){

	/* Check theme support */
	if ( current_theme_supports( 'theme-layouts' ) ) {

		/* Remove default theme layout customize function */
		remove_action( 'customize_register', 'theme_layouts_customize_register' );

		/* Add custom setting for layout in customizer */
		add_action( 'customize_register', 'tamatebako_theme_layouts_customize_register' );

		/* Remove theme layouts default filter */
		remove_filter( 'theme_mod_theme_layout', 'theme_layouts_filter_layout', 5 );

		/* Set to default layout in singular pages when it's not supported. */
		add_filter( 'theme_mod_theme_layout', 'tamatebako_filter_layout', 6 );
	}
}

/**
 * Theme Layouts Customize Register
 * Modified from Hybrid Core Theme Layouts Ext. Customizer.
 *
 * @author Justin Tadlock <justin@justintadlock.com>
 * @author Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since 0.2.0
 */
function tamatebako_theme_layouts_customize_register( $wp_customize ){

	/* Get supported theme layouts. */
	$layouts = theme_layouts_get_layouts();
	$args = theme_layouts_get_args();

	if ( true === $args['customize'] ) {

		/* Add the layout section. */
		$wp_customize->add_section(
			'layout',
			array(
				'title'      => esc_html( tamatebako_string( 'layout' ) ),
				'priority'   => 190,
				'capability' => 'edit_theme_options'
			)
		);

		/* Add the 'layout' setting. */
		$wp_customize->add_setting(
			'theme_layout',
			array(
				'default'           => get_theme_mod( 'theme_layout', $args['default'] ),
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_html_class',
				'transport'         => 'refresh' /* USE REFRESH */
			)
		);

		/* Set up an array for the layout choices and add in the 'default' layout. */
		$layout_choices = array();

		/* Only add 'default' if it's the actual default layout. */
		if ( 'default' == $args['default'] )
			$layout_choices['default'] = theme_layouts_get_string( 'default' );

		/* Loop through each of the layouts and add it to the choices array with proper key/value pairs. */
		foreach ( $layouts as $layout )
			$layout_choices[$layout] = theme_layouts_get_string( $layout );

		/* Add the layout control. */
		$wp_customize->add_control(
			'theme-layout-control',
			array(
				'label'    => esc_html( tamatebako_string( 'global-layout' ) ),
				'section'  => 'layout',
				'settings' => 'theme_layout',
				'type'     => 'radio',
				'choices'  => $layout_choices
			)
		);
	}
}

/**
 * Post Layout Filter.
 * Problem: If in the future post meta is disabled, user cannot change post layout already set.
 * @since 0.1.0
 */
function tamatebako_filter_layout( $theme_layout ){

	/* Layout */
	$layout = '';

	/* Theme Support */
	$layouts = get_theme_support( 'theme-layouts' );

	/* If viewing a singular post, get the post layout. */
	if ( is_singular() ){

		/* Only if theme layout support post meta and post type supports it */
		if( true === $layouts[1]['post_meta'] && post_type_supports( get_post_type( get_queried_object_id() ) , 'theme-layouts' ) ){

			$layout = get_post_layout( get_queried_object_id() );
		}
	}

	/* If viewing an author archive, get the user layout. */
	elseif ( is_author() )
		$layout = get_user_layout( get_queried_object_id() );

	/* If a layout was found, set it. */
	if ( !empty( $layout ) && 'default' !== $layout ) {
		$theme_layout = $layout;
	}

	/* Else, if no layout option has yet been saved, return the theme default. */
	elseif ( empty( $theme_layout ) ) {
		$args = theme_layouts_get_args();
		$theme_layout = $args['default'];
	}

	return $theme_layout;
}


/* #05 - SCRIPTS AND STYLE
******************************************/


/**
 * Get Theme Version
 * Helper function
 * @since 0.1.0
 */
function tamatebako_theme_version(){
	$theme = wp_get_theme( get_template() );
	return $theme->get( 'Version' );
}

/**
 * Google Font Open Sans URL
 * @since 0.1.0
 */
function tamatebako_google_open_sans_font_url(){
	$font_url = add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );
	return $font_url;
}

/**
 * Google Font Merriweather URL
 * @since 0.1.0
 */
function tamatebako_google_merriweather_font_url(){
	$font_url = add_query_arg( 'family', urlencode( 'Merriweather:400,300italic,300,400italic,700,700italic,900,900italic' ), "//fonts.googleapis.com/css" );
	return $font_url;
}

/**
 * Head Script.
 * Load style via "wp_head" hook, for non-supported browser
 * @link   https://github.com/scottjehl/Respond
 * @link   https://github.com/aFarkas/html5shiv
 * @since  0.1.0
 */
function tamatebako_head_script() {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$ie8_css = hybrid_locate_theme_file( array( "css/ie8{$suffix}.css", "css/ie8.css" ) );
	$ie9_css = hybrid_locate_theme_file( array( "css/ie9{$suffix}.css", "css/ie9.css" ) );
	$respond_js = hybrid_locate_theme_file( array( "js/respond{$suffix}.js", "js/respond.js" ) );
	$html5shiv_js = hybrid_locate_theme_file( array( "js/html5shiv{$suffix}.js", "js/html5shiv.js" ) );
?>
<?php if ( !empty( $ie8_css ) ) { ?>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $ie8_css; ?>" media="screen" />
<![endif]-->
<?php } ?>
<?php if ( !empty( $ie9_css ) ) { ?>
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo $ie9_css; ?>" media="screen" />
<![endif]-->
<?php } ?>
<?php if( !empty( $respond_js ) && !empty( $html5shiv_js ) ){ ?>
<!-- Enables media queries and html5 in some unsupported browsers. -->
<!--[if (lt IE 9) & (!IEMobile)]>
<?php if( !empty( $respond_js ) ){ ?>
<script type="text/javascript" src="<?php echo $respond_js; ?>"></script>
<?php } ?>
<?php if( !empty( $html5shiv_js ) ){ ?>
<script type="text/javascript" src="<?php echo $html5shiv_js; ?>"></script>
<?php } ?>
<![endif]-->
<?php } ?>
<?php
}

/**
 * Register and Enqueue JS
 * @since 0.1.0
 */
function tamatebako_enqueue_js(){
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$fitvids_js = hybrid_locate_theme_file( array( "js/fitvids{$suffix}.js", "js/fitvids.css" ) );
	$theme_js = hybrid_locate_theme_file( array( "js/theme{$suffix}.js", "js/theme.js" ) );

	if ( !empty( $fitvids_js ) ) wp_enqueue_script( 'theme-fitvids', $fitvids_js, array( 'jquery' ), '0.1.1', true );
	if ( !empty( $theme_js ) ) wp_enqueue_script( 'theme-js', $theme_js, array( 'jquery' ), tamatebako_theme_version(), true );
}

/**
 * Check JS Status
 * Modify no-js to js in body class.
 * @since 0.1.0
 */
function tamatebako_check_js_script(){
	$js_status = hybrid_locate_theme_file( array( "js/js-status.js" ) );
	$script = '';
	if( !empty( $js_status ) ) {
		$script = '<script src="' . $js_status . '" type="text/javascript"></script>';
	}
	return apply_filters( 'tamatebako_check_js_script', $script );
}

/**
 * Register CSS
 * @since 0.1.0
 */
function tamatebako_register_css(){

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$media_queries_css = hybrid_locate_theme_file( array( "media-queries{$suffix}.js", "media-queries.css" ) );

	/* Google Fonts: Open Sans / font-family: 'Open Sans', sans-serif; */
	wp_register_style( 'theme-open-sans-font', tamatebako_google_open_sans_font_url(), array(), tamatebako_theme_version(), 'all' );

	/* Google Fonts: Open Sans / font-family: 'Open Sans', sans-serif; */
	wp_register_style( 'theme-merriweather-font', tamatebako_google_merriweather_font_url(), array(), tamatebako_theme_version(), 'all' );

	/* Media Queries */
	wp_register_style( 'media-queries',$media_queries_css, array(), tamatebako_theme_version(), 'all' );
}


/* #06 - CONTEXT
******************************************/


/**
 * Add TinyMCE Body Class
 * @since  0.1.0
 */
function tamatebako_tinymce_body_class( $settings ){
	$classes = $settings['body_class'];
	$settings['body_class'] = $classes . ' entry-content';
	return $settings;
}

/**
 * Add Body Class
 * @since 0.1.0
 */
function tamatebako_body_class( $classes ){

	/* JS Status */
	$classes[] = 'no-js';

	/* Get all registered sidebars */
	global $wp_registered_sidebars;

	/* If not empty sidebar */
	if ( !empty( $wp_registered_sidebars ) ){

		/* Foreach widget areas */
		foreach ( $wp_registered_sidebars as $sidebar ){

			/* Add active/inactive class */
			$classes[] = is_active_sidebar( $sidebar['id'] ) ? "sidebar-{$sidebar['id']}-active" : "sidebar-{$sidebar['id']}-inactive";
		}
	}

	/* Get all registered menus */
	$menus = get_registered_nav_menus();

	/* If not empty menus */
	if ( !empty( $menus ) ){

		/* For each menus */
		foreach ( $menus as $menu_id => $menu ){

			/* Add active/inactive class */
			$classes[] = has_nav_menu( $menu_id ) ? "menu-{$menu_id}-active" : "menu-{$menu_id}-inactive";
		}
	}

	/* Mobile visitor class */
	if ( wp_is_mobile() ){
		$classes[] = 'wp-is-mobile';

		/* Visitor using Opera Mini browser: opera mini browser do not use custom fonts. */
		if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false ){
			$classes[] = 'wp-is-opera-mini';
		}
	}
	/* Non-mobile visitor/using desktop browser */
	else{
		$classes[] = 'wp-is-not-mobile';
	}

	/* Custom header */
	if ( current_theme_supports( 'custom-header' ) ){

		/* Header Image */
		if ( get_header_image() ) {
			$classes[] = 'custom-header-image';
		}
		else{
			$classes[] = 'custom-header-no-image';
		}
		/* Header Text */
		if ( display_header_text() ){
			$classes[] = 'custom-header-text';
		}
		else{
			$classes[] = 'custom-header-no-text';
		}
		/* Header Text Color */
		if ( get_header_textcolor() ) {
			$classes[] = 'custom-header-text-color';
		}
		else{
			$classes[] = 'custom-header-no-text-color';
		}
	}


	/* Make it unique */
	$classes = array_unique( $classes );

	return $classes;
}

/**
 * Widget Class
 * @since 0.1.0
 */
function tamatebako_widget_class( $params ) {

	/* Global a counter array */
	global $shell_widget_num;

	/* Get the id for the current sidebar we're processing */
	$this_id = $params[0]['id'];

	/* Get registered widgets */
	$arr_registered_widgets = wp_get_sidebars_widgets();

	/* If the counter array doesn't exist, create it */
	if ( !$shell_widget_num ) {
		$shell_widget_num = array();
	}

	/* if current sidebar has no widget, return. */
	if ( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) {
		return $params;
	}

	/* See if the counter array has an entry for this sidebar */
	if ( isset( $shell_widget_num[$this_id] ) ) {
		$shell_widget_num[$this_id] ++;
	}
	/* If not, create it starting with 1 */
	else {
		$shell_widget_num[$this_id] = 1;
	}

	/* Add a widget number class for additional styling options */
	$class = 'class="widget widget-' . $shell_widget_num[$this_id] . ' '; 

	/* in first widget, add 'widget-first' class */
	if ( $shell_widget_num[$this_id] == 1 ) {
		$class .= 'widget-first ';
	}
	/* in last widget, add 'widget-last' class */
	elseif( $shell_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) { 
		$class .= 'widget-last ';
	}

	/* str replace before_widget param with new class */
	$params[0]['before_widget'] = str_replace( 'class="widget ', $class, $params[0]['before_widget'] );

	return $params;
}


/* #07 - TEMPLATE FUNCTIONS
******************************************/


/**
 * Loads a post content template based off the post type and/or the post format.
 * @since  0.1.0
 */
function tamatebako_get_template( $dir ) {

	/* Filter Dir */
	$dir = apply_filters( 'tamatebako_get_template_dir', $dir );

	/* Set up an empty array and get the post type. */
	$templates = array();
	$post_type = get_post_type();

	/* Singular suffix. */
	$singular = '';
	if ( is_singular( $post_type ) ){
		$singular = '-singular';
	}

	/* Assume the theme developer is creating an attachment template. */
	if ( 'attachment' === $post_type ) {
		remove_filter( 'the_content', 'prepend_attachment' );

		$mime_type = get_post_mime_type();

		list( $type, $subtype ) = false !== strpos( $mime_type, '/' ) ? explode( '/', $mime_type ) : array( $mime_type, '' );

		$templates[] = "{$dir}/attachment-{$type}{$singular}.php";
		$templates[] = "{$dir}/attachment-{$type}.php";
	}

	/* If the post type supports 'post-formats', get the template based on the format. */
	if ( post_type_supports( $post_type, 'post-formats' ) ) {

		/* Get the post format. */
		$post_format = get_post_format() ? get_post_format() : 'standard';

		/* Template based off post type and post format. */
		$templates[] = "{$dir}/{$post_type}-{$post_format}{$singular}.php";
		$templates[] = "{$dir}/{$post_type}-{$post_format}.php";

		/* Template based off the post format. */
		$templates[] = "{$dir}/{$post_format}{$singular}.php";
		$templates[] = "{$dir}/{$post_format}.php";
	}

	/* Template based off the post type. */
	$templates[] = "{$dir}/{$post_type}{$singular}.php";
	$templates[] = "{$dir}/{$post_type}.php";

	/* Fallback 'content.php' template. */
	$templates[] = "{$dir}/content{$singular}.php";
	$templates[] = "{$dir}/content.php";

	/* Remove Duplicates. */
	$templates = array_unique( $templates );

	/* Apply filters and return the found content template. */
	include( locate_template( $templates, false, false ) );
}

/**
 * Get custom menu name by location
 * Helper function to get menu location and use it as mobile toggle.
 * @link http://wordpress.stackexchange.com/questions/45700
 * @since 0.1.0
 */
function tamatebako_get_menu_name( $location ){

	/* Get registered nav menu */
	$menus = get_registered_nav_menus();

	/* If no menu available, bail early */
	if ( empty( $menus ) ){
		return false;
	}

	/* Check if menu is set */
	if ( has_nav_menu( $location ) ){

		/* Get menu location */
		$locations = get_nav_menu_locations();

		/* If location not set, return false */
		if( ! isset( $locations[$location] ) ){
			return false;
		}

		/* Return menu name */
		$menu_obj = get_term( $locations[$location], 'nav_menu' );
		return $menu_obj->name;
	}
	return false;
}

/**
 * Check if menus is registered
 * @since 0.1.0
 */
function tamatebako_is_menu_registered( $location ){
	/* Get registered nav menu */
	$menus = get_registered_nav_menus();
	if ( empty( $menus ) ){
		return false;
	}
	elseif ( isset( $menus[$location] ) ){
		return true;
	}
	return false;
}

/**
 * Menu Toggle
 * @since 0.1.0
 */
function tamatebako_menu_toggle( $location ){
?>

<div id="menu-toggle-<?php echo $location; ?>" class="menu-toggle">
	<a class="menu-toggle-open" href="#menu-<?php echo $location; ?>"><span class="screen-reader-text"><?php echo tamatebako_get_menu_name( $location ); ?></span></a>
	<a class="menu-toggle-close" href="#menu-toggle-<?php echo $location?>"><span class="screen-reader-text"><?php echo tamatebako_get_menu_name( $location ); ?></span></a>
</div><!-- .menu-toggle -->

<?php
}

/**
 * Get Sidebar Name by ID
 * Helper function to get sidebar name by sidebar ID and use it as sidebar toggle.
 * @since 0.1.0
 */
function tamatebako_get_sidebar_name( $id ){

	/* Get registered sidebar */
	global $wp_registered_sidebars;

	/* If no sidebar registered, bail early */
	if ( empty( $wp_registered_sidebars ) ){
		return false;
	}

	/* Check if sidebar is set */
	if ( isset( $wp_registered_sidebars[$id] ) ){
		if( isset( $wp_registered_sidebars[$id]['name'] ) && !empty( $wp_registered_sidebars[$id]['name'] ) ){
			return $wp_registered_sidebars[$id]['name'];
		}
		return false;
	}

	return false;
}

/**
 * Entry Meta
 * a helper function to print all taxonomy/term attach to a post.
 * @since 0.1.0
 */
function tamatebako_entry_terms(){

	/* Entry Taxonomies */
	$entry_taxonomies = array();

	/* Get Taxonomies Object */
	$entry_taxonomies_obj = get_object_taxonomies( get_post_type(), 'object' );
	foreach ( $entry_taxonomies_obj as $entry_tax_id => $entry_tax_obj ){

		/* Only for public taxonomy */
		if ( 1 == $entry_tax_obj->public ){
			$entry_taxonomies[$entry_tax_id] = array(
				'taxonomy' => $entry_tax_id,
				'text' => $entry_tax_obj->labels->name,
			);
		}
	}

	/* If taxonomies not empty */
	if ( !empty( $entry_taxonomies ) ){ ?>
		<div class="entry-meta">
		<?php foreach ( $entry_taxonomies as $tax_id => $entry_tax ){ ?>
			<?php hybrid_post_terms( array( 'taxonomy' => $tax_id, 'text' => $entry_tax['text'] . ' %s' ) ); ?>
		<?php }//end foreach ?>
		</div>

	<?php } //end empty check
}

/**
 * Archive Title
 * @since 0.1.0
 */
function tamatebako_archive_header(){ ?>

	<?php if ( !is_front_page() && !is_singular() && !is_404() ){ ?>

		<header <?php hybrid_attr( 'loop-meta' ); ?>>

			<?php if ( hybrid_get_loop_title() ) { ?>
			<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php hybrid_loop_title(); ?></h1>
			<?php } // End title check. ?>

			<?php if ( $desc = hybrid_get_loop_description() ) { ?>
				<div <?php hybrid_attr( 'loop-description' ); ?>>
					<?php echo $desc; ?>
				</div><!-- .loop-description -->
			<?php } // End desc check. ?>

		</header><!-- .loop-meta -->

	<?php }  ?>

<?php
}

/**
 * Archive Footer (Pagination)
 * @since 0.1.0
 */
function tamatebako_archive_footer(){ ?>

	<?php if ( is_home() || is_archive() || is_search() ){ ?>

		<?php loop_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . tamatebako_string( 'previous' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . tamatebako_string( 'next' ) . '</span>',
			'end_size' => 3,
			'mid_size' => 3,
		)); ?>

	<?php } ?>

<?php
}

/**
 * Primary Menu Fallback Callback
 * used in "menu/primary.php"
 * @since 0.1.0
 */
function tamatebako_menu_fallback_cb(){
?>
<div class="wrap">
	<ul class="menu-items" id="menu-items">
		<li class="menu-item">
			<a rel="home" href="<?php echo home_url(); ?>">Home</a>
		</li>
	</ul>
</div>
<?php
}

/**
 * Navigation Search Form
 * used in "menu/primary.php"
 * @since 0.1.0.0
 */
function tamatebako_menu_search_form( $id = 'search-menu' ){
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label class="search-toggle" for="<?php echo esc_attr( $id ); ?>"></label>
	<input id="<?php echo esc_attr( $id ); ?>" type="search" class="search-field" placeholder="<?php echo tamatebako_string('search'); ?>" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else ''; ?>" name="s"/>
	<button class="search-submit button"><span><?php echo tamatebako_string('search-button'); ?></span></button>
</form>
<?php
}

/**
 * Next Previous Post (Loop Nav)
 * @since 0.1.0
 */
function tamatebako_entry_nav(){
?>
<div class="loop-nav">
	<?php previous_post_link( '<div class="prev"><span class="screen-reader-text">' . tamatebako_string( 'previous' ) . ':</span> %link</div>', '%title' ); ?>
	<?php next_post_link( '<div class="next"><span class="screen-reader-text">' . tamatebako_string( 'next' ) . ':</span> %link</div>', '%title' ); ?>
</div><!-- .loop-nav -->
<?php
}

/**
 * Content Error
 * used in "index.php"
 * @since 0.1.0
 */
function tamatebako_content_error(){
?>
<article <?php hybrid_attr( 'post' ); ?>>
	<div class="entry-wrap">

		<header class="entry-header">
			<h1 class="entry-title"><?php echo tamatebako_string( 'error' ); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php echo wpautop( tamatebako_string( 'error-msg' ) ); ?>
		</div><!-- .entry-content -->

	</div><!-- .entry-wrap -->
</article><!-- .entry -->
<?php
}

/**
 * Comments Nav
 * @since 0.1.0
 */
function tamatebako_comments_nav(){
?>
<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) { // Check for paged comments. ?>

	<div class="comments-nav">

		<?php previous_comments_link( '<span class="prev-comments"><span class="screen-reader-text">' . tamatebako_string( 'previous' ) . '</span></span>' ); ?>

		<span class="page-numbers"><?php printf( '%1$s / %2$s', get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() ); ?></span>

		<?php next_comments_link( '<span class="next-comments"><span class="screen-reader-text">' . tamatebako_string( 'next' ) . '</span></span>' ); ?>

	</div><!-- .comments-nav -->

<?php } // End check for paged comments. ?>
<?php
}

/**
 * Comments Error
 * used in "comments.php"
 * @since 0.1.0
 */
function tamatebako_comments_error(){
?>
<?php if ( pings_open() && !comments_open() ) { ?>

	<p class="comments-closed pings-open">
		<?php echo tamatebako_string( 'comments-closed-pings-open' ); ?>
	</p><!-- .comments-closed.pings-open -->

<?php } elseif ( !comments_open() ) { ?>

	<p class="comments-closed">
		<?php echo tamatebako_string( 'comments-closed' ); ?>
	</p><!-- .comments-closed -->

<?php } ?>
<?php
}

/**
 * Attachment
 * @since 0.1.0
 */
function tamatebako_attachment(){
	if ( wp_attachment_is_image( get_the_ID() ) ){
		tamatebako_attachment_image();
	}
	else{
		hybrid_attachment();
	}
}

/**
 * Attachment Image
 * 
 * 
 */
function tamatebako_attachment_image(){

	/* If image has excerpt / caption. */
	if ( has_excerpt() ) {

		/* Image URL */
		$src = wp_get_attachment_image_src( get_the_ID(), 'full' );
		/* Display image with caption */
		echo img_caption_shortcode( array( 'align' => 'aligncenter', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) );

	}
	/* No caption. */
	else {

		/* Display image without caption. */
		echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) );
	}
}


/* #08 - UTILLITY
******************************************/


/**
 * Set Layout
 * @param $new_layout string
 * @since 0.1.0
 */
function tamatebako_set_layout( $new_layout ){
	/* using anon function in PHP 5.3 */
	if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
		$filter_layout = function( $layout ) use( $new_layout ){
			return $new_layout;
		};
		add_filter( 'theme_mod_theme_layout', $filter_layout );
	}
}

/**
 * Set Template Dir
 * @param $old_dir string
 * @param $new_dir string
 * @since 0.1.0
 */
function tamatebako_set_template_dir( $new_dir, $old_dir ){
	/* using anon function in PHP 5.3 */
	if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
		$filter_dir = function( $dir ) use( $new_dir, $old_dir ){
			if ( $dir == $old_dir ){
				return $new_dir;
			}
			return $dir;
		};
		add_filter( 'tamatebako_get_template_dir', $filter_dir );
	}
}

/**
 * Add Body Class
 * @param $new_classes array
 * @since 0.1.0
 */
function tamatebako_add_body_class( $new_classes ){
	/* using anon function in PHP 5.3 */
	if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
		$add_classes = function( $classes ) use( $new_classes ){
			foreach( $new_classes as $new_class ){
				$classes[] = $new_class;
			}
			$classes = array_unique( $classes );
			return $classes;
		};
		add_filter( 'body_class', $add_classes );
	}
}


/* #09 - REGISTER THEME SUPPORT
******************************************/


/* Hook to theme setup */
add_action( 'after_setup_theme', 'tamatebako_register_theme_support', 20 );

/**
 * Register Theme Elements
 * @since 0.1.0
 */
function tamatebako_register_theme_support(){

	/* Register Sidebars */
	add_action( 'widgets_init', 'tamatebako_register_sidebars' );

	/* Register Menus */
	add_action( 'init', 'tamatebako_register_menus' );

	/* Customize Mobile View */
	if ( current_theme_supports( 'tamatebako-customize-mobile-view' ) ){
		add_action( 'customize_controls_print_footer_scripts', 'tamatebako_customize_mobile_view_script' );
		add_action( 'customize_controls_print_styles', 'tamatebako_customize_mobile_view_style' );
	}
}

/**
 * Register Sidebars
 * @since 0.1.0
 */
function tamatebako_register_sidebars(){

	/* Get theme-supported sidebars. */
	$sidebars = get_theme_support( 'tamatebako-sidebars' );

	/* No Support, Return */
	if ( !is_array( $sidebars[0] ) ){
		return;
	}

	/* Foreach sidebar, register it */
	foreach( $sidebars[0] as $sidebar_id => $sidebar_arg ){
		hybrid_register_sidebar(
			array(
				'id'          => $sidebar_id,
				'name'        => $sidebar_arg['name'],
				'description' => $sidebar_arg['description']
			)
		);
	}
}

/**
 * Register Menus
 * @since 0.1.0
 */
function tamatebako_register_menus(){

	/* Get theme-supported sidebars. */
	$menus = get_theme_support( 'tamatebako-menus' );

	/* No Support, Return */
	if ( !is_array( $menus[0] ) ){
		return;
	}

	/* Register it */
	register_nav_menus( $menus[0] );
}


/**
 * Load mobile preview toggle icon
 * @since 0.1.0
 */
function tamatebako_customize_mobile_view_script(){
?>
<div id="devices">
	<div class="devices-container">
		<span id="desktop-preview" title="Desktop" class="current"></span>
		<span id="tablet-preview" title="Tablet" class=""></span>
		<span id="mobile-preview" title="Mobile" class=""></span>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	$( "#tablet-preview" ).click(function(e){
		e.preventDefault();
		$( '#customize-preview' ).removeClass( "desktop tablet mobile" ).addClass( 'tablet' );
		$( '.devices-container span' ).removeClass();
		$( '#tablet-preview' ).addClass('current');
	});
	$( "#mobile-preview" ).click(function(e){
		e.preventDefault();
		$( '#customize-preview' ).removeClass( "desktop tablet mobile" ).addClass( 'mobile' );
		$( '.devices-container span' ).removeClass();
		$( '#mobile-preview' ).addClass( 'current' );
	});
	$( "#desktop-preview" ).click(function(e){
		e.preventDefault();
		$( '#customize-preview' ).removeClass( "desktop tablet mobile" );
		$( '.devices-container span' ).removeClass();
		$( '#desktop-preview' ).addClass( 'current' );
	});
});
</script>
<?php
}

/**
 * Add custom stylesheet to customizer
 * @since 0.1.0
 */
function tamatebako_customize_mobile_view_style(){
/* Hide theme information */ ?>
<style id="tamatebako-customize-mobile-view">
/* Preview */
#customize-preview{
	text-align: center;
}
#customize-preview iframe{
	display: block;
	margin: 0 auto;
}
#customize-preview.desktop iframe{
	width: 100%;
}
#customize-preview.tablet iframe{
	max-width: 783px;
}
#customize-preview.mobile iframe{
	max-width: 335px;
}
/* Control */
#devices{
	margin-left:-75px;
	position:absolute;
	bottom:20px;
	left:50%;
	z-index:1000000;
	width:150px;
}
#devices .devices-container{
	background:rgba(0,0,0,0.8);
	border-radius:3px;
	margin:0 auto;
	padding:10px 10px 5px;
	text-align:center;
	width:130px;
}
#devices span{
	cursor:pointer;
}
#devices span:before{
	display:inline-block;
	font:normal 30px/1 'dashicons';
	margin:0 5px;
	color:#777;
	position:relative;
	speak:none;
	-webkit-font-smoothing:antialiased;
	cursor:pointer;
}
#devices span:hover:before{
	color:#2ea2cc;
}
#devices #desktop-preview:before{
	content:"\f472";
}
#devices #tablet-preview:before{
	content:"\f471";
}
#devices #mobile-preview:before{
	content:"\f470";
}
#devices .current:before,
#devices .current:hover:before{
	color:#fff;
}
#customize-preview.desktop,
#customize-preview.tablet,
#customize-preview.mobile{
	background:#555;
}
</style>
<?php
}


/* #10 - DEBUG
******************************************/

/* Hook to theme setup */
add_action( 'after_setup_theme', 'tamatebako_theme_debug_setup', 20 );


/**
 * Debug Setup Function
 * @since 0.1.0
 */
function tamatebako_theme_debug_setup(){

	$debug = get_theme_support( 'tamatebako-debug' );

	if ( isset( $debug[0] ) ){
		$test = $debug[0];

		/* add "wp-is-mobile" body class  */
		if ( isset( $test['mobile'] ) && $test['mobile'] ){
			add_filter( 'body_class', 'tamatebako_debug_mobile_body_class' );
		}

		/* "js-disabled": dequeue theme.js script */
		if ( isset( $test['no-js'] ) && $test['no-js'] ){
			add_filter( 'tamatebako_check_js_script', '__return_false' );
			remove_action( 'wp_enqueue_scripts', 'hybrid_enqueue_scripts', 5 );
			remove_action( 'wp_enqueue_scripts', 'tamatebako_enqueue_js' );
			add_action( 'wp_print_scripts', 'tamatebako_debug_no_js' );
		}

		/* display media queries width */
		if ( isset( $test['media-queries'] ) && $test['media-queries'] ){
			add_action( 'wp_enqueue_scripts', 'tamatebako_debug_enqueue_media_queries', 20 );
		}
	}
}

/**
 * Debug Mobile Body Class
 * @since 0.1.0
 */
function tamatebako_debug_mobile_body_class( $classes ){
	$classes[] = 'wp-is-mobile';
	return $classes;
}

/**
 * Debug No JS
 * @since 0.1.0
 */
function tamatebako_debug_no_js(){
	if ( !is_admin() ){
		wp_dequeue_script( 'jquery' );
	}
}

/**
 * Enqueue Media Queries Debug CSS
 * @since 0.1.0
 */
function tamatebako_debug_enqueue_media_queries(){
	wp_enqueue_style( 'debug-media-queries', trailingslashit( get_template_directory_uri() ) . 'css/debug-media-queries.css', array(), tamatebako_theme_version(), 'all' );
}

/**
 * Pretty Debug Data
 * @link http://chrisbratlien.com/prettier-php-debug-messages-continued/
 */
function tmdd( $obj, $label = '' ) {  

	$data = json_encode(print_r($obj,true));
	?>
	<style type="text/css">
		#bsdLogger {
			position: inherit;
			bottom:0;
			border: 3px solid #ffa601;
			padding: 6px;
			background: white;
			color: #444;
			z-index: 999;
			font-size: 1.25em;
			width: 980px;
			overflow: scroll;
			margin: 50px auto 0 auto;
		}
	</style>    
	<script type="text/javascript">
	var doStuff = function(){
		var obj = <?php echo $data; ?>;
		var logger = document.getElementById('bsdLogger');
		if (!logger) {
			logger = document.createElement('div');
			logger.id = 'bsdLogger';
			document.body.appendChild(logger);
		}
		////console.log(obj);
		var pre = document.createElement('pre');
		var h2 = document.createElement('h2');
		pre.innerHTML = obj;

		h2.innerHTML = '<?php echo addslashes($label); ?>';
		logger.appendChild(h2);
		logger.appendChild(pre);      
	};
	window.addEventListener ("DOMContentLoaded", doStuff, false);
	</script>
	<?php
}
