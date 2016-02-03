<nav role="navigation" class="menu" id="menu-primary">

	<div class="menu-container">

		<?php 
		/* Display menu only if the location is registered */
		if ( tamatebako_is_menu_registered( 'primary' ) ){
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'       => '',
					//'depth'           => 1,
					'menu_id'         => 'menu-primary-items',
					'menu_class'      => 'menu-items',
					'fallback_cb'     => 'chelonian_menu_fallback_cb',
					'items_wrap'      => '<div class="wrap"><ul id="%s" class="%s">%s</ul></div>',
					'link_before'     => '<span class="menu-item-wrap">',
					'link_after'      => '</span>',
				)
			);
			
		}
		else{
			chelonian_menu_fallback_cb();
		}
		?>

	</div><!-- .menu-container -->

</nav><!-- #menu-primary -->