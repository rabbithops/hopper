<?php get_header(); ?>

    <?php if (!post_password_required()): ?>

        <?php if (have_posts()): ?>

            <?php while (have_posts()): the_post(); ?>

                <?php if (have_rows('layouts')): ?>
                    <div class="core container">
                        <header class="entry-header" role="banner">
                            <h1><?php the_title(); ?></h1>
                        </header>

                    	<?php the_content(); ?>
                     </div>
                    <?php while (have_rows('layouts')): the_row(); ?>

                        <?php
                        $layout = get_row_layout();
                        get_template_part("layouts/{$layout}"); ?>

                    <?php endwhile; ?>

                <?php else: ?>

                    <?php get_template_part('parts/content', get_post_type()); ?>

                <?php endif; ?>

            <?php endwhile; ?>

        <?php endif; ?>

    <?php else: // post_password_required() ?>

        <?php get_template_part('parts/content-protected'); ?>

    <?php endif; // !post_password_required() ?>

<?php get_footer(); ?>