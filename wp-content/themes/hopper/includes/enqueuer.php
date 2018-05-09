<?php

/**
 * Script and stylesheet enqueuer
 */

function get_site_info() {
    return apply_filters('hopper_site_info', array(
        'homeUrl'        => get_home_url(),
        'restUrl'        => get_rest_url(),
        'themeDirectory' => get_template_directory_uri(),
        'grunticonPath'  => get_template_directory_uri() . '/assets/grunticon/dist/'
    ));
}

function hopper_enqueuer() {

    // Core Styles
    wp_enqueue_style(
        'main_style',
        get_template_directory_uri() . '/assets/css/main.css',
        false,
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // Modernizr & Polyfills
    wp_enqueue_script(
        'modernizr',
        get_template_directory_uri() . '/assets/scripts/libraries/modernizr-custom.js',
        false,
        filemtime(get_template_directory() . '/assets/scripts/libraries/modernizr-custom.js'),
        true
    );

    //Grunticon
    wp_enqueue_script(
        'grunticon',
        get_template_directory_uri() . '/assets/scripts/libraries/grunticon.js',
        false,
        filemtime(get_template_directory() . '/assets/scripts/libraries/grunticon.js'),
        true
    );

    // Global JavaScript
    wp_enqueue_script(
        'main',
        get_template_directory_uri() . '/assets/scripts/site/main.js',
        array('modernizr', 'jquery'),
        filemtime(get_template_directory() . '/assets/scripts/site/main.js'),
        true
    );

    // Enqueue comment reply script when necessary
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('main', 'SiteInfo', get_site_info());

}

add_action('wp_enqueue_scripts', 'hopper_enqueuer');

function hopper_admin_enqueuer(){
    //Grunticon
    wp_enqueue_script(
        'grunticon',
        get_template_directory_uri() . '/assets/scripts/libraries/grunticon.js',
        false,
        filemtime(get_template_directory() . '/assets/scripts/libraries/grunticon.js'),
        true
    );

    // Admin JavaScript
    wp_enqueue_script(
        'admin',
        get_template_directory_uri() . '/assets/scripts/site/admin.js',
        array('jquery'),
        filemtime(get_template_directory() . '/assets/scripts/site/admin.js'),
        true
    );

    wp_localize_script('admin', 'SiteInfo', get_site_info());
}
add_action('admin_enqueue_scripts', 'hopper_admin_enqueuer');