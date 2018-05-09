<?php

/**
 * Breadcrumb navigation walker
 *
 * Usage:
 * wp_nav_menu( array(
 *    'theme_location' => 'main_nav',
 *    'walker'=> new Hopper_Breadcrumb_Walker,
 *    'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
 *));
 */

class Hopper_Breadcrumb_Walker extends Walker {

    var $tree_type = array('post_type', 'taxonomy', 'custom');

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    var $delimiter = ' > ';

    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {

        $classes = empty($object->classes) ? array() : (array) $object->classes;
        $current_identifiers = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor');
        $ancestor_of_current = array_intersect($current_identifiers, $classes);

        if ($ancestor_of_current) {
            $title = apply_filters('the_title', $object->title, $object->ID);

            if (0 != $depth)
                $output .= $this->delimiter;

            $attributes  = !empty($object->attr_title) ? ' title="'  . esc_attr($object->attr_title) . '"' : '';
            $attributes .= !empty($object->target)     ? ' target="' . esc_attr($object->target    ) . '"' : '';
            $attributes .= !empty($object->xfn)        ? ' rel="'    . esc_attr($object->xfn       ) . '"' : '';
            $attributes .= !empty($object->url)        ? ' href="'   . esc_attr($object->url       ) . '"' : '';

            $output .= '<a' . $attributes . '>' . $title . '</a>';

            if (in_array('current-menu-item', $classes)) {
                $output .= '<span class="current-page">' . $title . '</span>';
            } else {
                $output .= '<a' . $attributes . '>' . $title . '</a>';
            }

        }
    }
}
