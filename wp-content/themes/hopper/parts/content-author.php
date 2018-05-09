<article>
	<header class="entry-header">
	    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>
    <div class="entry-meta">
        <div class="avatar"><?php echo get_avatar(get_the_author_meta('ID'), 32); ?></div>
        <div class="author"><?php the_author() ; ?></div>
        <div class="categories"><?php echo get_the_category_list(', '); ?></div>
    </div>
    <div class="entry-excerpt entry">
        <?php
        if (has_excerpt()) {
            the_excerpt();
        } else {
            smart_excerpt(200);
        }
        ?>
    </div>
</article>
