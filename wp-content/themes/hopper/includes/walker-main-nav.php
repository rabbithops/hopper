<?php

/**
 * Main navigation walker
 */

class Hopper_Main_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {

        $level = $depth + 1;
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu sub-menu-level-$level\" role=\"menu\" aria-hidden=\"true\">\n";

    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $default_classes = empty($item->classes) ? array () : (array) $item->classes;

        $custom_classes = (array)get_post_meta($item->ID, '_menu_item_classes', true);

        // Global class for all items
        $custom_classes[] = 'menu-item';

        // Now with 100% more accessibility!
        $aria_attr[] = 'role="menuitem"';

        // Is this a top-level menu item?
        if ($depth == 0) {
            $custom_classes[] = 'menu-item-top-level';
        }

        // Does this menu item have children?
        if (in_array('menu-item-has-children', $default_classes)) {
            $custom_classes[] = 'menu-item-has-children';
            $aria_attr[] = 'aria-haspopup="true"';
        }

        // Is this menu item active? (Top level only)
        $active_classes = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_item', 'current-page-parent', 'current-page-ancestor');
        if ($depth == 0 && array_intersect($default_classes, $active_classes)) {
            $custom_classes[] = 'menu-item-active';
        }

        // Give menu item a class based on its level/depth
        $level = $depth + 1;
        if ($depth > 0) {
            $custom_classes[] = "menu-item-level-$level";
        }

        $classes = join(' ', $custom_classes);
        $aria = join(' ', $aria_attr);

        !empty($classes)
            and $classes = ' class="'. trim(esc_attr($classes)) . '"';

        $output .= "<li $classes $aria>";

        $attributes  = '';

        !empty($item->attr_title)
            and $attributes .= ' title="'  . esc_attr($item->attr_title) .'"';
        !empty($item->target)
            and $attributes .= ' target="' . esc_attr($item->target    ) .'"';
        !empty($item->xfn)
            and $attributes .= ' rel="'    . esc_attr($item->xfn       ) .'"';
        !empty($item->url)
            and $attributes .= ' href="'   . esc_attr($item->url       ) .'"';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before
            . "<a class='menu-item-link' $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $args->after;

        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );

        // Add arrow icon if this item has children
        if (in_array('menu-item-has-children', $default_classes)) {
            $output .= "<button class='sub-menu-toggle' aria-label='Toggle Sub-menu Item' aria-expanded='false'>";
            $output .= "<svg class='icon' width='44px' height='44px' viewBox='0 0 44 44' version='1.1'><path class='icon-path' d='M35.9 22 C35.9 23 35.5 23.8 34.9 24.6 L16.4 43 C15.7 43.7 14.9 44 13.9 44 C12.9 44 12.1 43.6 11.4 43 L9.3 40.9 C8.6 40.2 8.3 39.3 8.3 38.3 C8.3 37.3 8.6 36.5 9.3 35.8 L22.9 22 L9.2 8.3 C8.5 7.6 8.2 6.7 8.2 5.7 C8.2 4.7 8.5 3.9 9.2 3.2 L11.3 1.1 C12 0.4 12.9 0 13.9 0 C14.9 0 15.8 0.4 16.4 1.1 L34.8 19.5 C35.5 20.2 35.9 21 35.9 22 L35.9 22 Z'/></svg>";
            $output .= "</button>";
        }
    }
}
