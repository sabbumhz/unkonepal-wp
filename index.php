<?php get_header(); ?>

<main>
	<img src="images/banner.jpg" alt="woolen unfinished piece with knit kit">

	<!-- product listing section -->
	<section>
		<h2>Shop Our New Creations</h2>
		<ul class="product-list">
			<li>
				<a href="./pages/product-detail.html">
					<figure>
						<img src="/images/cami.jpg"
								alt="Elephant at sunset">
						<div class="variation-color">
							<span class="color-chestnut">color-chestnut</span>
							<span class="color-lava">color-lava</span>
						</div>
					</figure>
					<h4>Cable Knit Rib Hem Crop Cami Top</h4>
					<p>Rs 2500</p>
				</a>
			</li>
			<li>
				<a href="./pages/product-detail.html">
					<figure>
						<img src="/images/cami.jpg"
								alt="Elephant at sunset">
						<div class="variation-color">
							<span class="color-chestnut">color-chestnut</span>
						</div>
					</figure>
					<h4>Cable Knit Rib Hem Crop Cami Top</h4>
					<p>Rs 2500</p>
				</a>
			</li>
			<li>
				<a href="./pages/product-detail.html">
					<figure>
						<img src="/images/cami.jpg"
								alt="Elephant at sunset">
						<div class="variation-color">
							<span class="color-chestnut">color-chestnut</span>
							<span class="color-lava">color-lava</span>
						</div>
					</figure>
					<h4>Cable Knit Rib Hem Crop Cami Top</h4>
					<p>Rs 2500</p>
				</a>
			</li>
		</ul>
		<div>
			<a class="btn btn--underline" href="/collection.html"> Shop All </a>
		</div>
	</section>
	<!-- product listing section end -->

	<!-- block section -->
	<section class="section-blocks section-blocks--reverse">
		<img src="/images/women-knit.jpg" alt="women sitting and knitting">
		<div>
			<h2>Never heard of Us!<br>
				Who are we?</h2>
			<p>We infuse our handmade products with love, care, time, and skill, bringing forth something unique and special from the depths of our passion.</p>
			<a class="btn btn--primary" href="/pages/about.html">About Us</a>
		</div>
	</section>
	<!-- block section end -->

	<!-- collection section start -->
	<section>
		<ul class="collection-list">
			<li>
				<img src="images/collection-1.jpg">
				<a class="btn btn--underline" href="/collection.html"> Shop All Knit Items </a>
			</li>
			<li>
				<img src="images/collection-2.jpg">
				<a class="btn btn--underline" href="/collection.html"> Shop All Crochet Items </a>
			</li>
		</ul>
	</section>
	<!-- collection  section end -->

	<!-- block section -->
	<section class="section-blocks">
		<img src="/images/women-togather.jpg" alt="two women smiling & knitting">
		<div>
			<h2>Know Our Stories Behind Our Creation</h2>
			<p>We infuse our handmade products with love, care, time, and skill, bringing forth something unique and special from the depths of our passion.</p>
			<a class="btn btn--primary" href="/stories.html">Goto Stories</a>
		</div>
	</section>
	<!-- block section end -->
</main>

<!-- content START -->
<div id="content">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></p>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
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

<?php get_footer(); ?>