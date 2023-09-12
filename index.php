<?php get_header(); ?>

	<?php 
		$feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
		$image_alt = get_post_meta((get_post_thumbnail_id($post->ID)), '_wp_attachment_image_alt', TRUE);
		if($feat_image!='' ){
	?>
	<img alt="<?php echo $image_alt ?>" src=' <?php echo $feat_image ?>'>
	<?php } ?>

	<?php if ( is_home() || is_front_page() ){
		the_content();
		}else{
			?><section>
				<?php the_content(); ?>
			</section>
		<?php }?>

	

<?php get_footer(); ?>