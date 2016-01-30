<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<header class="entry-header">

			<div class="entry-byline">
				<span class="entry-author vcard"><?php the_author_posts_link(); ?></span>
				<?php tamatebako_entry_date(); ?>
			</div><!-- .entry-byline -->

			<?php tamatebako_entry_title(); ?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_taxonomies(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->

<?php tamatebako_entry_nav(); ?>

<?php comments_template( '', true ); // Load comments. ?>