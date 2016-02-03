<?php
/**
 * Chelonian Template Functions
**/

/**
 * Menu Fallback Callback
 * @since 2.0.1
 */
function chelonian_menu_fallback_cb(){
?>
<div class="wrap">
	<ul class="menu-items" id="menu-items">
		<li class="menu-item">
			<a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><span class="menu-item-wrap"><?php _ex( 'Home', 'default menu', 'chelonian' ); ?></span></a>
		</li>
	</ul>
</div>
<?php
}

/**
 * Read More
 * @since 2.0.0
 */
function chelonian_read_more(){
	$title = the_title_attribute( array( 'echo' => 0 ) );
	$text = _x( 'Read more&hellip;', 'read more', 'chelonian' );
	$url = get_permalink( get_the_ID() );
	$link = '<a href="' . $url . '" title="' . $title . '">' . $text . '</a>';
	comments_popup_link( $text, number_format_i18n( 1 ) . ' ' . _x( 'Comment', 'read more', 'chelonian' ), '%' . ' ' . _x( 'Comments', 'read more', 'chelonian' ), 'comments-link', $link );
}

