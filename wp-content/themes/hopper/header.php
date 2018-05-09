<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php html_class(); ?>>

<head>
    <?php wp_head(); ?>
    <!-- Google Tag Manager --><!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>

	<a class="screen-reader-text" href="#main">Skip to content</a>

    <?php if(is_user_logged_in()) {
    	get_template_part('parts/menu-main_menu');
    } ?>

	<div id="main" role="main">