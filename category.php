<?php get_header(); ?>

<!-- content START -->
<div id="content">
	 <h1><?php single_cat_title(); ?></h1>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></p>
				<?php the_excerpt('Read the rest of this entry &raquo;'); ?>
				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</article>

	<?php endwhile; ?>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>
		<article>
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		</article>
	<?php endif; ?>
</div>
<!-- content END -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
