<?php get_header(); ?>

    <?php if (!post_password_required()): ?>

        <?php if (have_posts()): while (have_posts()): the_post(); ?>

            <?php get_template_part('parts/content', get_post_type()); ?>

            <?php comments_template('', true); ?>

        <?php endwhile; endif; ?>

    <?php else: // post_password_required() ?>

        <?php get_template_part('parts/content-protected'); ?>

    <?php endif; // !post_password_required() ?>

<?php get_footer(); ?>