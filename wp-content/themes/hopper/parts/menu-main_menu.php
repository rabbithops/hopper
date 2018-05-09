<section class="site-header">
<?php if (has_nav_menu('main_nav')): ?>
    <nav id="main-nav" class="main-nav" role="navigation" aria-label="Primary Navigation">
        <?php wp_nav_menu(array(
            'theme_location'  => 'main_nav',
            'container'       => 'div',
            'container_class' => 'main-menu-wrapper',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'menu_class'      => 'main-menu group',
            'menu_id'         => 'main-menu',
            'depth'           => 0,
            'walker'          => new Hopper_Main_Nav_Walker
        )); ?>

        <button id="main-menu-toggle" class="main-menu-toggle">
            <div class="menu-text">Menu</div>
            <span class="text">toggle menu</span>
        </button>
    </nav>
</section>

<?php endif; ?>