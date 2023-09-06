<?php get_header(); ?>

	<?php 
		$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
		if($feat_image!='' ){
	?>
	<img src=' <?php echo $feat_image ?>'>
	<?php } ?>

	<?php if ( is_home() || is_front_page() ){
		the_content();
		}else{
			?><section>
				<?php the_content(); ?>
			</section>
		<?php }?>

	

<?php get_footer(); ?>