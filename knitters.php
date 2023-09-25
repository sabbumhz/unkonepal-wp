<?php
/*Template Name: Knitters*/
get_header(); ?>
<section>
    <h2><?php the_title(); ?></h2>
    <ul class="knitters-list">
    <?php
        query_posts(array(
        'post_type' => 'knitters'
        )); ?>
        <?php
        while (have_posts()) : the_post(); ?>
        <li>
            <?php
                $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                $image_alt = get_post_meta((get_post_thumbnail_id($post->ID)), '_wp_attachment_image_alt', TRUE);
                if($feat_image!='' ){?>
                <figure>
                    <img alt="<?php echo $image_alt ?>" src=' <?php echo $feat_image ?>'>
                </figure>
                <?php }
            ?>
            <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
            <p>
            <?php the_field('knitters_designation') ?>
            </p>
            <a href="<?php the_permalink() ?>" class="btn btn--underline p-sm">See Full Profile</a>
        </li>
        <?php endwhile;
    ?>
    </ul>
	<section>
<?php get_footer(); ?>