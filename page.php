<?php get_header(); ?>

<main>
	<?php 
		$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
		if($feat_image!='' ){
	?>
	<img src=' <?php echo $feat_image ?>'>
	<?php } ?>
	<section>
		<?php the_content(); ?>
	<section>
</main>

<?php get_footer(); ?>