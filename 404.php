<?php get_header(); ?>
<!-- content START -->
<section class="error-block">
	<div>
		<div>
			<h2>Error 404!</h2>
			<p>Threads are Tied! Search for other keywords to find your results. </p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			<br>
			<p>OR</p>
			<a class="btn btn--primary" href="/index.php">Homepage</a>
		</div>
	</div>
</section>
<!-- content END -->

<?php get_footer(); ?>