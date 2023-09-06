<?php get_header(); ?>

<!-- content START -->
<?php if (have_posts()) : ?>
	<section>
		<h2>Search Results</h2>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

		<ul class="search-listing">
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<?php 
						$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
						if($feat_image!='' ){?>
						<figure>
							<img src=' <?php echo $feat_image ?>'>
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