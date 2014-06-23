<?php
/**
 * Template Name: Landing Page
 */
?>

<?php
$layout = 'content';
//$layout = 'content-sidebar1';
tamatebako_set_layout( $layout );
//tamatebako_set_template_dir( "content-grid", "content" );
//tamatebako_add_body_class( array( "mobile-menu-active" ) );
?>

<?php get_header(); ?>

<div id="container">

	<?php get_template_part( 'site-header' ); ?>

	<header id="landing-page-header">

		<h1 id="landing-page-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h1>

		<div id="landing-page-description">
			<?php echo wpautop( get_post_field( 'post_excerpt', get_queried_object_id() ) ); ?>
		</div>

	</header>

	<div id="main">

		<div class="main-inner">

			<div class="main-wrap">

				<?php //hybrid_get_sidebar( 'primary' ); ?>

				<main <?php hybrid_attr( 'content' ); ?>>

					<?php if ( have_posts() ){ /* Posts Found */ ?>

						<div class="content-entry-wrap">

							<?php while ( have_posts() ) {  /* Start Loop */ ?>

								<?php the_post(); /* Load Post Data */ ?>

								<?php /* Start Content */ ?>
								<article <?php hybrid_attr( 'post' ); ?>>
									<div class="entry-wrap">

										<div <?php hybrid_attr( 'entry-content' ); ?>>
											<?php the_content(); ?>
										</div><!-- .entry-content -->

									</div><!-- .entry-wrap -->
								</article><!-- .entry -->
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
