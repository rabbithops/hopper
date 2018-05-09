<?php

/**
 * Administration area customization
 */

/**
 * Customizes login page
 */
function custom_logo() {
    echo "<style>
    body.login #login h1 a {
        background: url('" . get_site_url() . "/wp-admin/images/wordpress-logo.svg') no-repeat scroll center top transparent;
        -webkit-background-size: 84px;
                background-size: 84px;
    }
    </style>";
}
add_filter('login_headerurl', create_function(false,"return '" . home_url() . "';"));
add_filter('login_headertitle', create_function(false,"return '" . get_bloginfo('name') . "';"));
add_action('login_head', 'custom_logo');

if(function_exists('acf_add_options_page')){
  $main_theme_options = acf_add_options_page(array(
    'page_title' => 'Theme Options',
    'menu_title' => 'Theme Options',
    'menu_slug' => 'theme-options',
    'capability' => 'edit_posts',
    'position' => 2,
    'redirect' => false
  ));
}

//
// Remove color scheme options
//

remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// removes the `profile.php` admin color scheme options
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );