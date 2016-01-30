<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<div class="entry-header">

			<div class="entry-byline">
				<span class="entry-author vcard"><?php the_author_posts_link(); ?></span>
				<?php tamatebako_entry_date(); ?>
			</div><!-- .entry-byline -->

			<?php tamatebako_entry_title(); ?>

		</div><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php chelonian_read_more(); ?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php tamatebako_entry_taxonomies(); ?>
		</div><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->
