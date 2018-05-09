<?php get_header(); ?>

    <?php if (have_posts()) : the_post(); ?>

        <h1><?php echo get_the_author(); ?></h1>

        <?php if (get_the_author_meta('description')): ?>

            <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
            <h3>About <?php echo get_the_author() ; ?></h3>
            <?php the_author_meta('description'); ?>

        <?php endif; ?>

        <?php rewind_posts(); while (have_posts()): the_post(); ?>

        <?php get_template_part('parts/content', 'author'); ?>

        <?php endwhile; ?>

    <?php else: ?>

        <?php get_template_part('parts/content', 'none'); ?>

    <?php endif; ?>

    <?php if (function_exists('hopper_pagination')) hopper_pagination(); ?>

<?php get_footer(); ?>