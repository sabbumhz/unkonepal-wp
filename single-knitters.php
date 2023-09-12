<?php
get_header();
?>
<section>
    <?php 
        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
        $image_alt = get_post_meta((get_post_thumbnail_id($post->ID)), '_wp_attachment_image_alt', TRUE);
        if($feat_image!='' ){?>
        <figure>
            <img alt="<?php echo $image_alt ?>"  src=' <?php echo $feat_image ?>'>
        </figure>
        <?php } ?>
        <div>
            <h2><?php the_title(); ?></h2>
            <p> 
            <?php the_field('knitters_designation') ?><br>
            Experience : <?php the_field('knitters_experience') ?>
            </p>
            <p><?php the_content();?></p>
        </div>
</section>
<?php
get_footer();
?>