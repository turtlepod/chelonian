<?php
//$layout = 'content';
//$layout = 'content-sidebar1';
//tamatebako_set_layout( $layout );
//tamatebako_set_template_dir( "content-grid", "content" );
//tamatebako_add_body_class( array( "mobile-menu-active" ) );
?>

<?php get_header(); ?>

<div id="container">

	<?php get_template_part( 'site-header' ); ?>

	<div id="main">

		<div class="main-inner">

			<div class="main-wrap">

				<?php //hybrid_get_sidebar( 'primary' ); ?>

				<main <?php hybrid_attr( 'content' ); ?>>

					<?php if ( have_posts() ){ /* Posts Found */ ?>

						<?php tamatebako_archive_header(); ?>

						<div class="content-entry-wrap">

							<?php while ( have_posts() ) {  /* Start Loop */ ?>

								<?php the_post(); /* Load Post Data */ ?>

								<?php /* Start Content */ ?>
								<?php tamatebako_get_template( 'content' ); // Loads the content/*.php template. ?>
								<?php /* End Content */ ?>

							<?php } /* End Loop */ ?>

						</div><!-- .content-entry-wrap-->

						<?php tamatebako_archive_footer(); ?>

					<?php } else { /* No Posts Found */ ?>

						<?php tamatebako_content_error(); ?>

					<?php } /* End Posts Found Check */ ?>

				</main><!-- #content -->

				<?php hybrid_get_sidebar( 'primary' ); ?>

			</div><!-- .main-wrap -->

		</div><!-- .main-inner -->

	</div><!-- #main -->

	<?php get_template_part( 'site-footer' ); ?>

</div><!-- #container -->

<?php get_footer(); // Loads the footer.php template. ?>