<?php get_header(); ?><!-- content START --><div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article>
			<h2><?php the_title(); ?></h2>
			<?php
				the_content();

				wp_link_pages('before=<div class="pagination">'. __( '<span class="page-numbers page">Page</span>' ).'&after=</div>');

				the_post_navigation(
					$args = array(
						'prev_text' => __('previous <strong>%title</strong>', 'theming00'),
    					'next_text' => __('next <strong>%title</strong>', 'theming00'),
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		</article>

	<?php endwhile; else: ?>
		<article>			<h2>Not Found</h2>			<p>Sorry, but you are looking for something that isn't here.</p>			<?php include (TEMPLATEPATH . "/searchform.php"); ?>		</article>
	<?php endif; ?></div><!-- content END -->

<?php get_footer(); ?>