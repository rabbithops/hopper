<?php get_header(); ?>

    <?php if (have_posts()): ?>

        <?php if (is_month()): ?>
            <h1><?php echo get_the_date('F Y'); ?></h1>
        <?php elseif (is_year()): ?>
            <h1><?php echo get_the_date('Y'); ?></h1>
        <?php else: ?>
            <h1>Archive</h1>
        <?php endif; ?>

        <?php while (have_posts() ): the_post(); ?>

            <?php get_template_part('parts/content', get_post_type()); ?>

        <?php endwhile; ?>

    <?php else: ?>

        <?php get_template_part('parts/content', 'none'); ?>

    <?php endif; ?>

    <?php if (function_exists('hopper_pagination')) hopper_pagination(); ?>

<?php get_footer(); ?>