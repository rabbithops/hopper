<?php get_header(); ?>

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <article>
            <?php
            $attachment_id = $post->ID;
            $image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); ?>
            <a href="<?php echo $image_attributes[0]; ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a>
        </article>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
