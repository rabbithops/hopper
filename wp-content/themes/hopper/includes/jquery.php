<?php

/**
 * Enqueue jQuery from Google's CDN on the frontend
 */
function hopper_jquery_handler() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
    add_filter('script_loader_src', 'hopper_jquery_local_fallback', 10, 2);
}

add_action('wp_enqueue_scripts', 'hopper_jquery_handler');

/**
 * Local jQuery fallback if Google CDN's copy doesn't load
 */
function hopper_jquery_local_fallback($src, $handle = null) {
    static $add_jquery_fallback = false;
    if ($add_jquery_fallback) {
        echo '<script>window.jQuery || document.write(\'<script src="' . home_url() . '/wp-includes/js/jquery/jquery.js"><\/script>\')</script>' . "\n";
        $add_jquery_fallback = false;
    }
    if ($handle === 'jquery') {
        $add_jquery_fallback = true;
    }
    return $src;
}

add_action('wp_head', 'hopper_jquery_local_fallback');

?>