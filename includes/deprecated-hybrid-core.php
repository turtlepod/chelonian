<?php
/**
 * Deprecated Hybrid Core Functions
 * @since 2.0.0
**/

/**
 * Hybrid ATTR
 */
function hybrid_attr( $name, $context ){
	if( 'body' == $name ){
		body_class();
	}
	else if( 'header' == $name ){
		echo 'role="banner" id="header"';
	}
	else if( 'menu' == $name ){
		if( 'primary' == $context ){
			echo 'role="navigation" class="menu" id="menu-primary"';
		}
	}
	else if( 'content' == $name ){
		echo 'class="content" id="content"';
	}
	else if( 'footer' == $name ){
		echo 'id="footer"';
	}
	else if( 'post' == $name ){
		?>id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php
	}
	else if( 'entry-author' == $name ){
		echo 'class="entry-author vcard"';
	}
	else if( 'entry-published' == $name ){
		echo 'class="entry-published"';
	}
	else if( 'entry-title' == $name ){
		echo 'class="entry-title"';
	}
	else if( 'entry-summary' == $name ){
		echo 'class="entry-summary"';
	}
}


/**
 * Site Title
 */
function hybrid_site_title(){
	if( is_front_page() ){ ?>
		<h1 id="site-title"><a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<?php } else { ?>
		<p id="site-title"><a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
	<?php }
}

/**
 * Get Menu
 */
function hybrid_get_menu( $name ){
	get_template_part( 'menu/' . $name );
}

/**
 * Get Sidebar
 */
function hybrid_get_sidebar( $name ){
	tamatebako_get_sidebar( $name );
}

/**
 * Site Link
 */
function hybrid_get_site_link(){
	return '<a rel="home" href="' . esc_url( home_url() ) . '" class="site-link">' . get_bloginfo( 'name' )  . '</a>';
}





































