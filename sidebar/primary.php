<?php
if ( strpos( get_theme_mod( 'theme_layout' ),'sidebar1' ) === false) {
	return false;
}
?>

<div id="sidebar-primary-wrap">

	<aside class="sidebar" id="sidebar-primary">

		<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

			<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

		<?php else : // If the sidebar has no widgets. ?>

			<?php the_widget( 'WP_Widget_Recent_Posts',
				array(
					'number' => 5,
					'show_date' => 1,
				),
				array(
					'before_widget' => '<section class="widget widget_recent_entries">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title">',
					'after_title'   => '</div>'
				)
			); ?>

			<?php the_widget( 'WP_Widget_Categories',
				array(
					'count' => 1,
					'hierarchical' => 1,
					'dropdown' => 1,
				),
				array(
					'before_widget' => '<section class="widget widget_recent_entries">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title">',
					'after_title'   => '</div>'
				)
			); ?>

			<?php the_widget( 'WP_Widget_Tag_Cloud', array(),
				array(
					'before_widget' => '<section class="widget widget_tag_cloud">',
					'after_widget'  => '</section>',
					'before_title'  => '<div class="widget-title">',
					'after_title'   => '</div>'
				)
			); ?>

		<?php endif; // End widgets check. ?>

	</aside><!-- #sidebar-primary -->

</div>