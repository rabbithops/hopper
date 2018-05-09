<?php get_header(); ?>

    <?php if (have_posts()): ?>

        <h1>Search Results for '<?php echo get_search_query(); ?>'</h1>

        <?php while (have_posts() ): the_post(); ?>

            <?php get_template_part('parts/content' , 'search'); ?>

        <?php endwhile; ?>

    <?php else: ?>

        <?php get_template_part('parts/content', 'none'); ?>

    <?php endif; ?>

	<?php if (function_exists('hopper_pagination')) hopper_pagination(); ?>

<?php get_footer(); ?>