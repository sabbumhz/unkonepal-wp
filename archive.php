<?php get_header(); ?>

<!-- content START -->
<?php is_tag(); ?>
	<section>
		<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2>Archive for <?php the_time('F, Y'); ?></h2>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2>Archive for <?php the_time('Y'); ?></h2>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2>Author Archive</h2>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2>Blog Archives</h2>
				<?php } ?>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

		<ul class="search-listing">
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<?php 
						$image_alt = get_post_meta((get_post_thumbnail_id($post->ID)), '_wp_attachment_image_alt', TRUE);
						$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
						if($feat_image!='' ){?>
						<figure>
							<img alt="<?php echo $image_alt ?> src=' <?php echo $feat_image ?>'>
						</figure>
						<?php }
					?>
					<div>
						<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php  if(the_excerpt()!='' ) { ?><p><?php the_excerpt(); ?></p> <?php }?>
					</div>
				</li>

			<?php endwhile; ?>
		</ul>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	</section>

<?php else : ?>

<section class="error-block">
	<div>
		<div>
			<h2>No Results Found!</h2>
			<p>Threads are Tied! Search for other keywords to find your results. </p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		</div>
	</div>
</section>

<?php endif; ?>
<!-- content END -->

<?php get_footer(); ?>
