<?php
/**
 * Security functions
 */

/**
 * Customize protected post password form output
 */
function hopper_password_form() {
    global $post;
    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);

    ?><form action="<?php echo esc_url(site_url('wp-login.php?action=postpass', 'login_post')); ?>" method="post" class="post-password-form">
        <label for="<?php echo $label; ?>">Password</label>
        <input name="post_password" id="<?php echo $label; ?>" type="password" placeholder="Enter password">
        <button type="submit" name="Submit" value="<?php echo esc_attr('Submit'); ?>">Log In</button>
    </form><?php
}
add_filter('the_password_form', 'hopper_password_form');

/**
 * Remove "Protected:" text from protected post titles
 */
function hopper_protected_title_format($title) {
   return '%s';
}
add_filter('protected_title_format', 'hopper_protected_title_format');

/**
 * Filter to hide protected posts
 */
function hopper_exclude_protected($where) {
	global $wpdb;
	return $where .= " AND {$wpdb->posts}.post_password = '' ";
}

/**
 * Excludes protected posts from specified areas
 */
function hopper_exclude_protected_action($query) {
	if (!is_single() && !is_page() && !is_admin()) {
		add_filter('posts_where', 'hopper_exclude_protected');
	}
}
add_action('pre_get_posts', 'hopper_exclude_protected_action');

/**
 * Add 'noindex' meta robots tag to protected posts
 */
function hopper_noindex_protected() {
	global $post;
	if (!empty($post->post_password)) {
		echo '<meta name="robots" content="noindex">' . "\n";
	}
}
add_action('wp_head', 'hopper_noindex_protected', 2);
