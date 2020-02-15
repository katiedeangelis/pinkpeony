<?php
/**
 * The template used for displaying testimonials.
 *
 * @package PinkPeony
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="testimonial-thumbnail">
				<?php the_post_thumbnail( 'pinkpeony-testimonial-thumbnail' ); ?>
			</div>
		<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'pinkpeony' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	?>
</article><!-- #post-## -->
